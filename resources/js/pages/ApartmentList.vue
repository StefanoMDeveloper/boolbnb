<template>
    <div class="m-auto">
        <div class="container-fluid container-lista">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid">
                        <div class="row trophyText">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <span class="ms_trophy"><i class="fa-solid fa-trophy"></i></span>
                                <h2 class="ml-3"><strong>Appartamenti consigliati</strong></h2>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div v-for="apartment in apartments" :key="apartment.id" class="card col-12">       
                                    <div v-if="apartment.visible && apartment.active_sponsorships.length != 0" class="sponsored col-12 d-flex flex-column flex-lg-row align-items-center justify-content-center">
                                        
                                        <div class="col-lg-4">
                                            <div v-for="image in apartment.images" :key="image.id" ><!-- non usare ccs su questo div -->
                                                <div v-if="image.main_image"  class="card-immagine">
                                                    <img  :src="`/storage/${image.url}`" class="border">
                                                    <span class="star"><i class="fa-solid fa-star"></i></span>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class=" descrizione col-10 col-lg-7 ml-lg-5">
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
                        <div class="row">
                            <div class="non-sponsored col-12">
                                <div v-for="apartment in apartments" :key="apartment.id" class="card col-12">   
                                    <div v-if="apartment.visible && apartment.active_sponsorships.length < 1" class="sponsored d-flex flex-column flex-lg-row align-items-center justify-content-center px-lg-5">   
                                        <div class="col-lg-3">
                                            <div v-for="image in apartment.images" :key="image.id"><!-- non usare ccs su questo div -->
                                                <div v-if="image.main_image"  class="card-immaginenonSpon col-lg-12">
                                                    <img  :src="`/storage/${image.url}`"  class="border">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="descrizione col-10 col-lg-8 ml-lg-5">
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


a{
    color:black;
    text-decoration:none;
    margin-top: 0;
}

.trophyText{
    .ms_trophy{
        color: gold;
        font-size: 20px;
        height: 70px;
        h2{
            line-height: 70px;
        }
    }
}

@media only screen and (min-width:1200px){
    .trophyText{
        .ms_trophy{
            font-size: 40px;
        }
    }


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
    height: 300px;
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    img{
        height: 100%;
        width: 100%;
        object-fit: cover;
        transition:linear 1s; 
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
    height: 300px;
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
    background-color: rgb(235,235,235);
}


.non-sponsored{
    margin-top:50px;
}
</style>