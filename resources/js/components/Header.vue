<template>
    <header>
        <nav>
            <li><router-link :to="{ name: 'Homepage' }">Homepage</router-link></li>
            <li><router-link :to="{ name: 'ApartmentList' }">ApartmentsList</router-link></li>
            <li><router-link :to="{ name: 'SingleApartment' }">SingleApartment</router-link></li>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style lang="scss" scoped>
</style>