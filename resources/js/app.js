
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';

import VueRouter from 'vue-router';
import moment from 'moment';
import VueProgressBar from 'vue-progressbar';
// ES6 Modules or TypeScript
import swal from 'sweetalert2';
import Gate from "./Gate";
import BootstrapVue from 'bootstrap-vue';
import Multiselect from 'vue-multiselect';
import * as VueGoogleMaps from 'vue2-google-maps';
import GmapCustomMarker from 'vue2-gmap-custom-marker';
import VueGallerySlideshow from 'vue-gallery-slideshow';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueCal from 'vue-cal'
import Vue from 'vue'
import vSelect from 'vue-select'


import 'vue-cal/dist/vuecal.css'

import Tooltip from 'vue-directive-tooltip';
import PrettyInput from 'pretty-checkbox-vue/input';
import PrettyCheck from 'pretty-checkbox-vue/check';
import PrettyRadio from 'pretty-checkbox-vue/radio';

import 'vue-directive-tooltip/css/index.css';
Vue.use(Tooltip);

library.add(faUserSecret)
library.add(far)
library.add(fas)

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component('vue-cal', VueCal)
Vue.component('v-select', vSelect)


Vue.config.productionTip = false

Vue.prototype.$gate = new Gate(window.authRole, window.userId);

window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;
window.Form = Form;

Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component('VueGallerySlideshow', require('vue-gallery-slideshow'));
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('multiselect', Multiselect);
Vue.component('p-input', PrettyInput);
Vue.component('p-check', PrettyCheck);
Vue.component('p-radio', PrettyRadio);

Vue.use(VueGallerySlideshow);
Vue.use(BootstrapVue);
Vue.use(VueRouter);




Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '10px'
});

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyDZmLr4kxa_itbFxMK0UdzlSbBAixy9dBg',
        libraries: 'places', // This is required if you use the Autocomplete plugin
        // OR: libraries: 'places,drawing'
        // OR: libraries: 'places,drawing,visualization'
        // (as you require)

        //// If you want to set the version, you can do so:
        // v: '3.26',
    }
});


let routes = [
    { path: '/developer', component: require('./components/Developer.vue') },
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/users', component: require('./components/Users.vue') },
    { path: '/contact', component: require('./components/home/Contact.vue') },
    { path: '/trainers', component: require('./components/Trainers.vue') },
    { path: '/companies', component: require('./components/Companies.vue') },
    { path: '/disciplines', component: require('./components/Disciplines.vue') },
    { path: '/opinions', component: require('./components/Opinions.vue') },
    { path: '/facilities', component: require('./components/Facilities.vue') },
    { path: '/reservations', component: require('./components/Reservations.vue') },
    { path: '/gyms', component: require('./components/Gyms.vue') },
    { path: '/profile', component: require('./components/Profile.vue') },
    { path: '/about', component: require('./components/home/About.vue') },
    { path: '/trainer-panel/about', component: require('./components/home/About.vue') },
    { path: '/trainer-panel/my-reservations', component: require('./components/trainer/Reservations.vue') },
    { path: '/trainer-panel/profile-setup', component: require('./components/trainer/TrainerProfileSetup.vue') },
    { path: '/user-panel/about', component: require('./components/home/About.vue') },
    { path: '/user-panel/profile', component: require('./components/user/Profile.vue') },
    { path: '/register-role', component: require('./components/RegisterRole.vue') },
    { path: '/', component: require('./components/home/Welcome.vue') },
    { path: '/search-trainer', name:'searchTrainer', component: require('./components/home/SearchTrainer.vue'),
        children: [
            { path: '/:id', component: require('./components/home/TrainerView.vue')}
        ]},
    { path: '/gym/:id', name:'gym', component: require('./components/Gym.vue')},
    { path: '/trainer/:id', name:'trainer', component: require('./components/Trainer.vue')},
    /*    { path: '/search-trainer', component: require('./components/home/SearchTrainer.vue'),
        children: [
            { path: '/:id', name:'trainerView', component: require('./components/home/TrainerView.vue')}
        ]
    },*/
    { path: '/search-trainer/:id', name:'trainerView', component: require('./components/home/TrainerView.vue')},
    { path: '/company/:id', name:'company', component: require('./components/Company.vue')},
    { path: '/user/:id', name:'user', component: require('./components/User.vue')},
    { path: '*', component: require('./components/NotFound.vue') }
];

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
});

Vue.filter('upText', function (text) {
    if(text == null || text == undefined) {
        return text
    }
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
    return moment(created).format('DD.MM.YYYY');
});
Vue.filter('myDateTime',function(created){
    return moment(created).format('D/MM/YYYY h:mm:ss');
});

window.Fire =  new Vue();
window.DestroyedComponents = new Array();
window.IndexesWhichCallLookup = new Array();

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component(
    'example-component',
    require('./components/ExampleComponent.vue'));

Vue.component(
    'not-found',
    require('./components/NotFound.vue')
);
Vue.component(
    'lookup',
    require('./components/Lookup.vue')
);
Vue.component(
    'add-opinion',
    require('./components/AddOpinion.vue')
);
Vue.component(
    'offer-selection',
    require('./components/trainer/OfferSelection.vue')
);
Vue.component(
    'trainer-offer',
    require('./components/home/TrainerOffer.vue')
);
Vue.component(
    'trainer-view',
    require('./components/home/TrainerView.vue')
);
Vue.component(
    'calendar',
    require('./components/Calendar.vue')
);

const app = new Vue({
    el: '#app',
    router,
    data:{
        search: '',
        from: '',
        to: ''
    },
    methods:{
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        },1000),
        printme() {
            window.print();
        },
        redirectTo(site) {
            window.open(site, '_blank');
        }
    }
});
