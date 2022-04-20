<template>
    <div>
        <div class="jubotron">
            <div class="imagecontainerJubo">
                <img  src="../../../public/storage/uploads/jubotron.jpg" alt="">
            </div>            
        </div>
        
        <div class="citiesContainer d-flex">
            <div v-for="(element, index) in cities" :key="index" class="cityCard">
                <div class="imageContainer">
                    <img :src="require('.../../../public/storage/uploads/'+element.image+'.jpg') " alt="">
                </div>
                <div class="textcity">
                    <h1 class="text-white">{{element.title}}</h1>
                    <h4 class="text-white">{{element.text}}</h4>
                </div>
            </div>
        </div>

        <div class="experienceContainer">
            <h1>Scopri le Esperienze Boolbnb</h1>
            <div class="imgsEsp">
                <div class="imgEsp">
                    <img  src="../../../public/storage/uploads/experience2.jpg" alt="">
                    <h1 class="esptext text-white">Esperienze <br> per il tuo viaggio</h1>
                </div>
                <div class="imgEsp">
                    <img  src="../../../public/storage/uploads/experience1.jpg" alt="">
                    <h1 class="esptext text-white">Attività <br> da casa</h1>
                </div>  
            </div>
        </div>

        <div class="giftContainer">
            <div class="col-4">
                <h1 class="giftFont">Acquista <br> le gift card <br> di Airbnb</h1>
            </div>
            <div class="giftImg col-8">
                <img  src="../../../public/storage/uploads/gift.jpg" alt="">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Homepage",
    data(){
      return{
          cities:[
              {
                image:"city1",
                title:"Napoli",   
                text:"189 chilometri di distanza"
              },
              {
                image:"city2",
                title:"Bologna",
                text:"303 chilometri di distanza"
              }, 
              {
                image:"city3",
                title:"Roccaraso",
                text:"132 chilometri di distanza"
              }, 
              {
                image:"city4",
                title:"Verona",
                text:"411 chilometri di distanza"
              },     
          ]
      }
    }
}
</script>

<style lang="scss" scoped>
.jubotron{
    background-color: black;
    height: 800px;
    display: flex;
    justify-content: center;
    
    .imagecontainerJubo{
        margin-top: 200px;
        transform: translate(-50%, -50%);
        position: absolute;
        top: 50%;
        left: 50%;
        overflow: hidden;
        height: 712px;
        width: 1319px;
        border-radius: 20px;
        img{
            width: 100%;
            object-fit: cover;
        }
    }
    
}
.citiesContainer { 
    width: 1319px ;
    margin:80px auto;
    display: flex;
    justify-content: space-between;
    .cityCard{
        width: calc(100% / 4 - 20px);
        margin-top: 100px;
        border-radius: 20px;
        background-color: #BC1A6E;
        height: 400px;
        overflow: hidden;
        .imageContainer{
            height: 200px;
            width: 100%;
            overflow: hidden;
            img{
                width: 100%;
                object-fit: cover;
            }
        }
        .textcity{
            padding: 20px;
        }
    
    }
}
.experienceContainer{
    width: 1319px ;
    margin:40px auto;
    .imgsEsp{
        display: flex;
        justify-content: space-between;
        .imgEsp{
            width: 647px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            img{
                width: 100%;
            }
            .esptext{
                position: absolute;
                top: 80px;
                left: 60px;
                font-size: 60px;
            }
        }
    }
}

.giftContainer{
    width: 1319px ;
    margin:100px auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    .giftFont{
        font-size: 65px;
    }
    .giftImg{
        img{
            width: 100%;
        }
    }
}
</style>
