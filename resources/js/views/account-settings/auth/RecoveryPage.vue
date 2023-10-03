<template>
    <div class='h-full'>
        <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <img class="mx-auto h-24 w-auto" src="http://fchhis.migfus.net/images/logo.png" alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Update your Password</h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <Form v-slot="{ errors }" :validation-schema="schema" @submit="$pass.ConfirmAPI()" validate-on-mount class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">New Password</label>
                            <div class="mt-1">
                                <Field v-model="$pass.params.password" name="newPassword" type="password" ref="newPassword" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm" />
                            </div>
                            <ErrorMessage name="newPassword" class="text-red-500"/>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <div class="mt-1">
                                <Field v-model="$pass.params.confirmPassword" name="confirmPassword" type="password" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm" />
                            </div>
                            <ErrorMessage name="confirmPassword" class="text-red-500"/>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="text-sm">
                                <RouterLink :to="{name: 'login'}" class="font-medium text-primary-600 hover:text-primary-500">Back to Login</RouterLink>
                            </div>
                        </div>

                        <div>
                            <AppButton v-if="$pass.config.approved" :loading="$pass.config.loading" block color="success">
                                Link Sent! Please check your email.
                            </AppButton>
                            <AppButton v-else @click="$pass.ChangePasswordAPI()" :loading="$pass.config.loading" block :disabled="Object.keys(errors).length != 0" type="submit">
                                Change Password
                            </AppButton>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useForgotPassword } from '@/store/auth/ForgotPasswordStore'
import * as Yup from 'yup'
import { onMounted, onUnmounted } from 'vue'

import { Form, Field, configure, ErrorMessage, } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'

configure({
    validateOnInput: true,
})
const schema = Yup.object({
    newPassword: Yup.string().required('Password is required').min(8, 'Minimum of 8 characters for better security.'),
    confirmPassword: Yup.string().oneOf([Yup.ref('newPassword')], 'Password must match').required('Confirm Password is Required')
})

const $pass = useForgotPassword()

onMounted(() => {
    $pass.ConfirmAPI()
})
onUnmounted(() => {
    $pass.ResetParams
})
</script>
