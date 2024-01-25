<template>
  <div class="bg-zinc-100">
    <div class="grid grid-cols-3 mx-auto max-w-7xl">
      <div
        class="py-6 px-6 lg:px-8 bg-white m-4 rounded-xl shadow col-span-3 lg:col-span-2"
      >
        <div class="mx-auto max-w-2xl text-center">
          <h2
            class="text-2xl font-bold leading-10 tracking-tight text-gray-900"
          >
            Frequently asked questions
          </h2>
          <div class="mt-4">
            <input
              v-model="$faq.query.search"
              type="text"
              name="search"
              id="search"
              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
              placeholder="Search some Frequentle Ask Questions"
            />
          </div>
          <p class="mt-4 text-base leading-7 text-gray-600">
            Have a different question and can’t find the answer you’re looking
            for? Try submit new question and we’ll answer to you as soon as we
            can.
          </p>
        </div>

        <div class="mt-6 col-span-3 lg:col-span-1">
          <dl class="sm:grid sm:grid-cols-1 sm:gap-x-6 sm:gap-y-4 sm:space-y-4">
            <DataTransition>
              <div v-for="row in $faq.content" :key="row.id">
                <dt class="text-base font-semibold leading-7 text-gray-900">
                  {{ row.question }}
                </dt>
                <dd class="mt-2 text-base leading-7 text-gray-600">
                  {{ row.answer }}
                </dd>
              </div>
            </DataTransition>
          </dl>
        </div>
      </div>

      <FaqForm class="col-span-3 lg:col-span-1" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, onUnmounted, watch } from 'vue'
import { throttle } from 'lodash'
import { useFaqPublicStore } from '@/store/faq/FaqPublicStore'

import FaqForm from './FaqForm.vue'
import DataTransition from '@/components/transitions/DataTransition.vue'

const $faq = useFaqPublicStore()

onMounted(() => {
  $faq.GetAPI()
})

onUnmounted(() => {
  $faq.CancelAPI()
})

watch(
  $faq.query,
  throttle(() => {
    $faq.GetAPI()
  }, 1000),
)
</script>
