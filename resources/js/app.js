

require('./bootstrap');

window.Vue = require('vue');//vue import
import VueRouter from 'vue-router'//vue router import

Vue.use(VueRouter)// use vue router in vue js
//vform
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
//
// end vform
 window.Form = Form  //globally use form


import Swal from  'sweetalert2' //import sweet alert2

window.Swal = Swal; //globally use this alert


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast //globally using this alert.


import toastr from 'toastr';  // toastr js import
window.toastr = toastr//globally use
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


import {routes} from './routes/routes';

 const router = new VueRouter({
        routes,
        // mode:'history',
 })


// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//  Vue.component('dashboard',require('./components/backend/home/dashboard').default)

import './helpers/mixin';


const app = new Vue({
    el: '#content',
    router,
    store,

});
