<template>
    <div class="mt-2 border-b border-gray-200 bg-white px-4 py-5 sm:px-6 sm:rounded-lg shadow flex justify-end">
        <TailwindPagination :data='$users.content' @PaginationChangePage="$users.GetAPI" @click="$users.ScrollUp()"
            :itemClasses="[
                'bg-white',
                'text-gray-500',
                'border-gray-300',
                '',
            ]"
            :activeClasses="[
                'bg-primary-600',
                'text-white',
                '',
                '',
            ]"/>
    </div>
</template>

<script setup lang="ts">
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'

import { TailwindPagination } from 'laravel-vue-pagination';

const $users = useClientStaffStore()
</script>
