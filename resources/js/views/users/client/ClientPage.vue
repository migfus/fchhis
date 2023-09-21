<template>
    <div>
        <SearchCard />
        <ContentCard/>
        <PaginationCard />
    </div>
</template>

<script setup lang="ts">
import SearchCard from './search/SearchCard.vue'
import ContentCard from './content/ContentCard.vue'
import PaginationCard from './content/PaginationCard.vue'
</script>
