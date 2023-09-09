<template>
  <RouterLink :to="{name: $props.linkName}" :class="[$route.name == $props.linkName ? 'bg-gray-700 text-gray-50' : 'text-gray-300 hover:bg-gray-600 hover:text-gray-50', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
      <component :is="icon" :class="[$route.name == $props.linkName ? 'text-gray-100' : 'text-gray-400 group-hover:text-gray-300', 'mr-4 flex-shrink-0 h-6 w-6']" aria-hidden="true"/>
      <slot></slot>
      <div v-if="$props.span" :class="[$props.span.count, 'relative inline-flex items-center justify-center w-6 h-6 text-xs font-bold rounded-full -top-2 _right-1']">{{ $props.span.count }}</div>
    </RouterLink>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'

const $route = useRoute()
const $props = defineProps<{
  linkName: string
  icon: any // component
  span?: {
    count: bigint
    lColor: string
    rColor: string
  }
}>()
</script>

<style scoped>

</style>
