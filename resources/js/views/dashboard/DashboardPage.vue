<template>
    <div class="grid">
        <TransactionSummaryCard class="col-span-2" v-if="$auth.content.auth.roles[0].name == 'Client'"/>
    </div>
    <div class="grid xl:grid-cols-3 gap-3">
        <TransactionSummaryCard class="col-span-2" v-if="$auth.content.auth.roles[0].name == 'Client'"/>
        <BeneficiaryCard v-if="$auth.content.auth.roles[0].name == 'Client'"/>
    </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/auth/AuthStore'

import TransactionSummaryCard from '@/views/dashboard/@client/TransactionSummaryCard.vue'
import BeneficiaryCard from '@/views/dashboard/@client/BeneficiaryCard.vue'

const $auth = useAuthStore()
</script>
