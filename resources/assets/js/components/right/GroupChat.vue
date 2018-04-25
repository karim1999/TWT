<template>
    <div class="content">
        <div class="contact-profile">
            <img :src="storage+group.img" alt="Group Image" width="50" height="40" />
            <p>{{ group.name }}</p>
            <div class="social-media">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
        </div>
        <div class="messages">
            <ul>
                <li v-for="message in messages" :class="(message.user_id == currentUser.id)? 'sent' : 'replies'">
                    <img :src="storage + message.user.img" alt="Profile Picture" />
                    <p>{{ message.message }}</p>
                </li>
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
                <input v-model="msg" type="text" placeholder="Write your message..."  @keyup.enter="sendMessage"/>
                <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
                <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true" @click="sendMessage"></i></button>
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
                if(e.message.user_id != this.currentUser.id){
                    this.messages.push(e.message);
                }
            });
        },

        watch: {
            messages: function (val) {
                this.scrollDown();
            },
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
                    this.messages.push(response.data);
                    axios.post('/group/'+this.$route.params.group_id+'/send', {
                        'message': this.msg,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    }).then(response => {
//                        this.messages.push(response.data);
                        this.$store.commit('addLastGroupMessage');
                    });
                    this.msg= "";
                }
            },
            scrollDown: function () {
                $(".messages").animate({ scrollTop: $(document).height() }, "fast");
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
