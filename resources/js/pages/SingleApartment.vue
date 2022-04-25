<template>
    <div>
        <div class="container" v-show="loading==true">
            <img src="/storage/loadingPage.gif">
        </div>
        <div class="container p-3 singleApartment" v-show="loading==false">
            <h1>{{apartment.name}}</h1>
            <p>{{apartment.address}}</p>
            <div class="container containerImages">
                <span v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo span -->
                    <img v-if="image.main_image" class="main-immagine" :src="`/storage/${image.url}`">
                    <img v-else class="other-immagini" :src="`/storage/${image.url}`">
                </span>

            </div>
            <h5>{{apartment.description}}</h5>
            <p>Stanze: {{apartment.rooms}} • letti: {{apartment.beds}} • bagni: {{apartment.bathrooms}} • metri quadrati: {{apartment.square_meters}}</p>
            <h2>Servizi</h2>
            <div v-for="service in apartment.services" :key="service.id" class="container">
                <p>{{service.name}}</p>
            </div>
            <h4>Scrivi un messaggio al proprietario dell&#39;appartamento</h4>
            <form @submit.prevent='sendMail'>
                <div v-if="authUser==1">
                    <label for="email">Ciaone!</label>
                    <input type="email" id="email" name="email">
                </div>
                <div v-else>
                    <label for="email">Inserisci la tua email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <textarea class="col-8 form-control" id="message" name="message" placeholder="Inserisci qui il messaggio"></textarea>
                <input type="submit" value="Submit">
            </form>
            <button>
            <a @click="$router.back()">
                    Torna indietro  
            </a>
            </button>

            <div v-show="messageSent">
                Messaggio inviato!
            </div>

            <div id="map" style="width: 100%; height: 500px; margin-top:50px;">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SingleApartment",
    data() {
        return {
            apartment: [],
            messageSent: false,
            lat: "",
            lon: "",
            loading: true
        }
    },
    created() {
        console.log(this.authUser);
        axios
        .get(`/api/apartments/${this.$route.params.slug}`)
        .then((response) => {
            this.apartment = response.data;
            this.lat = parseFloat(this.apartment.lat);
            this.lon = parseFloat(this.apartment.lon);
        });     
    },
    mounted(){
        console.log(this.loading);
        this.loading = false;
        console.log(this.loading);
    },
    updated(){
        let center = [this.lon,this.lat];
        const map= tt.map({
            key: "5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte",
            container: "map",
            center: center,
            zoom: 9
        })         
            new tt.Marker().setLngLat(center).addTo(map);      
    },
    methods: {
        userLogged(){
        },
        sendMail(){
            axios
            .post('/api/messages',this.formData)
            .then((response) => {
                this.formData.content = '';
                this.formData.email = '';
                this.messageSent = true;
            });
        }
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
    height: 560px;
    float:left;
}

.other-immagini{
    width: 25%;
    height: 280px;
    object-fit: cover;
    float:left;
}

img{
    border: 2px solid white;
}

h5{
    padding-top:20px
}
</style>