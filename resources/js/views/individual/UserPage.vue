<template>
    <div v-if="$user.content" class="grid grid-cols-1 lg:grid-cols-2 mb-2 gap-2">
        <UserDetailCard v-if="$user.content.info"/>
        <BeneficiaryCard />
    </div>
    <div class="grid grid-cols-1">
        <SearchTransaction />
    </div>
</template>

<script setup lang="ts">
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'
import { onMounted } from 'vue'

import UserDetailCard from './cards/UserDetailCard.vue'
import SearchTransaction from './search/SearchTransaction.vue'
import BeneficiaryCard from './cards/BeneficiaryCard.vue'

const $user = useUserStaffStore()

onMounted(async () => {
    await $user.ShowAPI()
})
</script>
