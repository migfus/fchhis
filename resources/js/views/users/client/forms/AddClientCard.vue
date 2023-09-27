<template>
    <form class="space-y-6 mb-2" action="#" method="POST">
        <div class="bg-white border-2 border-green-300 px-4 py-5 shadow sm:rounded-lg sm:p-6">
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
                            <AppButton @click="show = true" size="sm">Change</AppButton>
                        </div>
                    </div>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="_data" placeholder="Email" name="email" type="email"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="_data" placeholder="Password" name="password"/>
                        </div>
                    </div>

                </div>
            </div>

            <hr class="my-8"/>

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Use a permanent address where you can receive mail.</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="_data" placeholder="Name" name="name"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Sex</label>
                            <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (Province)</label>
                            <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (City)</label>
                            <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <AppInput v-model="_data" placeholder="Birth Day" name="bday"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Address (Province)</label>
                            <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Address (City)</label>
                            <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="_data" placeholder="Address (Specific)" name="address"/>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="_data" placeholder="Mobile Phone" name="mobile" type="number"/>
                        </div>

                    </div>
                </div>
            </div>
            <hr class="my-8"/>

            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Plan/Agent</h3>
                    <p class="mt-1 text-sm text-gray-500">Select Plan Client</p>
                </div>
                <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">

                    <div class="col-span-6 sm:col-span-3">
                        <label for="country" class="block text-sm font-medium text-gray-700">Agent</label>
                        <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="country" class="block text-sm font-medium text-gray-700">Plan</label>
                        <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="country" class="block text-sm font-medium text-gray-700">Payment Type</label>
                        <select id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-8 gap-1">
                <AppButton type="submit">Save</AppButton>
                <AppButton color="white">Cancel</AppButton>
            </div>

        </div>
    </form>
    <AvatarUpload v-model:show="show" v-model="_data" @update="ChangeAvatarAPI"/>
</template>

<script setup lang="ts">
import { ref } from 'vue'

import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AvatarUpload from '@/components/modals/AvatarUpload.vue'

const show = ref(false)
const _data = ref('http://127.0.0.1:8000/images/logo.png')

function ChangeAvatarAPI() {
    alert()
}
</script>
