import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import { notify } from 'notiwind'
import type { TGAuthContent } from '../GlobalType'
import { useRoute } from 'vue-router'

type TParams = {
    email: string
    password: string
    name: string
    sex: boolean
    bplace_id: number
    bday: Date
    address: string
    address_id: number
    mobile: number

    agent: { id: number }
    plan: {id: number }
    payment_type: { id: number }
}
type TConfig = {
    loading: boolean
    form?: 'edit'
}

const title = '@staff/UserStaffStore'
const url = '/api/users'
export const useUserStaffStore = defineStore(title, () => {
    const $route = useRoute()
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage<TGAuthContent>(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TConfig>({
        loading: false,
        form: null
    })
    const params = reactive<TParams>(InitParams())

    // SECTION API
    function CancelAPI() {
        cancel()
        content.value = null
    }

    async function ShowAPI() {
        config.loading = true
        try {
            let { data: {data} } = await axios.get(`${url}/${$route.params.id}`, { cancelToken: new CancelToken(function executor(c) { cancel = c; }), })
            content.value = data
        }
        catch(e) {
            console.log(`${title} GetAPI Error`, {e})
        }
        config.loading = false
    }

    async function UpdateAPI() {
        try {
            let { data: { data }} = await axios.post(url, params)
            console.log('postapi', {data})

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'New client has been added'
                }, 5000)
            }

            ChangeForm()
            ShowAPI()
        }
        catch(e) {
            console.log('UsersStore PostAPI Error', {e})
        }
    }

    function InitParams() {
        return {
            email: null,
            password: null,
            name: null,
            sex: true,
            bplace_id: 258,
            bday: null,
            address: null,
            address_id: 258,
            mobile: null,

            agent: null,
            plan: null,
            payment_type: null,
        }
    }

    function ChangeForm(form = null) {
        if(!form) {
            Object.assign(params, InitParams())
        }
        config.form = form
    }

    return {
        content,
        config,
        params,

        ShowAPI,
        CancelAPI,
        UpdateAPI,

        ChangeForm,
    }
})
