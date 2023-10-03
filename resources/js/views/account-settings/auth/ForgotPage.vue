<template>
    <div class='h-full'>
        <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <img class="mx-auto h-24 w-auto" src="http://127.0.0.1:8000/images/logo.png" alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Recover your account</h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <Form v-slot="{ errors }" :validation-schema="schema" @submit="$pass.RecoveryAPI()" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <Field v-model="$pass.params.email" id="email" name="email" type="email" autocomplete="email" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm" />
                            </div>
                            <ErrorMessage name="email" class="text-red-500"/>
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

                            <AppButton v-else :loading="$pass.config.loading" block :disabled="Object.keys(errors).length != 0" type="submit">
                                Send Recovery Link
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
import { Form, Field, ErrorMessage, configure} from 'vee-validate'
import { onUnmounted } from 'vue';


import AppButton from '@/components/AppButton.vue';

configure({
    validateOnInput: true,
})

const $pass = useForgotPassword()
const schema = Yup.object({
    email: Yup.string().email('Invalid Email').required('Email Required')
})

onUnmounted(() => {
    $pass.ResetParams()
})
</script>
