import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import { notify } from 'notiwind'
import type { TGQuery } from '@/store/GlobalType'

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
    plan_detail: {id: number }
    payment_type: { id: number }
}
type TConfig = {
    loading: boolean
    form?: 'add'
}

const title = '@staff/AgentStaffStore'
const url = '/api/users/agent'
export const useAgentStaffStore = defineStore(title, () => {
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TConfig>({
        loading: false,
        form: null
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

    async function GetAPI(page = 1) {
        config.loading = true
        try {
            let { data: {data}} = await axios.get(url, {
                cancelToken: new CancelToken(function executor(c) { cancel = c; }),
                params: { ...query, page: page }
            })
            content.value = data
        }
        catch(e) {
            console.log(`${title} UsersStore GetAPI Error`, {e})
        }
        config.loading = false
    }

    async function PostAPI() {
        try {
            let { data: { data }} = await axios.post(url, params)
            console.log('postapi', {data})

            if(data === true) {
                notify({
                    group: "success",
                    title: "Success",
                    text: 'New agent has been added'
                }, 5000)
            }

            ChangeForm()
            GetAPI()
        }
        catch(e) {
            console.log(`${title} PostAPI Error`, {e})
        }
    }

    // SECTION FUNCTIONS
    function ScrollUp() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
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
            plan_detail: null,
            payment_type: null,
        }
    }

    function ChangeForm(form = null) {
        if(!form) {
            Object.assign(params, InitParams())
        }
        config.form = form
        ScrollUp()
    }

    return {
        content,
        config,
        query,
        params,

        GetAPI,
        CancelAPI,
        PostAPI,

        ChangeForm,
        ScrollUp,
    }
})
