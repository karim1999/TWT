import Echo from './library/echo.min';
import Pusher from './library/pusher.min';
import Vuex from './library/vuex';
import VueRouter from './library/vue-router';
import VueOffline  from './library/vue-offline';
import { store } from './store';
import routes from './routes';
import VueChatScroll from 'vue-chat-scroll'

window.$= require("./library/jquery-3.3.1");
window.axios= require("./library/axios.min");
require("./library/bootstrap.min");

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '81e50fbb60729f9d41c8',
    cluster: 'eu',
    encrypted: true
});

Vue.use(VueRouter);
Vue.use(VueOffline);
Vue.use(VueChatScroll);

const router = new VueRouter({
    mode: 'history',
    routes: routes,
    path: "chat"
});

const app = new Vue({
    el: '#app',
    components: {
    },
    router,
    store,
    data: {
    },

    created() {
        this.$on('online', function () {
            this.$store.commit('checkOnline');
        });
        this.$on('offline', function () {
            this.$store.commit('checkOnline');
        })
    },


    methods: {
    },

    watch: {
    }

});