<template>
    <div>
        <dl class="grid grid-cols-1">
            <div class="overflow-hidden sm:rounded-xl bg-white px-4 py-5 shadow sm:p-6 mb-2">
                <dt class="truncate text-sm font-medium text-gray-500">Current Month</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-green-500">{{ 123 }}</dd>

                <dt class="truncate text-sm font-medium text-gray-500 mt-2">Overall</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-red-400">{{  123 }}</dd>

                <dt class="truncate text-sm font-medium text-gray-500 mt-2">
                    Due in {{ DueStatusDesc($trans.dueAt) }}
                </dt>
                <dd
                    :class="[
                        'mt-1 text-xl font-semibold tracking-tight text-green-500',
                        DueStatusColor($trans.dueAt),
                    ]"
                >
                    {{ $trans.dueAt && moment(String($trans.dueAt)).format('MMM D, YYYY')}}

                </dd>
            </div>
        </dl>
    </div>
</template>

<script setup lang='ts'>
import { useUserTransactionStaffStore } from '@/store/@staff/UserTransactionStaffStore'
import moment from 'moment'
import { SumOfTransaction, BalanceToPay } from '@/helpers/Converter'
import { DueStatusColor, DueStatusDesc } from '@/helpers/Converter'
import { useUserStaffStore } from '@/store/@staff/UserStaffStore';

const $trans = useUserTransactionStaffStore()
const $user = useUserStaffStore()
</script>
