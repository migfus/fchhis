<template>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3 mb-2">
        <div
            v-for="row in $ben.content" :key="row.name"
            @click="$ben.SelectedItem(row)"
            :class="[
                'relative flex items-center space-x-3 rounded-xl bg-white px-6 py-5 shadow focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:border-gray-400',
                $ben.config.formID == row.id && 'bg-zinc-100'
            ]"
        >
            <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-full" src='https://img.freepik.com/free-psd/3d-illustration-person-with-sunglasses_23-2149436188.jpg' alt="" />
            </div>
            <div class="min-w-0 flex-1">
                <div class="focus:outline-none">
                    <span class="absolute inset-0" aria-hidden="true" />
                    <p class="text-sm font-medium text-gray-900">{{ row.name }}</p>
                    <p class="truncate text-sm text-gray-500">Beneficiary</p>
                </div>
            </div>
            <button class="h-5 w-5 rounded-full">
                <PencilSquareIcon class="h-5 w-5 flex-shrink-0 self-center text-gray-400" aria-hidden="true" />
            </button>
        </div>

        <div
            @click="$ben.SelectedItem()"
            :class="[
                'relative flex items-center space-x-3 rounded-xl bg-white px-6 py-5 shadow focus-within:ring-2 focus-within:ring-primary-500 focus-within:ring-offset-2 hover:border-gray-400',
                $ben.config.formID == 0 && 'bg-zinc-100'
            ]"
        >
            <div class="flex-shrink-0">

            </div>
            <div class="min-w-0 flex-1">
                <button class="h-10 w-10 rounded-full">
                    <PlusCircleIcon class="-ml-1 mr-0.5 h-8 w-8 flex-shrink-0 self-center text-gray-400" aria-hidden="true" />
                </button>
            </div>

        </div>

        <BasicTransition>
            <AddFormBeneficiary v-if="$ben.config.formID == 0" class="col-span-3"/>
            <EditFormBeneficiary v-if="$ben.config.formID > 0" class="col-span-3"/>
        </BasicTransition>
    </div>

</template>

<script setup lang="ts">
import { useBeneficiaryStaffStore } from '@/store/@staff/BeneficiaryStaffStore'

import { PlusCircleIcon, PencilSquareIcon } from '@heroicons/vue/24/outline'
import AddFormBeneficiary from '../forms/AddFormBeneficiary.vue'
import EditFormBeneficiary from '../forms/EditFormBeneficiary.vue'
import BasicTransition from '@/components/transitions/BasicTransition.vue'

const $ben = useBeneficiaryStaffStore()
</script>
