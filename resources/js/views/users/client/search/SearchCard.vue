<template>
    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 lg:col-span-1">
                <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <VueDatePicker
                    v-model="$users.query.start" :enable-time-picker="false"
                    :start-date="moment().startOf('month').format('YYYY-MM-DD')"
                    placeholder="Start Date"
                    auto-apply
                />
            </div>

            <div class="col-span-6 lg:col-span-1">
                <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <VueDatePicker
                    v-model="$users.query.end" :enable-time-picker="false"
                    :start-date="moment().startOf('month').format('YYYY-MM-DD')"
                    placeholder="End Date"
                    auto-apply
                />
            </div>

            <div class="col-span-6 lg:col-span-2">
                <label for="filter" class="block text-sm font-medium text-gray-700">Filter</label>
                <select v-model="$users.query.filter" id="filter" name="filter" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm">
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="address">Address</option>
                    <option value="plans">Plans</option>
                </select>
            </div>

            <div class="col-span-6 lg:col-span-2">
                <AppInput v-model="$users.query.search" type="text" name="search" placeholder="Search"/>
            </div>

            <div class="col-span-6 flex justify-end gap-1">
                <AppButton :loading="$users.config.loading">Print</AppButton>
                <AppButton :loading="$users.config.loading" color='success'>Add</AppButton>
            </div>


        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, watch } from 'vue'
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'
import { throttle } from 'lodash'
import moment from 'moment'

import AppInput from '@/components/AppInput.vue'
import AppButton from '@/components/AppButton.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

const $users = useClientStaffStore()

onMounted(() => {
    $users.GetAPI()
})

watch($users.query, throttle(() => {
    $users.GetAPI()
}, 1000))
</script>
