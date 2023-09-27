<template>
    <div>
        <UserSummaryCards />
        <AddClientPage />
        <SearchCard />
        <ContentCard/>
        <PaginationCard />
    </div>
</template>

<script setup lang="ts">
import SearchCard from './search/SearchCard.vue'
import ContentCard from './content/ContentClientCard.vue'
import PaginationCard from './content/PaginationCard.vue'
import UserSummaryCards from './content/UserSummaryCards.vue'
import AddClientPage from './forms/AddClientCard.vue'
</script>
