/**
 * Created by karim on 4/26/2018.
 */

window.Vue= require("./library/vue");
import Vuex from './library/vuex';

export const store = new Vuex.Store({
    state: {
        storage : storage,
        user : user,
        groups : groups,
        friends : friends,
        status: true
    },

    mutations: {
        checkOnline(state){
            state.status= !state.status;
        },
        addLastGroupMessage(state){
            axios.get('/groups').then(response => {
                state.groups = response.data;
            });
        }
    }
});