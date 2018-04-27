<template>
    <div id="bottom-bar">
        <add></add>
        <settings></settings>
    </div>
</template>
<script>
    import add from './Add.vue';
    import settings from './Settings.vue';

    export default {
        components: {
            add,
            settings
        },
        data: function () {
            return {}
        },
        methods: {}
    }
</script>