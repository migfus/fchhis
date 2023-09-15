<template>
    <div class='h-full'>
        <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 col-start-1 col-span-3 lg:col-span-1 lg:col-start-2">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <img class="mx-auto h-40 w-auto" src="https://fchhis.migfus.net/images/logo.png" alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>
            </div>

            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                    <Form v-slot="{ errors }" :validation-schema="schema" @submit="$auth.LoginAPI(input)" class="space-y-6" >
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <Field v-model="input.email" name="email" type="email" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm" />
                            </div>
                            <ErrorMessage name="email" class="text-red-500"/>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <Field v-model="input.password" name="password" type="password" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm" />
                            </div>
                            <ErrorMessage name="password" class="text-red-500"/>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                            </div>

                            <div class="text-sm">
                                <RouterLink :to="{name: 'forgot'}" class="font-medium text-primary-600 hover:text-primary-500">Forgot your password?</RouterLink>
                            </div>
                        </div>

                        <div>
                            <AppButton :loading="$auth.config.loading" :disabled="Object.keys(errors).length != 0" size="sm" block type="submit">
                                Sign In
                            </AppButton>
                        </div>
                    </Form>

                </div>
            </div>
        </div>
    </div>

</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/auth/AuthStore'
import { reactive } from 'vue'
import * as Yup from 'yup'
import { Form, Field, configure, ErrorMessage } from 'vee-validate'

import AppButton from '@/components/AppButton.vue'

const $auth = useAuthStore();

configure({
    validateOnInput: true
})
const schema = Yup.object({
    email: Yup.string().required('Email is required').email('Invalid Email'),
    password: Yup.string().required('Password is required')
})

interface InputInt {
    email: string
    password: string
}
const input = reactive<InputInt>({
    email: 'admin@gmail.com',
    password: '12345678',
});
</script>
