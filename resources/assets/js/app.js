import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import VueRouter from './vue-router';
import Vuex from './vuex';
import leftarea from './components/LeftArea.vue';
import Groupchat from './components/right/GroupChat.vue';
import UserChat from './components/right/UserChat.vue';
import home from './components/right/Home.vue';
window.$= require("./jquery-3.3.1");
window.Vue= require("./vue");
require("./bootstrap.min");
window.axios= require("./axios.min");

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '81e50fbb60729f9d41c8',
    cluster: 'eu',
    encrypted: true
});

Vue.use(Vuex);
Vue.use(VueRouter);

const store = new Vuex.Store({
    state: {
        storage : storage,
        user : user,
        groups : groups,
        friends : friends
    },

    mutations: {
        // loadGroups: function () {
        //
        // },
        // loadFriends: function () {
        //
        // },

        addLastGroupMessage(state){
            axios.get('/groups').then(response => {
                state.groups = response.data;
            });
        }
    }
});

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/chat/group/:group_id',
            name: 'group',
            component: Groupchat,
            props: {
                isGroup: true
            }
        },
        {
            path: '/chat/user/:user_id',
            name: 'user',
            component: UserChat,
            props: {
                isGroup: false
            }
        },
        {
            path: '/chat',
            name: 'home',
            component: home
        }

    ],
});

// Vue.prototype.$storage = storage;
// Vue.prototype.$user = user;
// Vue.prototype.$groups = groups;
// Vue.prototype.$friends = friends;

const app = new Vue({
    el: '#frame',
    components: {
        leftarea
    },
    router,
    store,
    data: {
    },

    created() {
    },


    methods: {
    },

    watch: {
    }

});