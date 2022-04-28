<template>
  <div class="container page404">
    <div class="row mt-8 m-8 justify-content-center container-body">
      <div class="col-md-5 align-self-center">
        <h1 class="text-jumbo text-ginormous hide-sm">Ops!</h1>
        <h2>Non troviamo la pagina che stai cercando.</h2>
        <h6>Codice errore: 404</h6>
        <ul class="list-unstyled">
          <li>Ecco qualche link utile:</li>
          <li><a href="/" class="link-404">Home</a></li>
          <li><a href="/appartamenti" class="link-404">Appartamenti</a></li>
        </ul>
      </div>
      <div class="col-md-5 align-self-center text-center">
        <img src="https://a0.muscache.com/airbnb/static/error_pages/404-Airbnb_final-d652ff855b1335dd3eedc3baa8dc8b69.gif"
            width="313"
            height="428"
            class="hide-sm"
            alt="La bambina ha fatto cadere il gelato." />
      </div>
    </div>
  </div>
</template>

<script>
export default {
    name: "PageNotFound"
};
</script>

<style lang="scss" scoped>

.page404{
    margin-top: 200px;
}

img{
    width:313px;
    height:428px;
}

@media (max-width: 768px) {
    img{
        display:none;
    }
}

h1{
    font-size: 60px;
}

.container-body{
  min-height: calc(100vh - 710px);
}

  
</style>