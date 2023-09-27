<template>
    <div v-if="$users.content" class="space-y-1 mt-2">
        <DataTransition>
            <div v-for="row in $users.content.data" :key="row.id" class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6 sm:rounded-lg shadow">
                <div class="-ml-4 -mt-4 justify-between grid grid-cols-4">

                    <div class="ml-4 mt-4 col-span-4 md:col-span-2 xl:col-span-1">
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

                    <div class="ml-4 mt-4 col-span-4 md:col-span-2 xl:col-span-1">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <h3 class="font-medium leading-6 text-gray-800">{{  `${row.info.plan_detail.plan.name} (${row.info.pay_type.name})` }}</h3>
                                <p class="text-sm text-gray-700">
                                    Total:
                                    <span class="text-green-500">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                                <p class="text-sm text-gray-700">
                                    Balance:
                                    <span class="text-red-500">{{ NumberAddComma(row.client_transactions_sum_amount) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 mt-4 col-span-4 md:col-span-2 xl:col-span-1">
                        <div class="flex items-center">
                            <div class="ml-4 truncate text-ellipsis">
                                <h3 class="font-medium leading-6 text-gray-700">
                                    Due: {{  `${moment(row.info.due_at).format('MMM D, YYYY')} ` }}
                                </h3>

                                <p class="text-sm text-gray-700">
                                    Agent:
                                    <span class="text-gray-700 text-ellipsis">{{ `${row.info.agent.name}` }}</span>
                                </p>
                                <p class="text-sm text-gray-700">
                                    Staff:
                                    {{ row.info.staff.name }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 mt-4 col-span-4 md:col-span-2 xl:col-span-1">
                        <div class="flex items-center truncate text-ellipsis">
                            <div class="ml-4">
                                <h3 class="font-medium leading-6 text-gray-500">{{  `${moment(row.created_at).format('MMM D, YYYY')} ` }}</h3>
                                <p class="text-sm text-gray-700">
                                    {{ `${row.info.address}, ${$address.CityIDToFullAddress(row.info.address_id)}` }}
                                </p>
                                <p class="text-sm text-gray-700">
                                    {{ `${row.branch.name} Branch` }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="ml-4 mt-4 flex flex-shrink-0 col-span-3">
                        <div v-for="ben in row.beneficiaries" :key="ben.id"  class="mr-1 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none">
                            {{ ben.name }}
                        </div>
                    </div>

                    <div class="ml-4 mt-4 flex flex-shrink-0 justify-end">
                        <RouterLink :to="{ name: 'user', params: { id: row.id}}">
                            <AppButton size="sm">Info</AppButton>
                        </RouterLink>
                    </div>
                </div>
            </div>
        </DataTransition>
    </div>
</template>

<script setup lang="ts">
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'
import { useAddressStore } from '@/store/system/AddressStore'
import { NumberAddComma } from '@/helpers/Converter'
import moment from 'moment'

import DataTransition from '@/components/transitions/DataTransition.vue'
import AppButton from '@/components/AppButton.vue'

const $users = useClientStaffStore()
const $address = useAddressStore()
</script>
