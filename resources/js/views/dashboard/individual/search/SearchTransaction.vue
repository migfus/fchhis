<template>
    <BasicTransition>
        <AddTransaction v-if="$trans.config.form == 'add'"/>
        <UpdateTransaction v-else-if="$trans.config.form == 'edit'"/>
    </BasicTransition>
    <div class="bg-white px-4 py-5 shadow sm:rounded-xl sm:p-6">
        <h2 class="font-semibold mb-4">Transactions</h2>

        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 lg:col-span-1">
                <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                <VueDatePicker
                    v-model="$trans.query.start" :enable-time-picker="false"
                    :start-date="moment().startOf('month').format('YYYY-MM-DD')"
                    placeholder="Start Date"
                    auto-apply
                    input-class="rounded-xl"
                />
            </div>

            <div class="col-span-6 lg:col-span-1">
                <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <VueDatePicker
                    v-model="$trans.query.end" :enable-time-picker="false"
                    :start-date="moment().startOf('month').format('YYYY-MM-DD')"
                    placeholder="End Date"
                    auto-apply
                />
            </div>

            <div class="col-span-6 lg:col-span-2">
                <AppSelect v-model="$trans.query.filter" name="filter" placeholder="Filter">
                    <option value="agent">Agent</option>
                    <option value="staff">Staff</option>
                    <option value="or">OR</option>
                    <option value="plan">Plans</option>
                </AppSelect>

            </div>

            <div class="col-span-6 lg:col-span-2">
                <AppInput v-model="$trans.query.search" type="text" name="search" placeholder="Search"/>
            </div>

            <div class="col-span-6 flex justify-end gap-1">
                <AppButton @click="$trans.ChangeForm('add')" :loading="$trans.config.loading" color='success'>Add</AppButton>
            </div>



        </div>
    </div>
</template>

<script setup lang="ts">
import { onMounted, watch } from 'vue'
import { useUserTransactionStaffStore } from '@/store/@staff/UserTransactionStaffStore'
import { useUserStaffStore } from '@/store/@staff/UserStaffStore'
import { throttle } from 'lodash'
import moment from 'moment'

import AppInput from '@/components/AppInput.vue'
import AppButton from '@/components/AppButton.vue'
import AppSelect from '@/components/AppSelect.vue'
import AddTransaction from '../forms/AddTransaction.vue'
import VueDatePicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import BasicTransition from '@/components/transitions/BasicTransition.vue'
import UpdateTransaction from '../forms/UpdateTransaction.vue'

const $trans = useUserTransactionStaffStore()

onMounted(() => {
    $trans.GetAPI()
})

watch($trans.query, throttle(() => {
    $trans.GetAPI()
}, 1000))
</script>
