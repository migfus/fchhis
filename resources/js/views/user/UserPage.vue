<template>
    <div class="grid grid-cols-1 lg:grid-cols-2 mb-2 gap-2">
        <UserDetailCard />
        <BeneficiaryCard />
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
        <!-- <UserDetailCard /> -->
    </div>
</template>

<script setup lang="ts">
import UserDetailCard from './cards/UserDetailCard.vue'
import TransactionCard from './cards/TransactionCard.vue'
import BeneficiaryCard from './cards/BeneficiaryCard.vue'
</script>

<style scoped>

</style>
