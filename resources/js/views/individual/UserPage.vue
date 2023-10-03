<template>
    <HeaderCard/>
    <div class="grid grid-cols-1 lg:grid-cols-4 mb-2 gap-2">
        <div class="col-span-3">
            <BeneficiariesCard/>
            <InfoCard />

            <SearchTransaction />
        </div>
        <div>
            <StatusCard />
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

import SearchTransaction from './search/SearchTransaction.vue'
import HeaderCard from './cards/HeaderCard.vue'
import BeneficiariesCard from './cards/BeneficiariesCard.vue'
import StatusCard from './cards/StatusCards.vue'
import InfoCard from './cards/InfoCard.vue'

const $user = useUserStaffStore()
const $ben = useBeneficiaryStaffStore()

onMounted(async () => {
    $ben.GetAPI()
    await $user.ShowAPI()
})
</script>
