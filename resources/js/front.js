//require('./bootstrap');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

import App from './App.vue'
import router from './router'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js' 
import Vue from 'vue';

/* const globalVariables = {
    data(){
        return {
            authUser: 'false'
        }
    }
} */

// Vue.prototype.$hostname = 'your variable name'

Vue.prototype.authUser = '0';

const app = new Vue({
    el:'#app',
    render: h => h(App),
    router
});

// app.mixin(globalVariables);

