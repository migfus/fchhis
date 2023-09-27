import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import type { TGConfig, TGQuery } from '@/store/GlobalType'

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

    agent_id: number
    plan_id: number
    payment_type_id: number
}
type TConfig = {
    loading: boolean
    form?: 'add'
}

const title = '@staff/ClientStaffStore'
const url = '/api/users/client'
export const useClientStaffStore = defineStore(title, () => {
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
            console.log('UsersStore GetAPI Error', {e})
        }
        config.loading = false
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

            agent_id: null,
            plan_id: null,
            payment_type_id: null,
        }
    }

    return {
        content,
        config,
        query,
        params,

        GetAPI,
        CancelAPI,

        ScrollUp,
    }
})
