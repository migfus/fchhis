<template>
  <div class="bg-white px-4 pt-4 sm:px-6 rounded-xl mb-4 shadow">
    <div :class="[injectClass]">
      <slot></slot>

    </div>
  </div>
</template>

<script setup lang='ts'>
import { toRefs } from 'vue'

const $props = defineProps({
  injectClass: {
    type: String,
    default: 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-4',
  }
})

const { injectClass } = toRefs($props)
</script>
