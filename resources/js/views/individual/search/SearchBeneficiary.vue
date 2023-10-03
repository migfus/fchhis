<template>
    <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6 mb-2">
        <h2 class="font-semibold mb-4">Beneficiaries</h2>

        <div class="grid grid-cols-1">
            <div class="lg:col-span-2">
                <AppInput v-model="$users.query.search" type="text" name="search" placeholder="Search"/>
            </div>

            <div class="flex justify-end gap-1 mt-4">
                <AppButton :loading="$users.config.loading" color="white">Print</AppButton>
                <AppButton @click="$users.ChangeForm('add')" :loading="$users.config.loading" color='success'>Add</AppButton>
            </div>


        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, watch } from 'vue'
import { useClientStaffStore } from '@/store/@staff/ClientStaffStore'
import { throttle } from 'lodash'
import moment from 'moment'

import AppInput from '@/components/AppInput.vue'
import AppButton from '@/components/AppButton.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'

const $users = useClientStaffStore()

onMounted(() => {
    $users.GetAPI()
})

watch($users.query, throttle(() => {
    $users.GetAPI()
}, 1000))
</script>
