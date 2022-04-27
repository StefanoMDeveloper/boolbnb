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
                    <div class="text-center col-12 col-lg-12 d-flex justify-content-center flex-wrap m-auto">
                        <div class="ms_card col-5 col-lg-2 m-2"><span class="ms_icon mr-2"><i class="fa-solid fa-person-shelter"></i></span><p>Stanze: {{apartment.rooms}}</p></div>  
                        <div class="ms_card col-5 col-lg-2 m-2"><span class="ms_icon mr-2"><i class="fa-solid fa-bed"></i></span><p>letti: {{apartment.beds}}</p></div>   
                        <div class="ms_card col-5 col-lg-2 m-2"><span class="ms_icon mr-2"><i class="fa-solid fa-toilet"></i></span><p>bagni: {{apartment.bathrooms}}</p></div>  
                        <div class="ms_card col-5 col-lg-2 m-2">
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
                <form @submit.prevent="sendMail()">
                    <input type="text" id="name" v-model="formData.name" placeholder="Nome">
                    <input type="text" id="lastname" v-model="formData.lastname" placeholder="Cognome">
                    <input type="email" id="email" class="ms_email" v-model="formData.email" placeholder="email">
                    <input type="text" id="object" v-model="formData.object" placeholder="Oggetto">
                    <textarea name="content" id="content" class="col-8 form-control mt-3" v-model="formData.content" placeholder="Inserisci il testo del tuo messaggio"></textarea>
                    <div v-if="formErrors.content">
                        <ul>
                            <li v-for="(error,index) in formErrors.content" :key="index">
                                {{error}}
                            </li>
                        </ul>
                    </div>
                    <button class="ms_Btn mt-2" type="submit">Aggiungi</button>
                </form>
                <div v-show="messageSent">
                    Il tuo messaggio è stato inviato!
                </div>

                <button class="ms_Btn mt-2">
                <a @click="$router.back()">
                        Torna indietro  
                </a>
                </button>

                <div id="map" style="width: 100%; height: 500px; margin-top:50px;">

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
            loading: true,
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

#email{
    overflow: visible; 
    list-style-type: none;
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
    text-align: justify;
  text-justify: inter-word;
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

.ms_Btn{
    background-color:#39858a ;
    transition:linear 1s;
    border: none;
    border-radius: 10px;
    color: white;
    padding: 10px 5px;
    width: 200px;
    &:hover{
        background-color: #1c4144;
    }
}


</style>