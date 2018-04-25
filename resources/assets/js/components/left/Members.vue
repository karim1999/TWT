<template>
    <ul>
        <li class="contact" v-for="friend in friends">
            <router-link :to="{ name: 'user', params: { user_id: friend.id }}">
                <div class="wrap">
                    <span class="contact-status busy"></span>
                    <img :src="storage + friend.img" alt="Profile Picture" />
                    <div class="meta">
                        <p class="name">{{ friend.name }}</p>
                        <p class="preview">{{ friend.last_message.message }}</p>
                    </div>
                </div>
            </router-link>

        </li>
    </ul>
</template>
<script>
    export default {
        data: function () {
            return {
            }
        },
        created() {
        },

        methods: {
            joinData: function () {
            }
        },
        computed: {
            friends: function () {
                return this.$store.state.friends;
            },
            storage: function () {
                return this.$store.state.storage;
            }
        }
    }
</script>