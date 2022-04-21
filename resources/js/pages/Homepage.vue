<template>
    <div>
        <!-- jumbotron -->
        <div class="container-fluid">
            <div class="row ms_jumbotron">
                <div class="ms_imagecontainerJumbo col-10 p-0">
                    <img  src="../../../public/storage/uploads/jubotron.jpg" alt="">
                    <div class="ms_textcontainer">
                        <h1 class="text-white ms_textJombo">Lasciati guidare dalla curiosità</h1>
                                <p>{{test}}</p>
                        <button>Sono flessibile</button>
                    </div>
                </div>
            </div>            
        </div>
        
        <!-- cities cards -->
        <div class="container-fluid">
            <div class="row ms_citiesContainer d-flex">
                <div v-for="(element, index) in cities" :key="index" class="ms_cityCard"  :style="{'background-color':colors[index]}">
                    <div class="ms_imageContainer">
                        <img :src="require('../../../public/storage/uploads/'+element.image+'.jpg') " alt="">
                    </div>
                    <div class="ms_textcity">
                        <h1 class="text-white">{{element.title}}</h1>
                        <h4 class="text-white">{{element.text}}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Esperienze Boolbnb -->
        <div class="container-fluid">
            <div class="row ms_experienceContainer">
                <h1>Scopri le Esperienze Boolbnb</h1>
                <div class="ms_imgsEsp">
                    <div class="ms_imgEsp">
                        <img  src="../../../public/storage/uploads/experience2.jpg" alt="">
                        <h1 class="ms_esptext text-white">Esperienze <br> per il tuo viaggio</h1>
                    </div>
                    <div class="ms_imgEsp">
                        <img  src="../../../public/storage/uploads/experience1.jpg" alt="">
                        <h1 class="ms_esptext text-white">Attività <br> da casa</h1>
                    </div>  
                </div>
            </div>
        </div>

        <!-- gift card  -->
        <div class="container-fluid">
            <div class="row ms_giftContainer">
                <div class="col-4">
                    <h1 class="ms_giftFont">Acquista <br> le gift card <br> di Airbnb</h1>
                </div>
                <div class="ms_giftImg col-8">
                    <img  src="../../../public/storage/uploads/gift.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Homepage",
    data(){
      return{
          test : "",
          colors:['#DE3151', '#BC1A6E', '#CC2D4A', '#D93B30'],
          cities:[
              {
                image:"city1",
                title:"Napoli",   
                text:"189 chilometri di distanza",
              },
              {
                image:"city2",
                title:"Bologna",
                text:"303 chilometri di distanza",
              }, 
              {
                image:"city3",
                title:"Roccaraso",
                text:"132 chilometri di distanza",
              }, 
              {
                image:"city4",
                title:"Verona",
                text:"411 chilometri di distanza",
              },     
          ]
      }
    },
    created(){
        this.test = this.logged_in;
    }

}
</script>

<style lang="scss" scoped>
.ms_jumbotron{
    background-color: black;
    height: 800px;
    display: flex;
    justify-content: center;
    position: relative;
    
    .ms_imagecontainerJumbo{
        margin-top: 200px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 712px;
        width: 1319px;
        border-radius: 20px;
        overflow: hidden;
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .ms_textcontainer{
            position: absolute;
                bottom: 30px;
                left: 50%;
                transform:translate(-50%, -50%);
                width: 700px;
                display: flex;
                flex-direction: column;
                align-items: center;
            .ms_textJombo{
                font-size: 50px;
                text-align: center;
            }
            button{
                margin:15px auto;
                padding:12px 22px;
                border: none;  
                border-radius: 20px;  
                font-size: 15px;      
                color: rgb(64, 14, 64);  
                }
        }
    }
    
}
.ms_citiesContainer { 
    width: 1319px ;
    margin:80px auto;
    display: flex;
    justify-content: space-between;
    .ms_cityCard{
        width: calc(100% / 4 - 20px);
        margin-top: 200px;
        border-radius: 20px;
       
        height: 400px;
        overflow: hidden;
        .ms_imageContainer{
            height: 200px;
            width: 100%;
            overflow: hidden;
            img{
                width: 100%;
                object-fit: cover;
            }
        }
        .ms_textcity{
            padding: 20px;
        }
    
    }
}
.ms_experienceContainer{
    width: 1319px ;
    margin:40px auto;
    .ms_imgsEsp{
        width: 100%;
        display: flex;
        justify-content: space-between;
        .ms_imgEsp{
            width: 647px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            img{
                width: 100%;
            }
            .ms_esptext{
                position: absolute;
                top: 80px;
                left: 60px;
                font-size: 60px;
            }
        }
    }
}

.ms_giftContainer{
    width: 1319px ;
    margin:100px auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    .ms_giftFont{
        font-size: 65px;
    }
    .ms_giftImg{
        img{
            width: 100%;
        }
    }
}
</style>
