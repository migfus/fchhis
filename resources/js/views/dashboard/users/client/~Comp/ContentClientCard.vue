<script setup lang="ts">
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'
import { useAddressStore } from '@/store/system/AddressStore'
import { NumberAddComma, DueStatusColor } from '@/helpers/Converter'
import moment from 'moment'

import DataTransition from '@/components/transitions/DataTransition.vue'
import AppButton from '@/components/AppButton.vue'

const $users = useClientStaffStore()
const $address = useAddressStore()
</script>

<template>
  <div v-if="$users.content" class="space-y-1 mt-2">
    <DataTransition>
      <div
        v-for="row in $users.content.data"
        :key="row.id"
        class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6 sm:rounded-xl shadow"
      >
        <div class="-ml-4 -mt-4 justify-between grid grid-cols-4">
          <div class="ml-4 mt-4 col-span-4 md:col-span-2 xl:col-span-1">
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <img
                  :class="[
                    'h-12 w-12 rounded-full ring-4 ring-white',
                    DueStatusColor(row.info.due_at, 'ring'),
                  ]"
                  :src="
                    row.avatar ??
                    'https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg'
                  "
                  alt=""
                />
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                  {{ row.name }}
                </h3>
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
                <h3 class="font-medium leading-6 text-gray-800">
                  {{
                    `${row.info.plan_detail.plan.name} (${row.info.pay_type.name})`
                  }}
                </h3>
                <p class="text-sm text-gray-700">
                  Total:
                  <span class="text-green-500">{{
                    NumberAddComma(row.client_transactions_sum_amount)
                  }}</span>
                </p>
                <p class="text-sm text-gray-700">
                  Balance:
                  <span class="text-red-500">{{
                    NumberAddComma(row.client_transactions_sum_amount)
                  }}</span>
                </p>
              </div>
            </div>
          </div>

          <div class="ml-4 mt-4 col-span-4 md:col-span-2 xl:col-span-1">
            <div class="flex items-center">
              <div class="ml-4 truncate text-ellipsis">
                <h3 class="font-medium leading-6 text-gray-700">
                  Due: {{ `${moment(row.info.due_at).format('MMM D, YYYY')} ` }}
                </h3>

                <p class="text-sm text-gray-700">
                  Agent:
                  <span class="text-gray-700 text-ellipsis">{{
                    `${row.info.agent.name}`
                  }}</span>
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
                <h3 class="font-medium leading-6 text-gray-500">
                  {{ `${moment(row.created_at).format('MMM D, YYYY')} ` }}
                </h3>
                <p class="text-sm text-gray-700">
                  {{
                    `${row.info.address}, ${$address.CityIDToFullAddress(row.info.address_id)}`
                  }}
                </p>
                <p class="text-sm text-gray-700">
                  {{ `${row.branch.name} Branch` }}
                </p>
              </div>
            </div>
          </div>

          <div class="ml-4 mt-4 flex flex-shrink-0 col-span-3">
            <span
              v-for="ben in row.beneficiaries"
              :key="ben.id"
              class="mr-1 inline-flex items-center rounded-full bg-gray-200 shadow-md px-3 py-0.5 text-sm font-medium text-primary-800"
            >
              <img
                :class="['h-6 w-6 mr-2 rounded-full']"
                :src="'https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg'"
              />
              {{ ben.name }}
            </span>
          </div>

          <div class="ml-4 mt-4 flex flex-shrink-0 justify-end">
            <RouterLink :to="{ name: 'user', params: { id: row.id } }">
              <AppButton color="white" size="sm">Info</AppButton>
            </RouterLink>
          </div>
        </div>
      </div>
    </DataTransition>
  </div>
</template>
