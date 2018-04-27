<template>
    <div id="profile">
        <div class="wrap">
            <img id="profile-img" :src='storage + user.img' class="online" alt="Profile Picture" width="80" height="100" />
            <p>{{ user.name }}</p>
            <a class="pull-right" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </div>
    </div>
</template>
<script>

    export default {
        data: function () {
            return {}
        },
        methods: {},
        computed: {
            user: function () {
                return this.$store.state.user;
            },
            storage: function () {
                return this.$store.state.storage;
            }
        }
    }
</script>