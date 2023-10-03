<template>
    <section aria-labelledby="timeline-title" class="lg:col-span-1 lg:col-start-3">
        <div class="bg-white px-4 py-5 shadow sm:rounded-xl sm:px-6">
            <h2 id="timeline-title" class="text-lg font-medium text-gray-900">Timeline</h2>

            <!-- Activity Feed -->
            <div class="mt-6 flow-root">
                <ul role="list" class="-mb-8">
                    <li v-for="row in $auth.content.auth.logs" :key="$auth.content.auth.id.toString()">
                        <div class="relative pb-8">
                            <!-- <span v-if="itemIdx !== timeline.length - 1" class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true" /> -->
                            <div class="relative flex space-x-3">
                                <div>
                                    <!-- <span :class="[item.type.bgColorClass, 'h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white']">
                                        <component :is="item.type.icon" class="h-5 w-5 text-white" aria-hidden="true" />
                                    </span> -->
                                    <span :class="['bg-green-500', 'h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white']">
                                        <component :is="CheckIcon" class="h-5 w-5 text-white" aria-hidden="true" />
                                    </span>
                                </div>
                                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                    <div>
                                        <p class="text-sm text-gray-800">
                                        {{ row.content }}
                                        </p>
                                    </div>
                                    <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                        <time :datetime="row.created_at.toString()">{{ moment(row.created_at).fromNow(true) }}</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/store/auth/AuthStore';
import { CheckIcon} from '@heroicons/vue/20/solid'
import moment from 'moment'

const $auth = useAuthStore()
</script>
