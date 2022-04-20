<template>
    <div>
        <div class="container p-3 singleApartment">
            <h1>{{apartment.name}}</h1>
            <p>{{apartment.address}}</p>
            <div class="container d-flex containerImages">
                <div>
                    <!--img :src="`/storage/${}`"-->
                </div>
                <div>
                    <div class="container d-flex">
                        <div>
                            <!--img :src="`/storage/${}`"-->
                        </div>
                        <div>
                            <!--img :src="`/storage/${}`"-->
                        </div>
                    </div>
                    <div class="container d-flex">
                        <div>
                            <!--img :src="`/storage/${}`"-->      
                        </div>
                        <div>
                            <!--img :src="`/storage/${}`"-->         
                        </div>
                    </div>
                </div>
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
        border-radius: 20px;
    
        div {
            border: 6px solid white;
        }
    }
}
</style>