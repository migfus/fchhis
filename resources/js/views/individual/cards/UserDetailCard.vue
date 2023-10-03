<template>
    <div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <Form v-slot="{errors}" action="#" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6 border-1 border-yellow-600">
                        <h2 class="font-semibold mb-2">User Info</h2>

                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$user.content.email" placeholder="Email" name="email"/>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$user.content.name" placeholder="Name" name="name"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <AppSelect v-model="$user.content.info.sex" placeholder="Sex" name="sex" :errors="errors">
                                    <option :value="true">Male</option>
                                    <option :value="false">Female</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (Province)</label>
                                <select v-model="bday_province_id" id="bday_province" name="bday_province" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                                    <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppSelect v-model="$user.content.info.bplace_id" placeholder="Birth Place (City)" name="bplace_city" :errors="errors">
                                    <option v-if="!bday_province_id" value="1">Select Province</option>
                                    <option v-for="row in $address.content.find(item => item.id === bday_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppInput v-model="$user.content.info.bday" placeholder="Birth day" type="date" name="bday"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                <label for="country" class="block text-sm font-medium text-gray-700">Address (Province)</label>
                                <select v-model="address_province_id" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                    <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppSelect v-model="$user.content.info.address_id" placeholder="Address (City)" name="address_city" :errors="errors">
                                    <option v-if="!address_province_id" value="1">Select Province</option>
                                    <option v-for="row in $address.content.find(item => item.id === address_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                <AppInput v-model="$user.content.info.address" placeholder="Address (Specific)" name="address" :errors="errors"/>
                            </div>

                            <div class="col-span-6">
                                <AppInput v-model="$user.content.info.cell" placeholder="Mobile Phone" name="mobile" type="number" :errors="errors"/>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white px-4 py-3 pb-6 text-right sm:px-6">
                        <AppButton color="warning" class="inline-flex">Change</AppButton>
                    </div>
                </div>
            </Form>
        </div>
    </div>

</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useAddressStore } from '@/store/system/AddressStore'
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppSelect from '@/components/AppSelect.vue'

configure({
    validateOnInput: true
})

const $address = useAddressStore()
const $user = useUserStaffStore()

const bday_province_id = $address.CityIDToProvinceID($user.content.info.bplace_id)
const address_province_id = $address.CityIDToProvinceID($user.content.info.bplace_id)

onMounted(() => {
    $address.GetAPI()
})
</script>
