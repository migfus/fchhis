<template>
    <div>
        <div class="mt-5 md:col-span-2 md:mt-0 mb-2">
            <Form v-slot="{ errors }" :validation-schema="schema" @submit="$ben.PostAPI()">
                <div class="shadow sm:overflow-hidden sm:rounded-xl">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6 border-1 border-green-500">
                        <h2 class="font-semibold">Add Transaction</h2>


                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$ben.params.name" placeholder="OR (Optional)" name="or"/>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$ben.params.bday" placeholder="Amount" type="number" name="amount"/>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <AppSelect v-model="$ben.params.bday" name="plan" placeholder="Plan">
                                    <option>test</option>
                                </AppSelect>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <AppSelect v-model="$ben.params.bday" name="pay_type" placeholder="Pay Type">
                                    <option>test</option>
                                </AppSelect>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white px-4 py-6 text-right sm:px-6 flex justify-end gap-2">
                        <AppButton color="success" type="submit" :disabled="Object.keys(errors).length != 0">Add</AppButton>
                        <AppButton @click="$ben.ChangeForm()" color="white">Cancel</AppButton>
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useBeneficiaryStaffStore } from '@/store/@staff/BeneficiaryStaffStore'
import * as Yup from 'yup'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppSelect from '@/components/AppSelect.vue'

configure({
    validateOnInput: true
})

const $ben = useBeneficiaryStaffStore()

const schema = Yup.object({
    name: Yup.string().required('Name is Required'),
    bday: Yup.date().typeError('Invalid Date').required('Date is Required'),
})
</script>
