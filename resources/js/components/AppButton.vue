<template>
    <!-- <button :class="['btn', color, size, mr, ml, mb, push]" :type="type" :disabled="$props.disabled"
        :data-dismiss="$props.dataDismiss">
        <i v-if="$props.disabled" class="mr-1 fa fa-ban"></i>
        <i v-else-if="$props.loading" class="fa fa-circle-notch fa-spin"></i>
        <i v-else-if="$props.icon" :class="['fa', $props.icon, hasSlot ? 'mr-1' : '']"></i>
        <slot v-if="!$props.loading"></slot>
    </button> -->

    <button
        :class="[
            'flex justify-center rounded-md border border-transparent py-2 px-4 font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2',
            color,
            size,
            $props.block ? 'w-full' : '',
        ]"
        :disabled="$props.loading || $props.disabled"
        :type="type"
    >

        <div v-if="$props.loading" role="status">
            <svg aria-hidden="true" class="w-5 h-5 mr-2 text-primary-200 animate-spin fill-primary-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>

        <slot></slot>
    </button>
</template>

<script setup lang="ts">
import { computed } from 'vue'

const $props = defineProps<{
    color?: string
    size?: string
    loading?: boolean
    disabled?: boolean
    dataDismiss?: string // for modal (no function, for error fix)
    mr?: string
    ml?: string
    mb?: string
    push?: string
    type?: string
    block?: boolean
}>()

const color = computed(() => {
    if($props.disabled) {
        return 'bg-gray-400 text-black cursor-not-allowed'
    }
    switch ($props.color) {
        case 'danger':
            return 'bg-red-400 hover:bg-red-500 focus:ring-red-400 text-white'
        case 'success' :
            return 'bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500 text-white'
        case 'white':
            return 'border-1 border-slate-300 bg-gray-300 hover:bg-gray-50 focus:ring-slate-400 text-black'
        default:
            return 'bg-primary-600 hover:bg-primary-700 focus:ring-primary-500 text-white'
    }
})

const size = computed(() => {
    switch ($props.size) {
        case 'sm':
            return 'text-sm'
        default:
            return ''
    }
})
const type = computed(() => {
    switch ($props.type) {
        case 'submit':
            return 'submit'
        default:
            return 'button'
    }
})

</script>
