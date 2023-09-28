<template>
    <div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <Form v-slot="{errors}" action="#" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Photo</label>
                            <div class="mt-1 flex items-center">
                                <span class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                <AppButton color="white" class="ml-5" size="sm">Change</AppButton>
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="form.email" placeholder="Email" name="email"/>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="form.name" placeholder="Name" name="name"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <AppSelect v-model="form.sex" placeholder="Sex" name="sex" :errors="errors">
                                    <option :value="1">Male</option>
                                    <option :value="2">Female</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (Province)</label>
                                <select v-model="bday_province_id" id="bday_province" name="bday_province" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                                    <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppSelect v-model="form.bplace_id" placeholder="Birth Place (City)" name="bplace_city" :errors="errors">
                                    <option v-if="!bday_province_id" value="1">Select Province</option>
                                    <option v-for="row in $address.content.find(item => item.id === bday_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppInput v-model="form.bday" placeholder="Birth day" type="date" name="bday"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Address (Province)</label>
                                <select v-model="address_province_id" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppSelect v-model="form.address_id" placeholder="Address (City)" name="address_city" :errors="errors">
                                    <option v-if="!address_province_id" value="1">Select Province</option>
                                    <option v-for="row in $address.content.find(item => item.id === address_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppInput v-model="form.address" placeholder="Address (Specific)" name="address" :errors="errors"/>
                            </div>

                            <div class="col-span-6">
                                <AppInput v-model="form.mobile" placeholder="Mobile Phone" name="mobile" type="number" :errors="errors"/>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <AppButton color="white" class="inline-flex">Change</AppButton>
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import { useAddressStore } from '@/store/system/AddressStore';

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue';
import AppSelect from '@/components/AppSelect.vue';

const $address = useAddressStore()

const form = reactive({
    avatar: '',
    name: '',
    email: '',
    sex: false,
    bplace_id: 258,
    bday: '',
    address_id: 258,
    address: '',
    mobile: '',
})
const bday_province_id = ref(16)
const address_province_id = ref(16)

onMounted(async () => {
    await $address.GetAPI()
})
</script>
