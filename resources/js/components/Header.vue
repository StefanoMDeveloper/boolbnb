<template>
    <header>
        <nav>
            <li><router-link :to="{ name: 'Homepage' }">Homepage</router-link></li>
            <li><router-link :to="{ name: 'Dashboard' }">Dashboard</router-link></li>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header",
};
</script>

<style lang="scss" scoped>
</style>