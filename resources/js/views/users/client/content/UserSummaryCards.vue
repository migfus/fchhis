<template>
    <div v-if="$users.config.loading">
        Loading
    </div>
    <div v-else>
        <Carousel :breakpoints="config.breakpoints" class="mb-2">
            <Slide v-for="row in $users.content" :key="row.name" class="max-w-full">

                    <div class="max-w-full">
                        <div class="max-w-full rounded-lg bg-white p-2 shadow-lg sm:p-3">
                            <div class="items-center justify-between">
                                <div class="flex flex-1 items-center">
                                    <span class="flex rounded-lg bg-gray-100 p-2">
                                        <UsersIcon v-if="row.name == 'Clients'" class="h-6 w-6 text-gray-700" aria-hidden="true" />
                                        <PresentationChartLineIcon v-else class="h-6 w-6 text-gray-700" aria-hidden="true" />
                                    </span>
                                    <p class="ml-3 truncate font-medium text-gray-500">
                                        <span>{{ row.name }}: </span>
                                        <span class="text-primary-700">{{ row.total }} | </span>
                                        <span class='text-green-700'>+{{ row.current }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

            </Slide>

            <template #addons>
                <Navigation />
            </template>
        </Carousel>
    </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useUserSummaryStore } from '@/store/@staff/UserSummaryStore'

import { Carousel, Navigation, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import { UsersIcon, PresentationChartLineIcon } from '@heroicons/vue/24/outline'

const $users = useUserSummaryStore()

const config = {
    autoplay: 10 * 1000,
    bind: {
        itemsToShow: 1,
        snapAlign: 'center',
    },
    breakpoints: {
        500: {
            itemsToShow: 1,
            snapAlign: 'center',
        },
        700: {
            itemsToShow: 3,
            snapAlign: 'center',
        },
    }
};

onMounted(() => {
    $users.GetAPI()
})
</script>
