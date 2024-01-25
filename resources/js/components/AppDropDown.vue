<script setup lang="ts">
import { Field, ErrorMessage } from 'vee-validate'

const $props = defineProps({
  placeholder: String,
  name: String,
})
const $model = defineModel()
</script>

<template>
  <label :for="$props.name" class="block text-sm font-medium text-gray-700">{{
    $props.placeholder
  }}</label>
  <Field
    :placeholder="$props.placeholder"
    v-model="$model"
    :name="$props.name"
    :id="$props.name"
    class="mt-1 block w-full rounded-md border border-gray-300 py-2 px-3 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-primary-500 sm:text-sm"
  />
  <ErrorMessage :name="$props.name" class="text-sm font-medium text-red-500" />
</template>
