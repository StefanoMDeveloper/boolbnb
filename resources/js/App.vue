<template>
    <body>
        <Header @filter="filterApartments" />
        <Main :apartmentList=apartments />
        <Footer />
    </body>
</template>

<script>
import Header from "./components/Header.vue";
import Main from "./components/Main.vue";
import Footer from "./components/Footer.vue";
export default{
    name: "App",
    components: {
        Header,
        Main,
        Footer
    },
    data(){
        return{
            filteredApartments:[]
        }
    },
    methods:{
        filterApartments: function(data){
            data.search = data.search.replace(", ", "-");
            axios
                .get("/api/apartments/filter/search="+data.search+"&radius="+data.radius+"&beds="+data.beds+"&rooms="+ data.rooms+"&lat="+data.lat+"&lon="+data.lon+"&services="+ data.services)  
                .then((response) => {
                    this.filteredApartments = response.data;
                });             
        }
    },
    computed:{
        apartments(){
            return this.filteredApartments;
        }
    }
}
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300;400;500&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing: border-box;
    font-family: 'Open Sans', sans-serif;
    font-family: 'Roboto', sans-serif;
}

body{
    min-width: 375px;
    background-color: white;
}

</style>