<script setup lang="ts">
import { onMounted, ref, reactive } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'

interface contentInt {
  title: string
  content: string
  cover: string
}

const $route = useRoute()
const config = reactive({
  loading: false,
})
const content = ref<contentInt>({
  title: '',
  content: '',
  cover: '',
})

async function ShowAPI() {
  config.loading = true
  try {
    let {
      data: { data },
    } = await axios.get(`/api/public/post/${$route.params.id}`)
    content.value = data
    console.log(data)
  } catch (err) {
    console.log(err)
  }
  config.loading = false
}

onMounted(() => {
  ShowAPI()
})
</script>

<template>
  <div v-if="content" class="relative bg-white py-16 sm:py-24">
    <div
      class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-cols-2 lg:items-start lg:gap-24 lg:px-8"
    >
      <div class="relative sm:py-16 lg:py-0">
        <div
          aria-hidden="true"
          class="hidden sm:block lg:absolute lg:inset-y-0 lg:right-0 lg:w-screen"
        >
          <div
            class="absolute inset-y-0 right-1/2 w-full rounded-r-3xl bg-gray-50 lg:right-72"
          />
          <svg
            class="absolute top-8 left-1/2 -ml-3 lg:-right-8 lg:left-auto lg:top-12"
            width="404"
            height="392"
            fill="none"
            viewBox="0 0 404 392"
          >
            <defs>
              <pattern
                id="02f20b47-fd69-4224-a62a-4c9de5c763f7"
                x="0"
                y="0"
                width="20"
                height="20"
                patternUnits="userSpaceOnUse"
              >
                <rect
                  x="0"
                  y="0"
                  width="4"
                  height="4"
                  class="text-gray-200"
                  fill="currentColor"
                />
              </pattern>
            </defs>
            <rect
              width="404"
              height="392"
              fill="url(#02f20b47-fd69-4224-a62a-4c9de5c763f7)"
            />
          </svg>
        </div>
        <div
          class="relative mx-auto max-w-md px-6 sm:max-w-3xl lg:max-w-none lg:px-0 lg:py-20"
        >
          <!-- Testimonial card-->
          <div
            class="relative overflow-hidden rounded-2xl pt-64 pb-10 shadow-xl h-80"
          >
            <img
              class="absolute inset-0 h-full w-full object-cover"
              :src="content.cover"
              alt=""
            />
          </div>
        </div>
      </div>

      <div class="relative mx-auto max-w-md px-6 sm:max-w-3xl lg:px-0">
        <!-- Content area -->
        <div class="pt-12 sm:pt-16 lg:pt-20">
          <h2
            class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"
          >
            {{ content.title }}
          </h2>
          <div class="mt-6 space-y-6 text-gray-500">
            <p class="text-lg">{{ content.content }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
