

require("./bootstrap");

window.Vue = require("vue").default;

// import $ from 'jquery';
import Form from 'vform';
import HasError from 'vform';
import AlertError from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

import Vue from "vue";
import VueRouter from "vue-router";
import axios from 'axios';
Vue.use(VueRouter);
Vue.use(axios);

//import sweet alert
let Fire = new Vue();
window.Fire = Fire;
import Swal from 'sweetalert2'
window.Swal = Swal;


let routes =[
    {path:'/dashboard', component:require("./components/Dashboard.vue").default},
    {path:'/data-outlet', component:require("./components/Outlet.vue").default},
    {path:'/data-paket', component:require("./components/Paket.vue").default},
    {path:'/data-member', component:require("./components/Member.vue").default},
    {path:'/data-pengurus', component:require("./components/Pengurus.vue").default},
]

Vue.component(
    "example-component", require("./components/ExampleComponent.vue").default
);



const router = new VueRouter({
    mode: 'history',
    routes,
});

const app = new Vue({
    el: "#app",
    router,
});
