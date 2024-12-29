<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link :to="{ name: 'main' }" class="navbar-brand">leads</router-link>
                <router-link :to="{ name: 'logs' }" class="navbar-brand">logs</router-link>
            </div>
        </nav>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index"
}
</script>

<style scoped></style>