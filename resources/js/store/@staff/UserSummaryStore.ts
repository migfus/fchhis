import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import type { TGConfig, TGQuery } from '@/store/GlobalType'

const title = '@staff/UserSummary'
const url = '/api/users'
export const useUserSummaryStore = defineStore(title, () => {
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TGConfig>({ loading: false })

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
                params: { summary: true }
            })
            content.value = data
        }
        catch(e) {
            console.log('UserSummary GetAPI Error', {e})
        }
        config.loading = false
    }

    return {
        content,
        config,

        GetAPI,
        CancelAPI,
    }
})
