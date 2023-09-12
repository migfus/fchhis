import { defineStore } from 'pinia'
import { reactive } from 'vue'
import { useStorage, StorageSerializers } from '@vueuse/core'
import axios from 'axios'
import type { TGConfig, TGQuery } from '../GlobalType'

interface contentInt {
    id: number
    title: string
    cover: string
    category: { name: string }
    content: string
    user: {
        id: number
        email: string
        avatar: string
    }
    created_at: string
}

const title = 'post/PostPublicStore'
const url = '/api/public/post'
export const usePostPublicStore = defineStore(title, () => {
    const CancelToken = axios.CancelToken
    let cancel;

    const content = useStorage<Array<contentInt>>(`${title}/content`, [], sessionStorage, {serializer: StorageSerializers.object});
    const config = reactive<TGConfig>({
        loading: false
    });
    const query = reactive<TGQuery>({
        search: '',
        sort: 'ASC'
    })

    async function GetAPI() {
        config.loading = true
        try {
            let { data: { data }} = await axios.get(url, {
                params: query,
                cancelToken: new CancelToken(function executor(c) { cancel = c; })
            })
            content.value = data;
        }
        catch(err) {
            console.log('error');
        }
        config.loading = false
    }

    function CancelAPI() {
        cancel()
        content.value = null
    }

    return {
        config,
        content,
        query,

        GetAPI,
        CancelAPI
    }
});
