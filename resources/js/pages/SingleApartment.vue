<template>
    <div>
        <div class="container" v-show="loading==true">
            <img src="/storage/loadingPage.gif">
        </div>
        <div class="container p-3 singleApartment" v-show="loading==false">
            <div class="borderline">
                <h1 class="text-center"><strong>{{apartment.name}}</strong></h1>
                <p class="text-center">{{apartment.address}}</p>
            </div>
            <div class="container containerImages">
                <span v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo span -->
                    <img v-if="image.main_image" class="main-immagine" :src="`/storage/${image.url}`">
                    <img v-else class="other-immagini" :src="`/storage/${image.url}`">
                </span>
            </div>
            <div class="borderdouble">
                <p>{{apartment.description}}</p>
                <p class="text-center">Stanze: {{apartment.rooms}} • letti: {{apartment.beds}} • bagni: {{apartment.bathrooms}} • metri quadrati: {{apartment.square_meters}}</p>
            </div>
            <div class="borderline">
                <h2>Servizi</h2>
                <div v-for="service in apartment.services" :key="service.id" class="container">
                    <ul>
                        <li>{{service.name}}</li>
                    </ul>
                </div>
            </div>
            <h4>Scrivi un messaggio al proprietario dell&#39;appartamento</h4>
            <form @submit.prevent='sendMail'>
                <div v-if="authUser==1">
                    <label for="email">Ciaone!</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="my-2" v-else>
                    <label for="email">Inserisci la tua email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <textarea class="col-8 my-2 form-control" id="message" name="message" placeholder="Inserisci qui il messaggio"></textarea>
                <button type="submit" class="btn backBtn m-1 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                    <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                    Invia Messaggio
                </button>
            </form>
            <a @click="$router.back()">
                <button type="button" class="btn backBtn m-1 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 512">
                    <path d="M192 448c-8.188 0-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l137.4 137.4c12.5 12.5 12.5 32.75 0 45.25C208.4 444.9 200.2 448 192 448z"/></svg>
                    Torna indietro  
                </button>
            </a>

            <div v-show="messageSent">
                Messaggio inviato!
            </div>

            <div id="map" style="width: 100%; height: 500px; margin-top:20px;">

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

#email{
    overflow: visible;
    border-radius: 10px;
    list-style-type: none;
    border: solid 1px #ced4da;
}

#map{
    border-radius: 20px;
}
.borderline,.borderdouble{
    border-bottom: 1px solid rgb(193, 192, 192);
    margin-bottom: 20px;

}
.borderdouble{
    margin-top: 20px;
    padding: 10px;
}

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
    padding-top:20px;
}

p{
    font-size:16px;
    margin-bottom: 12px;
}
</style>