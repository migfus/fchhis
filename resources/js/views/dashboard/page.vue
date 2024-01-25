<template>
  <div class="grid">
    <TransactionSummaryCard
      class="col-span-2"
      v-if="$auth.content.auth.roles[0].name == 'Client'"
    />
  </div>
  <div class="grid grid-cols-1 xl:grid-cols-3 gap-3">
    <TransactionCard
      class="col-span-2"
      v-if="$auth.content.auth.roles[0].name == 'Client'"
    />
    <BeneficiaryCard v-if="$auth.content.auth.roles[0].name == 'Client'" />
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/auth/AuthStore'

import TransactionSummaryCard from '@/views/dashboard/~Comp/TransactionSummaryCard.vue'
import BeneficiaryCard from '@/views/dashboard/~Comp/BeneficiaryCard.vue'
import TransactionCard from '@/views/dashboard/~Comp/TransactionCard.vue'

const $auth = useAuthStore()
</script>
