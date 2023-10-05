<template>
    <div class="space-y-2 mt-2">
        <DataTransition>
            <div
                v-for="row in $trans.content" :key="row.name"
                :class="[
                    'grid grid-cols-3 relative items-center space-x-3 rounded-xl bg-white px-6 py-5 shadow focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:border-gray-400',
                ]"
            >
                <div class="flex">
                    <div class="flex-shrink-0 mr-2">
                        <img class="h-10 w-10 rounded-full" :src='row.client.avatar' alt="" />
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="focus:outline-none">
                            <span class="inset-0" aria-hidden="true" />
                            <p class="text-sm font-medium text-green-900">+{{ NumberAddComma(row.amount) }}</p>
                            <p class="truncate text-sm text-gray-500">{{ row.plan_details.plan.name }} ({{ row.pay_type.name }})</p>
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-900">{{ moment(row.created_at).format('MMM D, YYYY hh:mm A') }}</p>
                    <p class="truncate text-sm text-gray-500">{{ row.agent.name }}</p>
                </div>

                <div class="flex justify-end">
                    <AppButton @click="$trans.Update(row)" color="white" size="sm">Edit</AppButton>
                </div>
            </div>
        </DataTransition>
    </div>
</template>

<script setup lang="ts">
import { useUserTransactionStaffStore } from '@/store/@staff/UserTransactionStaffStore'
import { NumberAddComma } from '@/helpers/Converter'
import moment from 'moment'

import DataTransition from '@/components/transitions/DataTransition.vue'
import AppButton from '@/components/AppButton.vue'

const $trans = useUserTransactionStaffStore()

function test() {
    alert()
}
</script>
