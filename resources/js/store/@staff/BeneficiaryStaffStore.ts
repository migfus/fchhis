import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import { notify } from 'notiwind'
import type { TGQuery } from '@/store/GlobalType'
import { useRoute } from 'vue-router'

type TParams = {
    name: string
    bday: Date
    user_id: number
    id: number
}
type TConfig = {
    loading: boolean
    formID?: number
}

const title = '@staff/BeneficiaryStaffStore'
const url = '/api/beneficiary'
export const useBeneficiaryStaffStore = defineStore(title, () => {
    const $route = useRoute()
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TConfig>({
        loading: false,
        formID: null
    })
    const query = reactive<TGQuery>({
        search: '',
        filter: 'name',
        sort: 'DESC',
        start: null,
        end: null,
    })
    const params = reactive<TParams>(InitParams())

    // SECTION API
    function CancelAPI() {
        cancel()
        content.value = null
    }

    async function GetAPI() {
        config.loading = true
        try {
            let { data: {data}} = await axios.get(url, {
                cancelToken: new CancelToken(function executor(c) { cancel = c; }),
                params: { ...query, user_id: $route.params.id }
            })
            content.value = data
        }
        catch(e) {
            console.log(`${title} GetAPI Error`, {e})
        }
        config.loading = false
    }

    async function PostAPI() {
        try {
            let { data: { data }} = await axios.post(url, { ...params, user_id: $route.params.id})
            console.log('postapi', {data})

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'New client has been added'
                }, 5000)
            }

            ChangeForm()
            GetAPI()
        }
        catch(e) {
            console.log('UsersStore PostAPI Error', {e})
        }
    }
    async function UpdateAPI() {
        try {
            let { data: { data }} = await axios.put(`${url}/${params.id}`, params)
            console.log('postapi', {data})

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'Beneficiary has been updated'
                }, 5000)
            }

            ChangeForm()
            GetAPI()
        }
        catch(e) {
            console.log('UsersStore PostAPI Error', {e})
        }
    }

    async function DestroyAPI() {
        try {
            let { data: { data }} = await axios.delete(`${url}/${params.id}`)
            console.log('postapi', {data})

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'New client has been added'
                }, 5000)
            }

            ChangeForm()
            GetAPI()
        }
        catch(e) {
            console.log('UsersStore PostAPI Error', {e})
        }
    }

    // SECTION FUNCTIONS
    function ScrollUp() {
        // window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function InitParams() {
        return {
            name: null,
            bday: null,
            user_id: null,
            id: null,
        }
    }

    function ChangeForm(form = null) {
        if(!form) {
            Object.assign(params, InitParams())
        }
        config.formID = form
        ScrollUp()
    }

    function SelectedItem(row: TParams = null) {
        if(!row) {
            Object.assign(params, InitParams())
            config.formID = 0
        }
        else {
            config.formID = row.id
            Object.assign(params, row)
        }
    }

    return {
        content,
        config,
        query,
        params,

        GetAPI,
        CancelAPI,
        PostAPI,
        UpdateAPI,
        DestroyAPI,

        ChangeForm,
        SelectedItem,
    }
})
