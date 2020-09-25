require('./bootstrap');

window.Vue = require('vue');

import VueClipboard from 'vue-clipboard2';
Vue.use(VueClipboard)

import moment from 'moment';
window.moment = moment

import router from "./router";
import filter from "./filter";

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    // timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer)
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
});
window.toast = toast;

import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('my-app', require('./components/App.vue').default);

const app = new Vue({
    el: '#app',
    router,
});
