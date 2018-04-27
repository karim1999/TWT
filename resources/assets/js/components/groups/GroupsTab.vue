<template>
    <div class="row">
        <div class="col-3 secondary-menu">
            <div class="row justify-content-center align-items-center secondary-menu-item-top">
                <h3>TWTChat</h3>
            </div>
            <div class="row justify-content-center align-items-center d-none d-xl-flex">
                <button class="btn btn-lg col-auto label-head label-head-left">
                    Online
                </button>
                <button class="btn btn-lg col-auto label-head label-head-right">
                    Offline
                </button>
            </div>
            <Search></Search>
            <GroupsList></GroupsList>
            <Add></Add>
        </div>
        <div class="col">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import Search from './components/Search.vue';
    import GroupsList from './components/GroupsList.vue';
    import Add from './components/Add.vue';
    export default {
        components: {
            Search,
            GroupsList,
            Add
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