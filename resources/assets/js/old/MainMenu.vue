<template>
    <div class="left-menu">
        <div class="row justify-content-center align-items-center">
            <div class="col-auto w-100 left-menu-item left-menu-item-top">
                <img class="logo-top rounded-circle" src="/logo.png" alt="Logo">
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-auto w-100 left-menu-item left-menu-item-second-top">
                <img class="profile-picture rounded-circle" :src="storage+user.img" alt="Profile Picture">
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-auto w-100 left-menu-item left-menu-item-middle">
                <ul>
                    <li><img class="rounded-circle" src="/message.png" alt="messages"></li>
                    <li><img class="rounded-circle" src="/group.png" alt="group"></li>
                    <li><img class="rounded-circle" src="/gear.png" alt="gear"></li>
                </ul>
            </div>
        </div>
        <div class="row justify-content-center align-items-end">
            <div class="col-auto w-100 left-menu-item left-menu-item-bottom">
                <img class="logout" src="/logout.png" alt="logout">
            </div>
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
