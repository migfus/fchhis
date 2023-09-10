<template>
    <div>
        <TransactionSummaryCard v-if="$auth.content.auth.roles[0].name == 'Client'"/>
        <!-- <TransactionSummaryCard /> -->
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/auth/AuthStore'

import TransactionSummaryCard from '@/views/dashboard/@client/TransactionSummaryCard.vue'

const $auth = useAuthStore()
</script>
