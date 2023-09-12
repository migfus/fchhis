<template>
    <TransitionRoot as="template" :show="modelValue">
        <Dialog as="div" class="relative z-10" @close="$emit('update:modelValue', false)">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                        <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">

                            <VuePictureCropper
                                :boxStyle="config.cropperBoxStyle"
                                :img="$props.modelValue"
                                :options="config.cropperOption"
                                class=""
                            />

test
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup lang="ts">
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon } from '@heroicons/vue/24/outline'
import VuePictureCropper, { cropper } from 'vue-picture-cropper'
import { ref } from 'vue'
import { useAuthStore } from '@/store/auth/AuthStore'

defineProps(['modelValue'])
defineEmits(['update:modelValue'])
const $auth = useAuthStore();

const uploadInput = ref(null);
const defaulImage = $auth.content.auth.avatar
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


function updateValue(val) {
    alert(val)
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
        // @ts-ignore
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
}

function Reset() {
    if (!cropper) return
    cropper.reset()
    updateValue($auth.content.auth.avatar)
}

</script>
