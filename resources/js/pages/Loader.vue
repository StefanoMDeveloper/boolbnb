<template>
    <div class="loader">
         <div class="container-fluid">
            <div class="row">
                <div class="header-container col-12">
                    <!-- header left -->
                    <div class="col-3 d-none d-xl-block headerleft">
                        <i class="fa-brands fa-airbnb"></i>
                        <span>Boolbnb</span>    
                    </div>
                </div>
            </div>
        </div>
        <div class="loading d-flex flex-column justify-content-center align-items-center">
            <i class="fa-brands fa-airbnb"></i>
            <span>Boolbnb</span>
             <div class="col-3">   
                <i class="ex-10-icon fas fa-circle-notch"></i> 
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Loader'
}
</script>

<style lang="scss" scoped>
.loader {
    
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    background-color: white;
    transition: .5s ease all;
    z-index: 9999;
    .container-fluid{
        width: 100%;
        height: 40px;
        background-color: white;
        color: black;
        .header-container{
            position:relative;
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            .headerleft{
            font-size: 26px;
            font-weight: 500;
            padding-left: 7%;
            transition: 1s ease all; 
                i{
                    color: black;  
                }
                span{
                    color: #ff385c;
                }
            
            }
        }
    }
   
    .loading { 
        height: calc(100vh - 40px);
        color: black;
        font-size: 60px;
        letter-spacing: 2px; 
        i{
            color: black;  
        }
        span{
            color: #ff385c;
        }
        
    }
}
.ex-10-icon{
animation: spin 1s linear infinite;
}

@keyframes spin {
    100%{
        transform: rotate(1turn);
    }
  
}

</style>