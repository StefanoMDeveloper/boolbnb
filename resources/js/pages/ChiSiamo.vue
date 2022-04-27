<template>
    <div>
        <div clss="noi row">
            <div class="col-3">
                <i class="fa-brands fa-linkedin"></i> 
                <p>
                    Antony <br>Morgante
                </p>
            </div>
            <div class="col-3">
                <i class="fa-brands fa-linkedin"></i> 
                <p>
                    Fabio <br>Losa
                </p>
            </div>
            <div class="col-3">
                <i class="fa-brands fa-linkedin"></i> 
                <p>
                    Ghadeer <br>Shamshoum
                </p>
            </div>
            <div class="col-3">
                <i class="fa-brands fa-linkedin"></i> 
                <p>
                    Giacomo <br>Benedetti
                </p>
            </div>
            <div class="col-3">
                <i class="fa-brands fa-linkedin"></i> 
                <p>
                    Stefano <br>Martignoni
                </p>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "ChiSiamo",
}
</script>

<style scoped lang="scss">

    .noi{
        margin: 200px 40px;
        justify-content: space-between;

        div{
            text-align: center;
            padding: 10px 5px;
            background-color: lightgray;
            margin:10px;
            
            p{
                margin-left: 5px;
                float: left;
            }

            svg{
                color: #ff385c;
                width: 50px;
                height: 50px;
                vertical-align:text-bottom;
                float: left;
            }
        }
    }

</style>