<template>
    <div class="row justify-content-center align-items-baseline user-list-section">
        <ul class="col contacts">
            <li class="contact row" v-for="friend in friends">
                <router-link :to="{ name: 'user', params: { user_id: friend.id }}">
                    <div class="wrap col-auto">
                        <div class="row align-items-center">
                            <img :src="storage + friend.img" alt="Profile Picture" class="rounded-circle" />
                            <div class="meta">
                                <h5 class="name">{{ friend.name }}</h5>
                                <h6 class="details">{{ friend.last_message.message }}</h6>
                            </div>
                        </div>
                    </div>
                </router-link>
            </li>
        </ul>
    </div>
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