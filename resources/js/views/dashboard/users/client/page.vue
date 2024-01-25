<script setup lang="ts">
import SearchCard from './~Comp/SearchCard.vue'
import ContentCard from './~Comp/ContentClientCard.vue'
import PaginationCard from './~Comp/PaginationCard.vue'
import UserSummaryCards from './~Comp/UserSummaryCards.vue'
</script>

<template>
  <div>
    <UserSummaryCards />
    <SearchCard />
    <ContentCard />
    <PaginationCard />
  </div>
</template>
