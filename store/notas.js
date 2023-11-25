import axios from "axios";


export const notas = {
    state: {
        notas: [],
        selectedNotes: [],
    },
    actions: {
        getNotas ({state}, value) {
            return new Promise ((resolve) => {
                axios.post("/api/notas", value).then((response) => {
                    let data = response.data;
                    // || Verificar si hay notificaciones y mostrar
                    if (data.notification) {
                        alert(data.notification);
                    }

                    state.notas = data?.notas;
                    resolve();
                });
            });         
        },

        storeNotas ({state, dispatch}, value) {
            return new Promise ((resolve) => {
                axios.post("/api/notas/store", value).then(async (response) => {
                    let data = response.data;
                    // || Verificar si hay notificaciones y mostrar
                    if (data.notifications) {
                        dispatch("showNotification", data.notifications);
                    }

                    if (data.errors) {
                        dispatch("showErrors", data.errors);
                    }
                    await dispatch("getNotas");
                    resolve();
                }); 
            });     
        },

        deleteNotas ({state, dispatch}, value) {
            return new Promise ((resolve) => {
                axios.post("/api/notas/delete", value).then(async (response) => {
                    let data = response.data;
                    // || Verificar si hay notificaciones y mostrar
                    if (data.notifications) {
                        dispatch("showNotification", data.notifications);
                    }
                    await dispatch("getNotas");
                    resolve();
                }); 
            });     
        },

        setSelectedNote ({state}, value) {
            console.log(value);
            let index = state.selectedNotes.findIndex(x => x.id === value.id);
            if(index !== -1) state.selectedNotes = state.selectedNotes.filter(x => x.id !== value.id);
            else state.selectedNotes.push(value);
        }
    },
    getters: {
        notas: (state) => state.notas,
        selectedNotes: (state) => state.selectedNotes,
    },
};