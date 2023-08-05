<template>
  <button type="button" :class="['ml-2 shadow focus:shadow-none relative inline-flex items-center rounded-md border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50', injectClass]">
    <component :is="icon" :class="['h-5 w-5 mr-1', injectIconClass]" aria-hidden="true" />
    <slot>

    </slot>
  </button>
</template>

<script setup lang="ts">
import { toRefs } from 'vue'
const $props = defineProps({
  icon: {

  },
  injectClass: {
    type: String,
    default: '',
  },
  injectIconClass: {
    type: String,
    default: '',
  }
})


const { icon, injectClass, injectIconClass } = toRefs($props)
</script>
