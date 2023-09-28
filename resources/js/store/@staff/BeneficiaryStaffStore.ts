import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import { notify } from 'notiwind'
import type { TGQuery } from '@/store/GlobalType'

type TParams = {
    name: string
    bday: Date
    user_id: number
}
type TConfig = {
    loading: boolean
    form?: 'add' | 'edit'
}

const title = '@staff/BeneficiaryStaffStore'
const url = '/api/beneficiary'
export const useBeneficiaryStaffStore = defineStore(title, () => {
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

    async function PostAPI() {
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
            GetAPI()
        }
        catch(e) {
            console.log('UsersStore PostAPI Error', {e})
        }
    }

    // SECTION FUNCTIONS
    function ScrollUp() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function InitParams() {
        return {
            name: null,
            bday: null,
            user_id: null
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
    }
})
