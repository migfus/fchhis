import { ref, reactive } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'
import type { TGConfig, TGQuery } from '../GlobalType'
import { useStorage, StorageSerializers } from '@vueuse/core'

interface contentInt {
    category: { name: string }
    content: string
    cover: string
    created_at: string
    id: number
    title: string
    user: { email: string }
    question: string
    answer: string
}

const title = 'faq/FaqPublicStore'
const url = '/api/public/faq'
export const useFaqPublicStore = defineStore(title, () => {
    const content = useStorage<Array<contentInt>>(`${title}/content`, null, sessionStorage, { serializer: StorageSerializers.object })
    const config = reactive<TGConfig>({
        loading: false,
    })
    const query = reactive<TGQuery>({
        search: '',
        sort: 'ASC',
    })

    async function GetAPI() {
        config.loading = true
        try {
            let { data: { data }} = await axios.get(url, { params: query})
            content.value = data
        }
        catch(err) {
            console.error(err)
        }
        config.loading = false
    }

    return {
        content,
        config,
        query,

        GetAPI,
    }
});
