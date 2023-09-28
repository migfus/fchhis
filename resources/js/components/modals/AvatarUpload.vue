<template>
    <TransitionRoot as="template" :show="show">
        <Dialog as="div" class="relative z-10" @close="$emit('update:modelValue', false)">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">

                                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Upload Avatar</h3>
                                        <div class="mt-2">
                                            <VuePictureCropper
                                                :boxStyle="config.cropperBoxStyle"
                                                :img="$props.modelValue"
                                                :options="config.cropperOption"
                                                class="rounded"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input @change="SelectFile" ref="uploadInput" id="file-upload" name="file-upload" type="file" accept="image/jpg, image/jpeg, image/png, image/gif" class="sr-only" />
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-1">
                                <AppButton block color="white" @click="$emit('update:show', false)" class="mt-1">Cancel</AppButton>
                                <AppButton block color="white" @click="GetResult()" class="mt-1">Save</AppButton>
                                <AppButton block color="white" @click="Reset()" class="mt-1">Reset</AppButton>
                            </div>

                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import { ref } from 'vue'

import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import VuePictureCropper, { cropper } from 'vue-picture-cropper'
import AppButton from '@/components/AppButton.vue'

const $props = defineProps({
    modelValue: String,
    show: Boolean,
})
const $emit = defineEmits(['update:modelValue', 'update', 'update:show'])
const uploadInput = ref(null);
const defaultImage = $props.modelValue;
const config = {
    cropperOption: {
        viewMode: 2,
        dragMode: 'crop',
        aspectRatio: 1,
    },
    cropperBoxStyle: {
        width: '100%',
        height: '100%',
        backgroundColor: '#f8f8f8',
        margin: 'auto',
    }
}

function updateValue(val: string) {
    $emit('update:modelValue', val)
}

function SelectFile(event: Event) {
    // @ts-ignore
    const { files } = event.target
    if (!files || !files.length) return

    const file = files[0]
    const reader = new FileReader()
    reader.readAsDataURL(file)
    reader.onload = () => {
        updateValue(String(reader.result))
        if (!uploadInput.value) return
        uploadInput.value.value = ''
    }
}

async function GetResult() {
    if (!cropper) return
    const base64 = cropper.getDataURL({
        maxWidth: 200,
        maxHeight: 200,
        imageSmoothingQuality: 'high'
    })
    updateValue(base64)
    $emit('update')
    $emit('update:show', false)
}

function Reset() {
    if (!cropper) return
    cropper.reset()
    updateValue(defaultImage)
}
</script>
