<template>
    <footer>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-10 containerFooter1 d-flex justify-content-between align-items-center">
                    <ul>
                        <li><b>Assistenza</b></li>
                        <li><a href="#">Centro Assistenza</a></li>
                        <li><a href="#">Informazioni di sicurezza</a></li>
                        <li><a href="#">Opzioni di cancellazione</a></li>
                        <li><a href="#">Segnala problemi</a></li>
                    </ul>
                    <ul>
                        <li><b>Community</b></li>
                        <li><a href="#">Boolbnb.org: un rifugio sicuro</a></li>
                        <li><a href="#">Supporta i rifugiati afghani</a></li>
                        <li><a href="#">Contro la discriminazione</a></li>
                    </ul>
                    <ul>
                        <li><b>Ospitare</b></li>
                        <li><a href="#">Prova ad ospitare</a></li>
                        <li><a href="#">BoolCover: host protetti</a></li>
                        <li><a href="#">Esplora le risorse per host</a></li>
                        <li><a href="#">Vai al forum della community</a></li>
                        <li><a href="#">Come ospitare responsabilmente</a></li>
                    </ul>
                    <ul>
                        <li><b>Informazioni</b></li>
                        <li><a href="#">Lettera dai nostri fondatori</a></li>
                        <li><a href="#">Assistenza</a></li>
                        <li><a href="#">Opportunità di lavoro</a></li>
                    </ul>
                </div>
            </div>        
        </div>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-11 d-flex justify-content-between">
                    <div>
                        <span><a href="#"><i class="far fa-copyright"></i>2022 Boolbnb, Inc. &nbsp;&nbsp;•</a></span>
                        <span><a href="#">Privacy &nbsp;&nbsp;•</a></span>
                        <span><a href="#">Termini &nbsp;&nbsp;•</a></span>
                        <span><a href="#">Mappa del sito &nbsp;&nbsp;•</a></span>
                        <span><a href="#">Dettagli dell'azienda</a></span>
                    </div>
                    <div>
                        <span style="text-decoration: underline;"><i class="fas fa-globe"></i>Italiano (IT)</span>
                        <span style="text-decoration: underline;"><i class="fas fa-euro-sign"></i>EUR</span>
                        <span><i class="fab fa-facebook-f"></i></span>
                        <span><i class="fab fa-twitter"></i></span>
                        <span><i class="fab fa-instagram"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
};
</script>

<style lang="scss" scoped>
footer {
    background-color: #eeeeee;

    ul {
        list-style-type: none;
    }

    li {
        padding-bottom: 10px;
    }

    a {
        color: black;
        text-decoration: none;
    }

    span {
        padding: 0 4px;
    }

    .containerFooter1 {
        padding: 120px 40px 0;
        border-bottom: 1px solid #dddddd;
    }

    .containerFooter2 {
        padding: 40px 0;
    }

    .fa-globe, .fa-euro-sign {
        margin-right: 4px;
    }

    .fa-facebook-f {
        margin-left: 35px;
    }

    .fa-twitter, .fa-instagram {
        margin-left: 10px;
    }

    .fa-facebook-f, .fa-twitter, .fa-instagram {
        font-size: 20px;
    }
}
</style>