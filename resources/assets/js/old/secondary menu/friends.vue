<template>
    <div class="secondary-menu">
        <div class="row justify-content-center align-items-center">
            <div class="col-auto secondary-menu-item secondary-menu-item-top">
                <h1>TWTChat</h1>
            </div>
        </div>
        <!--<search></search>-->
        <div id="contacts">
            <groups></groups>
            <!--<members></members>-->
        </div>
        <!--<leftFooter></leftFooter>-->
    </div>
</template>
<script>
    import Search from './left/Search.vue';
    import groups from './left/Groups.vue';
    import members from './left/Members.vue';
    import leftFooter from './left/Footer.vue';

    export default {
        components: {
            Search,
            groups,
            members,
            leftFooter
        },
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