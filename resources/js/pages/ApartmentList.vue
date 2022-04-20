<template>
    <div>
        <div class="container">
            <div>ciao</div>
            <div v-for="apartment in apartments" :key="apartment.id" class="card">
                <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                    <div v-if="apartment.visible==true" class="row">
                        <img :src="require(`${apartment.main_image}`)" alt="">
                        <p class="col">{{apartment.name}}</p>
                        <!-- <p class="col">{{apartment.user_id.name}} {{apartment.user_id.lastname}}</p> -->
                        
                        <div class="col">
                            <p>Numero di stanze: {{apartment.rooms}}</p>
                            <p>Numero di letti: {{apartment.beds}}</p>
                            <p>Numero di bagni: {{apartment.bathrooms}}</p>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ApartmentList",
    data() {
        return{
            apartments: []
        }
    },
    created() {
        axios
        .get("/api/apartments")
        .then((response) => {
            this.apartments = response.data;
        })
    },
};
</script>

<style lang="scss" scoped>
 router-link{
     color:black;
     text-decoration:none;
 }
</style>