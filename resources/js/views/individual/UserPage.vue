<template>
    <HeaderCard v-if="$user.content"/>
    <div v-if="$user.content" class="grid grid-cols-1 lg:grid-cols-4 mb-2 gap-2">
        <div class="col-span-3">
            <BeneficiariesCard v-if="$user.content.roles[0].name == 'Client'"/>

            <!-- <SearchTransaction /> -->

            <!-- <TransactionCard /> -->
        </div>
        <div>
            <!-- <ClientStatusCard v-if="$user.content.roles[0].name == 'Client'"/> -->
            <!-- <AgentStatusCard v-if="$user.content.roles[0].name == 'Agent'"/> -->

            <InfoCard v-if="$user.content.info"/>
        </div>
    </div>


    <div v-if="$user.content" class="grid grid-cols-1 lg:grid-cols-2 mb-2 gap-2">
    </div>
    <div class="grid grid-cols-1">
    </div>
</template>

<script setup lang="ts">
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'
import { useBeneficiaryStaffStore } from '@/store/@staff/BeneficiaryStaffStore'
import { onMounted } from 'vue'
import { useTitle } from '@vueuse/core'

import SearchTransaction from './search/SearchTransaction.vue'
import HeaderCard from './cards/HeaderCard.vue'
import BeneficiariesCard from './cards/BeneficiariesCard.vue'
import ClientStatusCard from './cards/ClientStatusCards.vue'
import AgentStatusCard from './cards/AgentStatusCard.vue'
import InfoCard from './cards/InfoCard.vue'
import TransactionCard from './cards/TransactionCard.vue'

const $user = useUserStaffStore()
const $ben = useBeneficiaryStaffStore()
const $title = useTitle()

onMounted(async () => {
    $ben.GetAPI()
    await $user.ShowAPI()
    $title.value = `${$user.content.name} | FCHHIS`
})
</script>
