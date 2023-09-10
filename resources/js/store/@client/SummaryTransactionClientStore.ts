import { defineStore } from 'pinia'
import axios from 'axios'
import { useStorage, StorageSerializers } from '@vueuse/core'
import { reactive } from 'vue'
import type { TGConfig } from '../GlobalType'

const title = '@client/SummaryTransactionStore'
const url = '/api/statistic'
export const useSummaryTrsansactionSore = defineStore(title, () => {
    const CancelToken = axios.CancelToken
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TGConfig>({ loading: false })

    // SECTION API
    async function GetAPI() {
        config.loading = true
        try {
            let { data: {data}} = await axios.get(url, { cancelToken: new CancelToken(function executor(c) { cancel = c; }) })
            content.value = data
        }
        catch(e) {
            console.log('SummaryTransacionStore GetAPI Error', {e})
        }
        config.loading = false
    }

    function CancelAPI() {
        cancel()
        content.value = null
    }

    return {
        content,
        config,

        GetAPI,
        CancelAPI,
    }
})
