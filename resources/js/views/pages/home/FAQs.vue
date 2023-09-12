<!-- This example requires Tailwind CSS v3.0+ -->
<template>
    <div class="bg-zinc-100">
        <div class="mx-auto max-w-7xl px-6 py-24 sm:pt-32 lg:py-40 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8">
                <div class="lg:col-span-5">
                    <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Frequently asked questions</h2>
                    <p class="mt-4 text-base leading-7 text-gray-600">Can’t find the answer you’re looking for? Reach out to our <a href="#" class="font-semibold text-primary-700 hover:text-primary-600">customer support</a> team.</p>
                </div>
                <div class="mt-10 lg:col-span-7 lg:mt-0">
                    <dl class="space-y-10">
                        <div v-for="faq in $faq.content" :key="`${faq.id}`">
                            <dt class="text-base font-semibold leading-7 text-gray-900">{{ faq.question }}</dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">{{ faq.answer }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted } from 'vue'
import { useFaqPublicStore } from '@/store/faq/FaqPublicStore'

const $faq = useFaqPublicStore();

onMounted(() => {
    $faq.GetAPI()
})
onUnmounted(() => {
    $faq.CancelAPI()
})
</script>
