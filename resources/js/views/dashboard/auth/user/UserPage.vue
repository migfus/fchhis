<template>
  <CardComp injectClass="grid grid-cols-3 gap-x-4 mb-2">
    User {{  $route.params.id  }}
    <ButtonComp :icon="XMarkIcon">Back</ButtonComp>
  </CardComp>
</template>

<script setup lang="ts">
import { useRoute } from 'vue-router'
import { XMarkIcon } from '@heroicons/vue/20/solid'

import CardComp from '@/components/CardComp.vue'
import ButtonComp from '@/components/form/ButtonComp.vue'

const $route = useRoute();
</script>
