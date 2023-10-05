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
                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$user.params.email" placeholder="Email" name="email" type="email" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppInput v-model="$user.params.password" placeholder="Password" name="password" :errors="errors"/>
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
                            <AppInput v-model="$user.params.name" placeholder="Name" name="name" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$user.params.sex" placeholder="Sex" name="sex" :errors="errors">
                                <option :value="true">Male</option>
                                <option :value="false">Female</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Birth Place (Province)</label>
                            <select v-model="bday_province_id" id="bday_province" name="bday_province" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                                <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$user.params.address_id" placeholder="Birth Place (City)" name="bplace_city" :errors="errors">
                                <option v-if="!bday_province_id" value="1">Select Province</option>
                                <option v-for="row in $address.content.find(item => item.id === bday_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <AppInput v-model="$user.params.bday" placeholder="Birth Day" name="bday" type="date" :errors="errors"/>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Address (Province)</label>
                            <select v-model="address_province_id" id="country" name="country" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option v-for="row in $address.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <AppSelect v-model="$user.params.address_id" placeholder="Address (City)" name="address_city" :errors="errors">
                                <option v-if="!address_province_id" value="1">Select Province</option>
                                <option v-for="row in $address.content.find(item => item.id === address_province_id).cities" :key="row.id" :value="row.id">{{ row.name }}</option>
                            </AppSelect>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$user.params.address" placeholder="Address (Specific)" name="address" :errors="errors"/>
                        </div>

                        <div class="col-span-6">
                            <AppInput v-model="$user.params.mobile" placeholder="Mobile Phone" name="mobile" type="number" :errors="errors"/>
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
                        <AppComboBoxAgent />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <AppComboBoxPlan />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <AppComboBoxPaymentType />
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
    <AvatarUpload v-model:show="show" v-model="_data" @update="ChangeAvatarAPI"/>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import * as Yup from 'yup'
import { useAddressStore } from '@/store/system/AddressStore'
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'
import { useAgentSelectionStore } from '@/store/selection/AgentSelectionStore'
import { usePaymentTypeSelectionStore } from '@/store/selection/PaymentTypeSelectionStore'
import { usePlanSelectionStore } from '@/store/selection/PlanSelectionStore'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppSelect from '@/components/AppSelect.vue'
import AvatarUpload from '@/components/modals/AvatarUpload.vue'
import AppComboBoxAgent from '@/components/AppComboBoxAgent.vue'
import AppComboBoxPlan from '@/components/AppComboBoxPlan.vue'
import AppComboBoxPaymentType from '@/components/AppComboBoxPaymentType.vue'

configure({
    validateOnInput: true
})

const show = ref(false)
const _data = ref('http://127.0.0.1:8000/images/logo.png')
const $address = useAddressStore()
const $user = useClientStaffStore()
const $agent = useAgentSelectionStore()
const $plan = usePlanSelectionStore()
const $payment = usePaymentTypeSelectionStore()

$user.params.agent = $agent.selected
$user.params.plan_detail = $plan.selected
$user.params.payment_type = $payment.selected

const schema = Yup.object({
    email: Yup.string().required('Email is Required').email('Invalid Email'),
    password: Yup.string().required('Password is required').min(8, 'Minimum of 8 characters'),
    name: Yup.string().required('Name is required'),
    bday: Yup.date().typeError('Invalid Date').required('Date is Required'),
    address: Yup.string().required('Address is required'),
    mobile: Yup.string().required('Mobile phone is required').min(10, 'Invalid Number').max(10, 'Invalid Number'),
    // agent_id: Yup.string().required('Agent is requird')
})

const bday_province_id = ref(16)
const address_province_id = ref(16)

function ChangeAvatarAPI() {
    alert()
}
</script>
