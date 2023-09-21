import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import type { TGConfig, TGQuery } from '../GlobalTypes'

const title = '@client/BeneficiariesStore'
const url = '/api/beneficiary'
export const useBeneficiaryStore = defineStore(title, () => {
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TGConfig>({ loading: false })
    const query = reactive<TGQuery>({
        search: '',
        filter: null,
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
            let { data: {data}} = await axios.get(url, {
                cancelToken: new CancelToken(function executor(c) { cancel = c; }),
                params: { ...query }
            })
            content.value = data
        }
        catch(e) {
            console.log('UsersStore GetAPI Error', {e})
        }
        config.loading = false
    }

    return {
        content,
        config,
        query,

        GetAPI,
        CancelAPI,
    }
})
