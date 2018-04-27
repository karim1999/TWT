<template>
    <ul>
        <li class="contact" v-for="group in groups">
            <router-link :to="{ name: 'group', params: { group_id: group.id }}">
                <div class="wrap">
                    <span class="contact-status online"></span>
                    <img :src="storage + group.img" alt="Group Picture" />
                    <div class="meta">
                        <p class="name">{{ group.name }}</p>
                        <p class="preview">{{ (group.last_message[0])? group.last_message[0].message : group.description }}</p>
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
//                lastMessage: {}
            }
        },
        methods: {
            getLastMessage: function () {
//                axios.get('/group/'+this.$route.params.group_id+'/messages').then(response => {
//                    this.messages = response.data;
//                });
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