<template>
    <div class="left-menu">
        <div class="row justify-content-center align-items-center left-menu-item-top">
            <img class="logo-top rounded-circle" src="/logo.png" alt="Logo">
        </div>
        <div class="row justify-content-center align-items-center left-menu-item-second-top">
            <img class="profile-picture rounded-circle" :src="storage+user.img" alt="Profile Picture">
        </div>
        <div class="row justify-content-center align-items-baseline left-menu-item-middle">
            <ul style="width: 100%">
                <router-link :to="{ name: 'users'}"><li><img class="rounded-circle mx-auto d-block" src="/message.png" alt="messages"></li></router-link>
                <router-link :to="{ name: 'groups'}"><li><img class="rounded-circle mx-auto d-block" src="/group.png" alt="group"></li></router-link>
                <li><img class="rounded-circle mx-auto d-block" src="/gear.png" alt="gear"></li>
            </ul>
        </div>
        <div class="row justify-content-center align-items-center left-menu-item-bottom" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="cursor: pointer">
            <img class="logout" src="/logout.png" alt="logout">
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {}
        },
        methods: {

        },
        computed: {
            storage: function () {
                return this.$store.state.storage;
            },
            user: function () {
                return this.$store.state.user;
            }
        }
    }
</script>
