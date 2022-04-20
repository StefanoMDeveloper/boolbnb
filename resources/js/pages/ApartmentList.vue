<template>
    <div>
        <div class="container">
            <div>ciao</div>
            <div v-for="apartment in apartments" :key="apartment.id" class="card">           
                <div v-if="apartment.visible==true" class="row">
                    <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                        <div v-for="image in apartment.images" :key="image.id">
                            <p v-if="image.main_image">
                                <img  :src="`/storage/${image.url}`">
                            </p>
                        </div>
                    
                        <p class="col">{{apartment.name}}</p>
                    </router-link>
                    <div v-for="user in users" :key="user.id">
                        {{user.name}} {{user.last_name}}
                    </div>
                    
                    <div class="col">
                        <p>Numero di stanze: {{apartment.rooms}}</p>
                        <p>Numero di letti: {{apartment.beds}}</p>
                        <p>Numero di bagni: {{apartment.bathrooms}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApartmentList",
    data() {
        return{
            apartments: [],
            users: [],
        }
    },
    created() {
        axios
        .get("/api/apartments")
        .then((response) => {
            this.apartments = response.data;
        });
        // axios
        // .get("/api/users")
        // .then((response) => {
        //     this.users = response.data;
        // })
    },
};
</script>

<style lang="scss" scoped>
a{
    color:black;
    text-decoration:none;
}

img{
    width: 150px;
}
</style>