<template>
    <div>
        <UserSummaryCards />

        <AddClientPage v-if="$user.config.form == 'add'"/>

        <SearchCard />
        <ContentCard/>
        <PaginationCard />
    </div>
</template>

<script setup lang="ts">
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'

import SearchCard from './search/SearchCard.vue'
import ContentCard from './content/ContentClientCard.vue'
import PaginationCard from './content/PaginationCard.vue'
import UserSummaryCards from './content/UserSummaryCards.vue'
import AddClientPage from './forms/AddClientCard.vue'

const $user = useClientStaffStore()
</script>
