<template>
    <div v-if="$user.content" class="bg-white rounded-lg shadow">
        <div class="mx-auto max-w-7xl py-8 px-8">
            <div class="space-y-12 lg:grid">
                <div class="lg:col-span-2">
                    <ul role="list" class="space-y-12 sm:-mt-8 sm:space-y-0 sm:divide-y sm:divide-gray-200 lg:gap-x-8 lg:space-y-0">
                        <li class="sm:py-8">
                            <div class="space-y-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-6 sm:space-y-0">
                                <div class="aspect-w-3 aspect-h-2 sm:aspect-w-3 sm:aspect-h-4">
                                    <img class="rounded-full w-28 h-auto shadow-lg" :src="$user.content.avatar ?? 'http://127.0.0.1:8000/images/logo.png'" alt="" />
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="space-y-4">
                                        <div class="space-y-1 text-lg font-medium leading-6">
                                            <h3>{{ $user.content.name }}</h3>
                                            <p class="text-primary-600">{{ $user.content.roles[0].name }}</p>
                                        </div>
                                        <div class="text-lg">
                                            <!-- <p class="text-gray-500">{{ person.bio }}</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>24
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang='ts'>
import { onMounted } from 'vue'
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'

const $user = useUserStaffStore()

onMounted(() => {
    // $user.ShowAPI()
})
</script>
