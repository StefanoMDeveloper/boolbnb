<template>
    <div >
        <div v-if="!loading" class="container container-lista">
            <div class="row">
                <div class="col-12">
                    <div class="container mt-5">
                        <div class="row trophyText">
                            <div class="col-12 d-flex">
                                <h2 class="ml-3"><strong>Appartamenti consigliati</strong></h2>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div v-for="apartment in apartments" :key="apartment.id" class="p-0 col-12 col-lg-12 d-flex ">       
                                    <div v-if="apartment.visible && apartment.active_sponsorships.length != 0" class="sponsored col-12 col-lg-12 my-3 p-0 d-flex  flex-wrap align-items-center justify-content-center">    
                                        <div class="col-lg-4 m-auto">
                                            <div v-for="image in apartment.images" :key="image.id" ><!-- non usare ccs su questo div -->
                                                <div v-if="image.main_image"  class="card-immagine">
                                                    <img  :src="`/storage/${image.url}`" class="border">
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class=" descrizione col-10 col-lg-5 ml-lg-5">
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
        

                    <!-- non sponsorizzate -->
                    <div class="container-fluid">
                        <div class="row px-3">
                            <div v-for="apartment in apartments" :key="apartment.id" class=" p-0 col-12">   
                                <div v-if="apartment.visible && apartment.active_sponsorships.length < 1" class="nonsponsored d-flex flex-wrap flex-lg-6 my-3 align-items-center justify-content-around px-lg-5">   
                                    <div class="col-lg-4 m-auto">
                                        <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                                            <div v-if="image.main_image"  class="card-immaginenonSpon col-lg-12 p-0">
                                                <img  :src="`/storage/${image.url}`"  class="border">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="descrizione col-10 col-lg-5 ">
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
            </div>
        </div>
        <Loader v-else/>
    </div>
</template>

<script>
import Loader from "./Loader.vue";
export default {
    name: "ApartmentList",
    data() {
        return{
            apartments: [],
            loading: true,

        }
    },
    components: {
    Loader
    },
    created() {
        axios
        .get("/api/apartments")
        .then((response) => {
            this.apartments = response.data;
            this.loading = false;
        });
    },
};
</script>

<style lang="scss" scoped>
// appartamenti
.item {
  padding: 16px 24px;
  margin-right: 24px;
  border-radius: 4px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  .ms_logo,
  i{
      color: #DE3151;
  }
}

.background{
    background-color: rgb(228, 223, 223);
}


a{
    color:black;
    text-decoration:none;
    margin-top: 0;
}





.descrizione{
    padding: 30px 0;
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
    margin-top: 200px;
}
    
.card-immagine{
    margin: 30px 0;
    height: 250px;
    width: 100%;
    border-radius: 20px;
    border: 2px solid gray;
    background-color: rgb(240, 238, 238);
    padding: 10px;
    overflow: hidden;
    position: relative;
    img{
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition:linear 1s; 
        border-radius: 20px;
    }
     &:hover img{
        transform: scale(1.1);
    }
    .star{
    color: gold;
    font-size: 40px;
    position: absolute;
    top:20px;
    left:20px
}
}

@media only screen and (min-width:1200px){ 
    .card-immagine{
        margin: 30px;
        height: 300px;
    }
} 

.card-immaginenonSpon{
     margin: 30px 0;
    height: 250px;
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    img{
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition:linear 1s; 
        border-radius: 20px;
    }
     &:hover img{
        transform: scale(1.1);
     }
}

@media only screen and (min-width:1200px){ 
    .card-immagine{
        margin: 30px;
        height: 300px;
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
    background-color: rgb(252, 232, 232);
    border-radius: 20px;
}

.nonsponsored{
    background-color: rgb(231, 229, 229);
    border-radius: 20px;
}


.non-sponsored{
    margin-top:50px;
}
</style>