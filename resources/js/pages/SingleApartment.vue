<template>
    <div>
        <div class="container p-3 singleApartment">
            <h1>{{apartment.name}}</h1>
            <p>{{apartment.address}}</p>
            <div class="container containerImages">
                <span v-for="image in apartment.images" :key="image.id" ><!-- non usare ccs su questo span -->
                    <img v-if="image.main_image" class="main-immagine" :src="`/storage/${image.url}`">
                    <img v-else class="other-immagini" :src="`/storage/${image.url}`">
                </span>

            </div>
            <h2>{{apartment.description}}</h2>
            <p>Stanze: {{apartment.rooms}} • letti: {{apartment.beds}} • bagni: {{apartment.bathrooms}} • metri quadrati: {{apartment.square_meters}}</p>
            <h2>Servizi</h2>
            <div v-for="service in apartment.services" :key="service.id" class="container">
                <p>{{service.name}}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SingleApartment",
    data() {
        return {
            apartment: []
        }
    },
    created() {
        axios
        .get(`/api/apartments/${this.$route.params.slug}`)
        .then((response) => {
            this.apartment = response.data;
        });
    }
};
</script>

<style lang="scss" scoped>
.singleApartment {
    margin-top: 200px;

    .containerImages {
        border-radius: 30px;
        overflow: hidden;
        padding: 0;
        max-height: 560px;

    }
}

    .main-immagine{
        width: 50%;
        float: left;

    }
    
    .other-immagini{
        max-width: 25%;
        max-height: 25%;
        float: left;
        object-fit: cover;
        
    }

    img{
        border: 2px solid white;
    }

</style>