<template>
    <div class="row chat">
        <div class="col">
            <div class="row first-row">
                <div class="col">
                    <div class="row chat-head align-items-center">
                        <img :src="storage+group.img" alt="Group Image" class="rounded-circle user-img" />
                        <div class="meta col-auto">
                            <p>{{ group.name }}</p>
                        </div>
                        <img src="/dots.png" class="dots pull-right" alt="menu">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="messages" v-chat-scroll>
                        <li v-for="message in messages" :class="(message.user_id == currentUser.id)? 'row sent align-items-center' : 'row received align-items-center'">
                            <img :src="storage + message.user.img" alt="Profile Picture" class="rounded-circle chat-user-picture"/>
                            <p>{{ message.message }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col message-input">
                    <div class="wrap">
                        <input v-model="msg" type="text" placeholder="Write your message..."  @keyup.enter="sendMessage"/>
                        <img src="/mic.png" alt="Record">
                        <i class="fa fa-paperclip attachment" style="" aria-hidden="true"></i>
                        <i @click="sendMessage" class="fa fa-paper-plane attachment" style="cursor: pointer" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        data: function () {
            return {
                messages: [],
                msg: '',
                group: []
            }
        },
        created(){
            this.getGroup();
            window.Echo.private('group.'+this.$route.params.group_id).listen('GroupMessageSent', (e) => {
                this.messages.push(e.message);
            });
        },

        watch: {
            '$route': 'getGroup'
        },
        methods: {
            getGroup: function () {
                axios.get('/group/'+this.$route.params.group_id).then(response => {
                    this.group= response.data;
                });
                this.loadMessages();
            },
            loadMessages: function () {
                axios.get('/group/'+this.$route.params.group_id+'/messages').then(response => {
                    this.messages = response.data;
                });
            },
            sendMessage(event){
                if(this.msg){
                    this.messages.push({user_id: this.currentUser.id, message: this.msg, user: this.currentUser});
                    axios.post('/group/'+this.$route.params.group_id+'/send', {
                        'message': this.msg,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    }).then(response => {
//                        this.messages.push(response.data);
//                        this.$store.commit('addLastGroupMessage');
                    });
                    this.msg= "";
                }
            },
        },
        computed: {
            currentUser: function () {
                return this.$store.state.user;
            },
            storage: function () {
                return this.$store.state.storage;
            }
        }

    }
</script>
