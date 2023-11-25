import { createStore } from "vuex";
import { notas } from "./notas";
import { useToast } from 'vue-toastification'
const toast = useToast()
export const store = createStore({
    state: {

    },
    actions: {
        showNotification ({state}, value) {
            value.map((x) => {
                toast[x?.type](x?.message);
            })
        },
        showErrors ({state}, value) {
            Object.keys(value).map((x) => {
                toast.error(value[x][0]);
            })
        }
    },
    getters: {

    },
    modules: {
        notas
    }
});