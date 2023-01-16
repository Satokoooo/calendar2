require('./bootstrap');
import Vue from 'vue';
import router from './router';
import App from './components/App.vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';


window.Vue = Vue;
Vue.use(Vuetify);


// import App from './components/App.vue';

// app.component('app', App);
// app.mount('#app');

new Vue({
    el: '#app',
    router,
    components: {App},
    template: '<App />',
    vuetify: new Vuetify(),
});