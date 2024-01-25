<template>
    <div>
        <div class="mt-5 md:col-span-2 md:mt-0 mb-2">
            <Form v-slot="{ errors }" :validation-schema="schema" @submit="$ben.UpdateAPI()">
                <div class="shadow sm:overflow-hidden sm:rounded-xl">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <h2 class="font-semibold">Update Beneficiary</h2>


                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$ben.params.name" placeholder="Name" name="name"/>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <AppInput v-model="$ben.params.bday" placeholder="BirthDay" type="date" name="bday"/>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white px-4 py-6 text-right sm:px-6 flex justify-end gap-2">
                        <AppButton @click="show = true" color="danger">Remove</AppButton>
                        <AppButton color="warning" type="submit" :disabled="Object.keys(errors).length != 0">Update</AppButton>
                        <AppButton @click="$ben.ChangeForm()" color="white">Cancel</AppButton>
                    </div>
                </div>
            </Form>
        </div>
        <PromptModal title="Remove Beneficiary?" confirmButtonName="Remove" @confirm="$ben.DestroyAPI()" v-model="show">
            <p class="text-gray-500">Are you sure you want to remove this beneficiary? This action cannot be undone.</p>
        </PromptModal>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import * as Yup from 'yup'
import { useBeneficiaryStaffStore } from '@/store/@staff/BeneficiaryStaffStore'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import PromptModal from '@/components/modals/PromptModal.vue'

configure({
    validateOnInput: true
})

const $ben = useBeneficiaryStaffStore()

const schema = Yup.object({
    name: Yup.string().required('Name is Required'),
    bday: Yup.date().typeError('Invalid Date').required('Date is Required'),
})

const show = ref(false)
</script>
