import  '../sass/frontend/lib/easing/easing.min';
import  '../sass/frontend/lib/wow/wow';
import  '../sass/frontend/lib/owlcarousel/owl.carousel.min';
import  '../sass/frontend/lib/isotope/isotope.pkgd.min';
import  '../sass/frontend/lib/lightbox/js/lightbox.min';
import  '../sass/frontend/mail/jqBootstrapValidation.min';
import  '../sass/frontend/mail/contact';
// import  '../sass/frontend/js/main.js';

window.axios = require('axios');


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



window.Vue = require('vue');//vue import

import VueRouter from 'vue-router'//vue router import

Vue.use(VueRouter)// use vue router in vue js




//vuex
import Vuex from 'vuex'

Vue.use(Vuex)
import storeData from "./store/store";

const store = new Vuex.Store(
    storeData
);
//end vuex



//moment js
import {moment} from './filter/filter'


import {routes} from './public-routes/routes';

const router = new VueRouter({
    routes,
    // mode:'history',
})


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('public-master',require('./components/frontend/public').default)
 Vue.component('header-top',require('./components/frontend/includes/headerTop').default)
 Vue.component('footer-bottom',require('./components/frontend/includes/footerBottom').default)
 // Vue.component('home-part',require('./components/frontend/home').default)
Vue.component('pagination', require('laravel-vue-pagination'));


import './helpers/mixin';
// import public_master from "./components/frontend/public";
// import header_top from "./components/frontend/includes/header";
// import footer_bottom from "./components/frontend/includes/footer";

const app = new Vue({
    el: '#content',
    router,
    store,
    // components:{
    //     'public-master':public_master,
    //     'header-top':header_top,
    //     'footer-bottom':footer_bottom,
    // }



});

