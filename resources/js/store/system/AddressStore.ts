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

    function CityIDToFullAddress(id: number | bigint) {
        if(id) {
            for (let i = 0; content.value.length > i; i++) {
                const province = content.value[i];
                for (let f = 0; province.cities.length > f; f++) {
                    if (province.cities[f].id == id) {
                        return `${province.cities[f].name}, ${province.name}`;
                    }
                }
            }
        }
        return null;
    };

    return {
        content,

        GetAPI,
        CityIDToFullAddress
    }
})
