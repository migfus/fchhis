<template>
    <div class="mt-5 md:col-span-2 md:mt-0 mb-2">
        <Form v-slot="{errors}" :validation-schema="schema" @submit="$user.UpdateAPI()">
            <div class="shadow sm:overflow-hidden sm:rounded-xl">
                <div class="space-y-6 bg-white px-4 py-5 sm:p-6 border-1 border-yellow-600">
                    <h2 class="font-semibold mb-2">Update Information</h2>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                            <AppInput v-model="$user.params.email" placeholder="Email" name="email"/>
                        </div>
                        <div class="col-span-6">
                            <AppInput v-model="$user.params.name" placeholder="Name" name="name"/>
                        </div>

                        <div class="col-span-6">
                            <AppSelect v-model="$user.params.info.sex" placeholder="Sex" name="sex" :errors="errors">
                                <option :value="1">Male</option>
                                <option :value="0">Female</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (Province)</label>
                            <select v-model="bday_province_id" id="bday_province" name="bday_province" class="mt-1 block w-full rounded-xl border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                                <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </select>
                        </div>

                        <div class="col-span-6">
                            <AppSelect v-model="$user.params.info.bplace_id" placeholder="Birth Place (City)" name="bplace_city" :errors="errors">
                                <option v-if="!bday_province_id" value="1">Select Province</option>
                                <option v-for="row in $address.content.find(item => item.id === bday_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$user.params.info.bday" placeholder="Birth day" type="date" name="bday"/>
                        </div>

                        <div class="col-span-6">
                            <label for="country" class="block text-sm font-medium text-gray-700">Address (Province)</label>
                            <select v-model="address_province_id" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-xl border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </select>
                        </div>

                        <div class="col-span-6">
                            <AppSelect v-model="$user.params.info.address_id" placeholder="Address (City)" name="address_city" :errors="errors">
                                <option v-if="!address_province_id" value="1">Select Province</option>
                                <option v-for="row in $address.content.find(item => item.id === address_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$user.params.info.address" placeholder="Address (Specific)" name="address" :errors="errors"/>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$user.params.info.cell" placeholder="Mobile Phone" name="mobile" type="number" :errors="errors"/>
                        </div>

                        <div class="col-span-6">
                            <AppSelect v-model="$user.params.info.plan_detail_id" placeholder="Plan" name="plan" :errors="errors">
                                <option v-for="row in $plan.content" :key="row.id" :value="row.plan_detail[0].id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <AppSelect v-model="$user.params.info.pay_type_id" placeholder="Pay Type" name="pay_type" :errors="errors">
                                <option v-for="row in $paytype.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$user.params.info.due_at" placeholder="Due Date" type="date" name="due_at"/>
                        </div>
                    </div>
                </div>
                <div class="bg-white px-4 py-3 pb-6 text-right sm:px-6 flex gap-2 justify-end">
                    <AppButton color="warning" type="submit" :disabled="Object.keys(errors).length != 0">Update</AppButton>
                    <AppButton @click="$user.config.form = null" color="white">Cancel</AppButton>
                </div>
            </div>
        </Form>
    </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useAddressStore } from '@/store/system/AddressStore'
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'
import { usePlanSelectionStore } from '@/store/selection/PlanSelectionStore'
import { usePaymentTypeSelectionStore } from '@/store/selection/PaymentTypeSelectionStore'
import * as Yup from 'yup'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppSelect from '@/components/AppSelect.vue'

configure({
    validateOnInput: true
})

const schema = Yup.object({
    email: Yup.string().required('Email is Required').email('Invalid Email'),
    name: Yup.string().required('Name is Required'),
    sex: Yup.string().required('Sex is required'),
    bplace_city: Yup.string().required('Birth Place is required'),
    bday: Yup.date().typeError('Invalid Date').required('Birth Day is required'),
    address_city: Yup.string().required('Address is required'),
    address: Yup.string().required('Address is required'),
    mobile: Yup.string().required('Mobile Number is required').min(10, 'Exact 10 digits').max(11, 'Exact 10 digits'),
    plan: Yup.string().required('Plan is required'),
    pay_type: Yup.string().required('Pay Type is required'),
})

const $address = useAddressStore()
const $user = useUserStaffStore()
const $plan = usePlanSelectionStore()
const $paytype = usePaymentTypeSelectionStore()

const bday_province_id = ref($address.CityIDToProvinceID($user.params.info.bplace_id))
const address_province_id = ref($address.CityIDToProvinceID($user.params.info.bplace_id))

onMounted(() => {
    $address.GetAPI()
    $plan.GetAPI()
    $paytype.GetAPI()
})
</script>
