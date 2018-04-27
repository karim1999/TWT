<template>
    <div class="container-fluid">
        <div id="app" class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <main-menu></main-menu>
                    </div>
                </div>
            </div>
            <div class="col" style="flex: 50">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
    import mainMenu from './MainMenu.vue';

    export default {
        components: {
            mainMenu
        },
        data: function () {
            return {}
        },
        methods: {}
    }
</script>