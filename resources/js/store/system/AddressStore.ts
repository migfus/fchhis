import axios from 'axios'
import { useStorage, StorageSerializers } from '@vueuse/core'
import { defineStore } from 'pinia'
import type { TGAddress } from '../GlobalType'

const title = 'system/AddressStore'
const url = '/api/public/address'
export const useAddressStore = defineStore('system/AddressStore', () => {
    const content = useStorage<Array<TGAddress>>(`${title}/content`, null, localStorage, { serializer: StorageSerializers.object })

    async function GetAPI() {
        try {
            let { data } = await axios.get(url)
            content.value = data
        }
        catch(err) {
            console.log(err)
        }
    }

    return {
        content,

        GetAPI
    }
})
