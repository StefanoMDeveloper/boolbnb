<template>
    <div>
        <div class="container-lista">
            <h2>Sponsorizzati</h2>
            <div v-for="apartment in apartments" :key="apartment.id" class="card">       
                <div v-if="apartment.visible && apartment.active_sponsorships.length != 0" class="sponsored d-flex flex-column flex-lg-row align-items-center justify-content-center">
                    <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}" class="col-11 col-lg-3">
                        <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                            <div v-if="image.main_image"  class="card-immagine">
                                <img  :src="`/storage/${image.url}`" class="border">
                            </div>
                        </div>
                    </router-link>
                    <div class=" descrizione col-11 col-lg-9 ml-lg-5">
                        <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                            <h4>{{apartment.name}}</h4>
                        </router-link>
                        <ul class="d-flex">
                            <li>stanze {{apartment.rooms}} •</li>
                            <li>letti {{apartment.beds}} •</li>
                            <li>bagni {{apartment.bathrooms}} •</li>
                            <span v-for="service in apartment.services" :key="service.id">
                                <li>{{service.name}} •</li>
                            </span>
                        </ul>

                        <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                            <button>
                                <a>
                                    <i class="fa-solid fa-eye"></i>
                                    Visualizza ulteriori dettagli...
                                </a>
                            </button>
                        </router-link>

                    </div>
                </div>
            </div>

            <!-- non sponsorizzate -->
            <div class="non-sponsored">
                <div v-for="apartment in apartments" :key="apartment.id" class="card">   
                    <div v-if="apartment.visible && apartment.active_sponsorships.length < 1" class="sponsored d-flex flex-column flex-lg-row align-items-center justify-content-center">
                        <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}" class="col-11 col-lg-3">
                            <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                                <p v-if="image.main_image"  class="card-immagine">
                                    <img  :src="`/storage/${image.url}`"  class="border">
                                </p>
                            </div>
                        </router-link>
                        <div class="descrizione col-11 col-lg-9 ml-lg-5">
                            <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                                <h4>{{apartment.name}}</h4>
                            </router-link>
                            <ul class="d-flex">
                                <li>stanze {{apartment.rooms}} •</li>
                                <li>letti {{apartment.beds}} •</li>
                                <li>bagni {{apartment.bathrooms}} •</li>
                                <span v-for="service in apartment.services" :key="service.id">
                                    <li>{{service.name}} •</li>
                                </span>
                            </ul>
                            <router-link :to="{name: 'SingleApartment', params: {slug: apartment.slug}}">
                               <button>
                                    <a>
                                        <i class="fa-solid fa-eye"></i>
                                        Visualizza ulteriori dettagli...
                                    </a>
                                </button>
                            </router-link>
                        </div>
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

        }
    },
    created() {
        axios
        .get("/api/apartments")
        .then((response) => {
            this.apartments = response.data;
        });
    },
};
</script>

<style lang="scss" scoped>
a{
    color:black;
    text-decoration:none;
}

img{
    height: 200px;
    width: 300px;
    border-radius: 13px
}

.descrizione{
    padding: 30px 20px;
    button{
        background-color:  #39858a;
        padding: 10px 20px;
        border-radius: 20px;
        transition:linear 1s;
        border: none;
        &:hover{
        background-color:  #54b4ba;
        color: white;
        }
        a{
            color: white;
            text-decoration: none;
            line-height: 100%;
            &:hover{
                color: white;
            }
        }
    }   
}

.container-lista{
    margin-top: 200px
}
    
.card-immagine{
    margin-bottom:0;
    padding: 30px 0;
    height: 400px;
    width: 3;
    margin: auto;
    img{
        height: 100%;
        width: 100%;
        object-fit: cover;
    }
}

@media only screen and (min-width:1200px){  
    .card-immagine{
    margin-left:50px; 
    height: 300px;
    width: 100%; 
    }
}




ul{

    width: 70%;
    flex-wrap: wrap;
    li{
        float: left;
        color: grey;
        font-weight: bold;
        font-size: 13px;
        padding-right: 5px;
        padding-left: 0;
        list-style-type:none;
    }
}

.sponsored{
    background-color: rgb(235,235,235);
}


.non-sponsored{
    margin-top:50px;
}
</style>