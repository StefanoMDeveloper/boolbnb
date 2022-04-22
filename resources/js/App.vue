<template>
    <div>
        <Header @filter="filterApartments" />
        <Main :apartmentList=apartments />
        <Footer />
    </div>
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
            alert("/api/apartments/filter/search=" + data.search +"&radius=20000&lat="+data.lat + "&lon="+data.lon);
            axios
                .get("/api/apartments/filter/search=" + data.search +"&radius=20000&lat="+data.lat + "&lon="+data.lon)
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
*{
    margin:0;
    padding:0;
    box-sizing: border-box;
}
</style>