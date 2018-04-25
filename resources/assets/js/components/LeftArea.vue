<template>
    <div id="sidepanel">
        <leftHeader></leftHeader>
        <search></search>
        <div id="contacts">
            <groups></groups>
            <members></members>
        </div>
        <leftFooter></leftFooter>
    </div>
</template>
<script>
    import leftHeader from './left/Header.vue';
    import Search from './left/Search.vue';
    import groups from './left/Groups.vue';
    import members from './left/Members.vue';
    import leftFooter from './left/Footer.vue';

    export default {
        components: {
            leftHeader,
            Search,
            groups,
            members,
            leftFooter
        },
        data: function () {
            return {
            }
        },
        methods: {}
    }
</script>