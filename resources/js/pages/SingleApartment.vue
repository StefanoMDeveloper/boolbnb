<template>
    <div>
        <div v-if="!loading">
            <div class="container">
                <img src="/storage/loadingPage.gif">
            </div>
            <div class="container p-3 singleApartment" v-show="loading==false">
                <div class="borderline">
                    <h1 class="text-center"><strong>{{apartment.name}}</strong></h1>
                    <p class="text-center">
                        <span class="ms_icon"><i class="fa-solid fa-location-dot"></i></span>
                        {{apartment.address}}
                    </p>
                </div>
                <div class="container containerImages">
                    <span v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo span -->
                        <div v-if="image.main_image" class="main-immagine">
                            <img  :src="`/storage/${image.url}`">
                        </div>
                        <div  v-else class="other-immagini">
                            <img :src="`/storage/${image.url}`">
                        </div>
                    </span>
                </div>
                <div class="borderdouble">
                    <div class=" borderdouble ">
                        <div class="ms_icon mr-2"><i class="fa-solid fa-circle-info"></i></div>
                        <p class="ms_description">{{apartment.description}}</p>
                    </div>
                    <div class="text-center col-lg-9 d-flex justify-content-around m-auto">
                        <div class="ms_card"><span class="ms_icon mr-2"><i class="fa-solid fa-person-shelter"></i></span><p>Stanze: {{apartment.rooms}}</p></div>  
                        <div class="ms_card"><span class="ms_icon mr-2"><i class="fa-solid fa-bed"></i></span><p>letti: {{apartment.beds}}</p></div>   
                        <div class="ms_card"><span class="ms_icon mr-2"><i class="fa-solid fa-toilet"></i></span><p>bagni: {{apartment.bathrooms}}</p></div>  
                        <div class="ms_card">
                            <span class="ms_icon mr-2"><i class="fa-solid fa-maximize"></i></span><p> metri quadrati: {{apartment.square_meters}}</p>
                        </div>
                    </div>
                </div>
                <div class="borderline">
                    <h2><span class="ms_icon mr-2"><i class="fa-solid fa-bell-concierge"></i></span>Servizi</h2>
                    <div v-for="service in apartment.services" :key="service.id" class="container">
                        <ul>
                            <li>
                                {{service.name}}
                            </li>
                        </ul>
                    </div>
                </div>
                <h4><span class="ms_icon mr-2"><i class="fa-solid fa-comment-dots"></i></span>Scrivi un messaggio al proprietario dell&#39;appartamento</h4>
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
                    <button type="button" class="btn backBtn b m-1 text-white">
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
        <Loader v-else/>
    </div>
</template>

<script>
import Loader from "./Loader.vue";
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
    components: {
    Loader
    },

    created() {
        console.log(this.authUser);
        axios
        .get(`/api/apartments/${this.$route.params.slug}`)
        .then((response) => {
            this.apartment = response.data;
            this.lat = parseFloat(this.apartment.lat);
            this.lon = parseFloat(this.apartment.lon);
            this.loading = false;
        });     
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
                this.loading = false;
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
        min-height: 560px;

    }
}

.main-immagine{
        width: 100%;
        height: 400px;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }
    
    .other-immagini{
        width: 100%;
        height: 400px;
        object-fit: cover;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }


@media only screen and (min-width:1200px){

    .main-immagine{
        width: 50%;
        height: 560px;
        float:left;
        overflow: hidden;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition:linear 1s;
        }
        &:hover img{
            transform: scale(1.1);
        }
    }
    
    .other-immagini{
        width: 25%;
        height: 280px;
        object-fit: cover;
        float:left;
        overflow: hidden;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition:linear 1s;
        }
        &:hover img{
            transform: scale(1.1);
        }
    }
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

.ms_icon{
    color:#39858a ;
}

.ms_description{
    line-height: 45px;
    font-size: 23px;
}

.fa-circle-info{
    font-size: 32px;
}

.fa-bell-concierge{
    font-size: 25px;
}

.backBtn{
    width: 150px;
}

.ms_card{
    height: 150px;
    width: 150px;
    border-radius: 20px;
    background-color: lightgray;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border: 1px solid rgb(207, 204, 204);
}

.ms_card .ms_icon{
    font-size: 30px;
}
</style>