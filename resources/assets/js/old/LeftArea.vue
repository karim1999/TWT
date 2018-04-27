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