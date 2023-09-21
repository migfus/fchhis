<template>
    <div class="space-y-6 lg:col-span-2 lg:col-start-1">
        <!-- Description list-->
        <section aria-labelledby="applicant-information-title">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">Change Password</h2>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <Form v-slot="{ errors }" :validation-schema="schema" @submit="$auth.ChangePasswordAPI()">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <Field v-model="$auth.changePassword.currentPassword" type="password" name="currentPassword" id="currentPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <ErrorMessage name="currentPassword" class="text-sm font-medium text-red-500"/>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
                                <Field v-model="$auth.changePassword.newPassword" type="password" name="newPassword" id="newPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <ErrorMessage name="newPassword" class="text-sm font-medium text-red-500"/>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <Field v-model="$auth.changePassword.confirmPassword" type="password" name="confirmPassword" id="confirmPassword" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <ErrorMessage name="confirmPassword" class="text-sm font-medium text-red-500"/>
                            </div>

                            <AppButton size="sm" type="submit" :disabled="Object.keys(errors).length != 0" class="col-end-4" >Update</AppButton>
                        </dl>
                    </Form>

                </div>
            </div>
        </section>
    </div>

</template>

<script setup lang="ts">
import { watch } from 'vue'
import { useAuthStore } from '@/store/auth/AuthStore'
import * as Yup from 'yup'

import { Form, Field, ErrorMessage, configure, } from 'vee-validate'
import AppButton from '@/components/AppButton.vue';

configure({
    validateOnInput: true
})
const $auth = useAuthStore()

const schema = Yup.object({
    currentPassword: Yup.string().required('Current Password Required').min(8, 'Minimum of 8 Characters')
        .test({
            name: 'Invalid Password',
            message: 'Incorrect Password',
            test: (val) => $auth.errors ? false : true
        }),
    newPassword: Yup.string().required('New Password Required').min(8, 'Minimum of 8 Characters'),
    confirmPassword: Yup.string().oneOf([Yup.ref('newPassword'), null], 'Password must match to New Password')
})

watch($auth.changePassword, () => {
    $auth.errors = null
})
</script>
