import { defineStore } from 'pinia'
import data from '../data/data.json'

export const useStore = defineStore('store', {
  state: () => {
    return {
        ...data,
        routes: {
            home: "/",
            rooms: "/rooms",
            reviews: "/reviews",
            about: "/about",
        }
    };
  },
})
