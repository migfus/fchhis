<template>
    <div>
        <div class="mt-5 md:col-span-2 md:mt-0 mb-2">
            <Form v-slot="{ errors }" :validation-schema="schema" @submit="$trans.PostAPI()">
                <div class="shadow sm:overflow-hidden sm:rounded-xl">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6 border-1 border-green-500">
                        <h2 class="font-semibold">Add Transaction</h2>


                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$trans.params.or" placeholder="OR (Optional)" name="or"/>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$trans.params.amount" placeholder="Amount" type="number" name="amount"/>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <AppSelect v-model="$trans.params.plan_detail_id" name="plan" placeholder="Plan">
                                    <option v-for="row in $plan.content" :key="row.id" :value="row.plan_detail[0].id">{{ row.name }}</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <AppSelect v-model="$trans.params.pay_type_id" name="pay_type" placeholder="Pay Type">
                                    <option v-for="row in $paytype.content" :key="row.id" :value="row.id">{{ row.name }}</option>
                                </AppSelect>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white px-4 py-6 text-right sm:px-6 flex justify-end gap-2">
                        <AppButton color="success" type="submit" :disabled="Object.keys(errors).length != 0">Add</AppButton>
                        <AppButton @click="$trans.ChangeForm()" color="white">Cancel</AppButton>
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useUserTransactionStaffStore } from '@/store/@staff/UserTransactionStaffStore'
import { usePaymentTypeSelectionStore } from '@/store/selection/PaymentTypeSelectionStore'
import { usePlanSelectionStore } from '@/store/selection/PlanSelectionStore'
import * as Yup from 'yup'
import { onMounted } from 'vue'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppSelect from '@/components/AppSelect.vue'

configure({
    validateOnInput: true
})

const $trans = useUserTransactionStaffStore()
const $paytype = usePaymentTypeSelectionStore()
const $plan = usePlanSelectionStore()

const schema = Yup.object({
    amount: Yup.string().required('Amount is Required'),
})

onMounted(() => {
    $paytype.GetAPI()
    $plan.GetAPI()
})
</script>
