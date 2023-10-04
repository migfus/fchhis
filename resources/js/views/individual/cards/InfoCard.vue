<template>
    <BasicTransitionVue>
        <UpdateInfo v-if="$user.config.form == 'update'" />
        <div v-else class="overflow-hidden bg-white shadow sm:rounded-xl mb-2 ">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Information</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Additional Information of Client</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Sex</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $user.content.info.sex ? 'Male' : 'Female'}}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Mobile Number</dt>
                        <dd class="mt-1 text-sm text-gray-900">+63 {{  $user.content.info.cell }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Birth Day</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ moment(String($user.content.info.bday)).format('MMM D, YYYY') }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Birth Place</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $address.CityIDToFullAddress($user.content.info.bplace_id) }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ `${$user.content.info.address}, ${$address.CityIDToFullAddress($user.content.info.address_id)}`}}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Plan</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ `${$user.content.info.plan_detail.plan.name} (${$user.content.info.pay_type.name})`}}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">USER ID</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ `${$user.content.id}`}}</dd>
                    </div>
                    <div class="sm:col-span-2 flex justify-end">
                        <AppButton @click="$user.config.form = 'update'" color="white">Edit</AppButton>
                    </div>
                </dl>
            </div>
        </div>
    </BasicTransitionVue>
</template>

<script setup lang="ts">
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'
import { useAddressStore } from '@/store/system/AddressStore'
import moment from 'moment'

import AppButton from '@/components/AppButton.vue'
import UpdateInfo from '../forms/UpdateInfo.vue'
import BasicTransitionVue from '@/components/transitions/BasicTransition.vue'

const $user = useUserStaffStore()
const $address = useAddressStore()
</script>
