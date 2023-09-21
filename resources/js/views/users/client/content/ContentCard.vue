<template>
    <div class="space-y-1 mt-2">
        <DataTransition>
            <div v-for="row in $users.content.data" :key="row.id" class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6 sm:rounded-lg shadow">
                <div class="-ml-4 -mt-4 justify-between grid grid-cols-4">
                    <div class="ml-4 mt-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" :src="row.avatar ?? 'https://fchhis.migfus.net/images/logo.png'" alt="" />
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{  row.name }}</h3>
                                <p class="text-sm text-gray-500">
                                    <a href="#">{{ row.email }}</a>
                                </p>
                                <p class="text-sm text-gray-500">
                                    <a href="#">{{ row.roles[0].name }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 mt-4">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <h3 class="font-medium leading-6 text-gray-500">{{  `${row.info.plan_detail.plan.name} (${row.info.pay_type.name})` }}</h3>
                                <p class="text-sm text-gray-500">
                                    Total:
                                    <span class="text-green-400">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    Balance:
                                    <span class="text-red-400">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 mt-4">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <h3 class="font-medium leading-6 text-gray-500">
                                    Due: {{  `${moment(row.info.due_at).format('MMM D, YYYY')} ` }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    Total:
                                    <span class="text-green-400">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    Balance:
                                    <span class="text-red-400">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 mt-4">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <h3 class="font-medium leading-6 text-gray-500">Due: {{  `${row.info.due_at} ` }}</h3>
                                <p class="text-sm text-gray-500">
                                    Total:
                                    <span class="text-green-400">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    Balance:
                                    <span class="text-red-400">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>


                    <!-- <div class="ml-4 mt-4 flex flex-shrink-0 justify-end">
                        <RouterLink :to="{ name: 'user', params: { id: row.id}}">
                            <AppButton size="sm">Info</AppButton>
                        </RouterLink>
                    </div> -->
                </div>
            </div>
        </DataTransition>
    </div>
</template>

<script setup lang="ts">
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'
import { EnvelopeIcon, PhoneIcon } from '@heroicons/vue/20/solid'
import { NumberAddComma } from '@/helpers/Converter'
import moment from 'moment'

import AppButton from '@/components/AppButton.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'

const $users = useClientStaffStore()
</script>
