<template>
    <div class="row justify-content-center align-items-center search-section">
        <input type="text" class="form-control" placeholder="Search for contacts and groups ........................." name="search" v-model="search" />
    </div></template>
<script>
    export default {
        data: function () {
            return {
                search: ""
            }
        },
        methods: {}
    }
</script>