<template>
    <div>
        <dl class="grid grid-cols-1">
            <div class="overflow-hidden rounded-xl bg-white px-4 py-5 shadow sm:p-6 mb-2">
                <dt class="truncate text-sm font-medium text-gray-500">Total Payed</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-green-500">{{ NumberAddComma($user.content.client_transactions_sum_amount) }}</dd>

                <dt class="truncate text-sm font-medium text-gray-500 mt-2">Balance</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-red-400">22,000</dd>
            </div>
        </dl>
    </div>
</template>

<script setup lang='ts'>
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'

import { NumberAddComma } from '@/helpers/Converter';

const $user = useUserStaffStore()
</script>
