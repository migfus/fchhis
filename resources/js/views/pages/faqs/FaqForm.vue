<!-- This example requires Tailwind CSS v3.0+ -->
<template>
  <div
    v-if="config.submitted"
    class="mx-auto max-w-7xl py-6 px-10 lg:px-8 bg-white m-4 rounded-xl shadow"
  >
    <div class="mx-auto text-left">
      <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">
        Thank you for your contribution.
        <HeartIcon class="mr-2 h-6 w-6 text-red-400" aria-hidden="true" />
      </h2>
    </div>
  </div>

  <div
    v-else
    class="mx-auto max-w-7xl py-6 px-10 lg:px-8 bg-white m-4 rounded-xl shadow"
  >
    <div class="mx-auto max-w-2xl text-left">
      <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">
        Cant' find questions?
      </h2>
      <div class="mt-4">
        <textarea
          v-model="params.question"
          placeholder="Write some questions on your mind."
          id="about"
          name="about"
          rows="3"
          class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
        />
      </div>

      <div class="sm:col-span-3 mt-4">
        <label for="last-name" class="block text-sm font-medium text-gray-700"
          >Email (Optional)</label
        >
        <div class="mt-1">
          <input
            v-model="params.email"
            placeholder="We will notify you thru email"
            type="text"
            name="last-name"
            id="last-name"
            autocomplete="family-name"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
          />
        </div>
      </div>

      <div class="sm:col-span-3 mt-4">
        <label for="last-name" class="block text-sm font-medium text-gray-700"
          >Phone Number (Optional)</label
        >
        <div class="mt-1">
          <input
            v-model="params.phone"
            placeholder="Server not available."
            type="text"
            name="last-name"
            id="last-name"
            autocomplete="family-name"
            class="bg-gray-200 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
            disabled
          />
        </div>
      </div>

      <p class="mt-4 text-base leading-7 text-gray-600">
        HRMO Staff will moderate your question before it will publish to this
        website. That depends on your question.
      </p>
    </div>

    <div class="py-4 text-end">
      <span class="isolate inline-flex rounded-md shadow-sm mt-1">
        <AppButton @click="config.submitted = true">
          <PaperAirplaneIcon
            class="-ml- mr-2 h-6 w-5 text-white"
            aria-hidden="true"
          />
          Submit
        </AppButton>
      </span>
    </div>
  </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue'

import { PaperAirplaneIcon, HeartIcon } from '@heroicons/vue/20/solid'
import AppButton from '@/components/AppButton.vue'

interface paramsInt {
  question: string
  email: string
  phone: string
}
interface configInt {
  submitted: boolean
}

const params = reactive<paramsInt>({
  question: '',
  email: '',
  phone: '',
})

const config = reactive<configInt>({
  submitted: false,
})
</script>
