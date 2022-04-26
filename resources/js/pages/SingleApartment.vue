<template>
    <div >
        <div v-if="!loading">
            <div class="container" v-show="loading==true">
                <img src="/storage/loadingPage.gif">
            </div>
<<<<<<< HEAD
            <h4>Scrivi un messaggio al proprietario dell&#39;appartamento</h4>
            <form @submit.prevent="sendMail()">
                <input type="text" id="name" v-model="formData.name" placeholder="Nome">
                <input type="text" id="lastname" v-model="formData.lastname" placeholder="Cognome">
                <input type="email" id="email" v-model="formData.email" placeholder="email">
                <input type="text" id="object" v-model="formData.object" placeholder="Oggetto">
                <textarea name="content" id="content" class="col-8 form-control" v-model="formData.content" placeholder="Inserisci il testo del tuo messaggio"></textarea>
                <div v-if="formErrors.content">
                    <ul>
                        <li v-for="(error,index) in formErrors.content" :key="index">
                            {{error}}
                        </li>
                    </ul>
                </div>
                <button type="submit">Aggiungi</button>
            </form>
            <div v-show="messageSent">
                Il tuo messaggio è stato inviato!
            </div>

            <button>
            <a @click="$router.back()">
                    Torna indietro  
            </a>
            </button>

            <div id="map" style="width: 100%; height: 500px; margin-top:50px;">
=======
            <div class="container p-3 singleApartment" v-show="loading==false">
                <h1>{{apartment.name}}</h1>
                <p><span class="icon mr-2"><i class="fa-solid fa-location-dot"></i></span>{{apartment.address}}</p>
                <div class="container containerImages">
                    <span v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo span -->
                        <img v-if="image.main_image" class="main-immagine" :src="`/storage/${image.url}`">
                        <img v-else class="other-immagini" :src="`/storage/${image.url}`">
                    </span>

                </div>
                <h5>{{apartment.description}}</h5>
                <p class="py-3"><span class="icon pr-1"><i class="fa-solid fa-person-shelter"></i></span>Stanze: {{apartment.rooms}} • <span class="icon pr-1"><i class="fa-solid fa-bed"></i></span> letti: {{apartment.beds}} • <span class="icon pr-1"><i class="fa-solid fa-toilet"></i></span> bagni: {{apartment.bathrooms}} • <span class="icon pr-1"><i class="fa-solid fa-maximize"></i></span> metri quadrati: {{apartment.square_meters}}</p>
                <h2>
                    <span class="icon"><i class="fa-solid fa-bell-concierge"></i></span>
                    Servizi
                </h2>
                <div v-for="service in apartment.services" :key="service.id" class="container">
                    <p>{{service.name}}</p>
                </div>
                <h4 class="mt-4">
                    <span class="icon"><i class="fa-solid fa-message"></i></span>
                    Scrivi un messaggio al proprietario dell&#39;appartamento
                </h4>
                <form @submit.prevent='sendMail'>
                    <div v-if="authUser==1">
                        <label for="email">Ciaone!</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="my-3" v-else>
                        <label for="email">Inserisci la tua email:</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <textarea class="col-8 form-control" id="message" name="message" placeholder="Inserisci qui il messaggio"></textarea>
                    <input class="ms_submit" type="submit" value="Submit">
                </form>
                <button class="ms_back">
                <a @click="$router.back()">
                        Torna indietro  
                </a>
                </button>

                <div v-show="messageSent">
                    Messaggio inviato!
                </div>

                <div id="map" style="width: 100%; height: 500px; margin-top:50px;">

                </div>
>>>>>>> f6091371d29236bdbb2760e98fbc8ebc28582304

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
            loading: true,
<<<<<<< HEAD
            mapped:false,
            formData: {
                name:"",
                lastname:"",
                email:"",
                object:"",
                content: "",
                apartment_id: null
            },
            formErrors:{}
=======
            
>>>>>>> f6091371d29236bdbb2760e98fbc8ebc28582304
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
            this.formData.apartment_id = this.apartment.id;
            this.lat = parseFloat(this.apartment.lat);
            this.lon = parseFloat(this.apartment.lon);
            this.loading = false;
        });     
    },
<<<<<<< HEAD
    mounted(){
        this.loading = false;
    },
=======
 
>>>>>>> f6091371d29236bdbb2760e98fbc8ebc28582304
    updated(){
        if(!this.mapped && this.lat!=""){
            let center = [this.lon,this.lat];
            const map= tt.map({
                key: "5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte",
                container: "map",
                center: center,
                zoom: 9
            })         
                new tt.Marker().setLngLat(center).addTo(map);  
            this.mapped = true;    
        }
    },
    methods: {
        sendMail(){
            console.log(this.formData);
            axios
            .post(`/api/messages/`, this.formData)
            .then((response)=>{
                this.formData.name = "";
                this.formData.lastname = "";
                this.formData.email = "";
                this.formData.object = "";
                this.formData.content = "";
                this.messageSent = true;
            })
            .catch((error)=>{
                console.log('errori:');
                console.log(error.response.data);
                this.formErrors = error.response.data.errors;
            })
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

.icon{
    color: #39858a;
}
.ms_submit,
.ms_back{
    margin: 5px 0;
    transition:linear 1s;
    border: none;
    color:white;
    padding: 10px 20px;
    border-radius: 20px;
    background-color: #39858a;
     &:hover{
        background-color: #7bdee5;
    }
    
}



</style>