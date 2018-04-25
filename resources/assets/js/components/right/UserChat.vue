<template>
    <div class="content">
        <div class="contact-profile">
            <img :src="storage+user.img" alt="User Image" width="50" height="40" />
            <p>{{ user.name }}</p>
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
                user: []
            }
        },
        created(){
            this.getUser();
            window.Echo.private('user.'+this.currentUser.id+'.'+this.$route.params.user_id).listen('UserMessageSent', (e) => {
                if(e.message.user_id != this.currentUser.id){
                    this.messages.push(e.message);
                }
            });
        },

        watch: {
            messages: function (val) {
                this.scrollDown();
            },
            '$route': 'getUser'
        },
        methods: {
            getUser: function () {
                axios.get('/user/'+this.$route.params.user_id).then(response => {
                    this.user= response.data;
                });
                this.loadMessages();
            },
            loadMessages: function () {
                axios.get('/user/'+this.$route.params.user_id+'/messages').then(response => {
//                    console.log(response.data);
                    this.messages = response.data;
                });
            },
            sendMessage(event){
                if(this.msg){
                    axios.post('/user/'+this.$route.params.user_id+'/send', {
                        'message': this.msg,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    }).then(response => {
                        this.messages.push(response.data);
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
