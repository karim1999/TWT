<template>
    <div class="row justify-content-center align-items-baseline user-list-section">
        <ul class="col contacts">
            <li class="contact row" v-for="group in groups">
                <router-link :to="{ name: 'group', params: { group_id: group.id }}">
                    <div class="wrap col-auto">
                        <div class="row align-items-center">
                            <img :src="storage + group.img" alt="Profile Picture" class="rounded-circle" />
                            <div class="meta">
                                <h5 class="name">{{ group.name }}</h5>
                                <h6 class="details">{{ (group.last_message[0])? group.last_message[0].message : group.description }}</h6>
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
            groups: function () {
                return this.$store.state.groups;
            },
            storage: function () {
                return this.$store.state.storage;
            }
        }
    }
</script>