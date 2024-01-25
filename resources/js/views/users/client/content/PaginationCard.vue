<script setup lang="ts">
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'

import { TailwindPagination } from 'laravel-vue-pagination'

const $users = useClientStaffStore()
</script>

<template>
  <div
    v-if="$users.content"
    class="mt-2 border-b border-gray-200 bg-white px-4 py-5 sm:px-6 sm:rounded-xl shadow flex justify-end"
  >
    <TailwindPagination
      @click="$users.ScrollUp()"
      @PaginationChangePage="$users.GetAPI"
      :data="$users.content"
      :itemClasses="['bg-white', 'text-gray-500', 'border-gray-300', '']"
      :activeClasses="['bg-gray-300', 'text-black', '', '']"
    />
  </div>
</template>
