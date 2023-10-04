import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import type { TGConfig, TGQuery } from '@/store/GlobalType'
import { useRoute } from 'vue-router'

type TConfig = {
    loading: boolean
    form?: 'add' | 'edit'
}

const title = '@staff/UserTransactionStaffStore'
const url = '/api/transaction'
export const useUserTransactionStaffStore = defineStore(title, () => {
    const $route = useRoute()
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TGConfig>({ loading: false })
    const query = reactive<TGQuery>({
        search: '',
        filter: 'name',
        sort: 'DESC'
    })

    // SECTION API
    function CancelAPI() {
        cancel()
        content.value = null
    }

    async function GetAPI() {
        config.loading = true
        try {
            let { data: {data}} = await axios.get(`${url}/${$route.params.id}`, {
                cancelToken: new CancelToken(function executor(c) { cancel = c; }),
                params: query
            })
            content.value = data
        }
        catch(e) {
            console.log(`${title} GetAPI Error`, {e})
        }
        config.loading = false
    }

    function ChangeForm(form = null) {
        config.form = form
    }

    return {
        content,
        config,
        query,

        GetAPI,
        CancelAPI,

        ChangeForm,
    }
})
