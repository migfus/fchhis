import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import axios from 'axios'
import { reactive } from 'vue'
import type { TGConfig, TGQuery } from '@/store/GlobalType'

const title = 'users/client/ClientStaffStore'
const url = '/api/users/client'
export const useClientStaffStore = defineStore(title, () => {
    const CancelToken = axios.CancelToken;
    let cancel;

    const content = useStorage(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TGConfig>({ loading: false })
    const query = reactive<TGQuery>({
        search: '',
        filter: 'name',
        sort: 'DESC',
        start: null,
        end: null,
    })

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

    return {
        content,
        config,
        query,

        GetAPI,
        CancelAPI,

        ScrollUp,
    }
})
