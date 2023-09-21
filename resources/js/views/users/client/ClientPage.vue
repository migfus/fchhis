<template>
    <div>
        <UserSummaryCards />
        <SearchCard />
        <ContentCard/>
        <PaginationCard />
    </div>
</template>

<script setup lang="ts">
import SearchCard from './search/SearchCard.vue'
import ContentCard from './content/ContentClientCard.vue'
import PaginationCard from './content/PaginationCard.vue'
import UserSummaryCards from './content/UserSummaryCards.vue';
</script>
