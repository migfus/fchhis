<template>
    <Form v-slot="{ errors }" :validation-schema="schema" @submit="$user.PostAPI()">
        <div class="bg-white px-4 py-5 shadow sm:rounded-xl sm:p-6 mb-2">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">User Credential</h3>
                    <p class="mt-1 text-sm text-gray-500">This information will be the user's credentials</p>
                </div>
                <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Photo</label>
                        <div class="mt-1 flex items-center space-x-5">
                            <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                                <img :src="_data" alt="" class="h-full w-full">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <AppButton @click="show = true" size="sm" color="white">Change</AppButton>
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-6">

                        <div class="col-span-6 sm:col-span-6">
                            <AppInput v-model="$user.params.name" placeholder="Name" name="name" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$user.params.email" placeholder="Email" name="email" type="email" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$user.params.password" placeholder="Password" name="password" :errors="errors"/>
                        </div>
                    </div>

                </div>
            </div>

            <div class="flex justify-end mt-8 gap-1">
                <AppButton type="submit" color='success' :disabled="Object.keys(errors).length != 0">Save</AppButton>
                <AppButton @click="$user.ChangeForm()" color="white">Cancel</AppButton>
            </div>

            <div v-if="Object.keys(errors).length != 0" class="text-red-500">ERRORS!</div>
            <div v-for="row, index in errors" :key="index" class="text-red-600">{{ `[${index.toUpperCase()}] = ${row}!` }}</div>

        </div>
    </Form>
    <AvatarUpload v-model:show="show" v-model="_data"/>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import * as Yup from 'yup'
import { useAgentStaffStore } from '@/store/@staff/AgentStaffStore'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AvatarUpload from '@/components/modals/AvatarUpload.vue'

configure({
    validateOnInput: true
})

const show = ref(false)
const _data = ref('https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg')
const $user = useAgentStaffStore()

const schema = Yup.object({
    name: Yup.string().required('Name is required'),
    email: Yup.string().required('Email is required').email('Invalid Email'),
    password: Yup.string().required('Password is required').min(8, 'Minimum of 8 characters'),
})
</script>
