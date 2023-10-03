<template>
    <div>
        <div class="mt-5 md:col-span-2 md:mt-0 mb-2">
            <Form v-slot="{errors}" action="#" method="POST">
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                        <h2 class="font-semibold">Add Beneficiary</h2>


                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <AppInput v-model="form.email" placeholder="Email" name="email"/>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <AppInput v-model="form.email" placeholder="BirthDay" type="date" name="bday"/>
                            </div>

                        </div>
                    </div>
                    <div class="bg-white px-4 py-6 text-right sm:px-6">
                        <AppButton color="success" class="inline-flex">Add</AppButton>
                    </div>
                </div>
            </Form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue'
import { useAddressStore } from '@/store/system/AddressStore'

import { Form, configure } from 'vee-validate'
import AppButton from '@/components/AppButton.vue'
import AppInput from '@/components/AppInput.vue'
import AppSelect from '@/components/AppSelect.vue'

const $address = useAddressStore()

const form = reactive({
    avatar: '',
    name: '',
    email: '',
    sex: false,
    bplace_id: 258,
    bday: '',
    address_id: 258,
    address: '',
    mobile: '',
})
const bday_province_id = ref(16)
const address_province_id = ref(16)

onMounted(async () => {
    await $address.GetAPI()
})
</script>
