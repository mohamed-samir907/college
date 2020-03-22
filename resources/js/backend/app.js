
require('./bootstrap');
require('./global');
import Vue              from 'vue';
import VueRouter        from 'vue-router'
import Vuex             from 'vuex';
import routes           from './routes';
import StoreData        from './store';
import VueProgressBar   from 'vue-progressbar'

Vue.use(VueRouter)
Vue.use(Vuex);
Vue.use(VueProgressBar, {
    color: '#34a853',
    failedColor: '#ea4335',
    thickness: '5px'
});

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

router.afterEach((to, from) => {

    $('#beWrapper').removeClass('be-aside');
    $('#beContent').removeClass('be-no-padding')

});

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('navigation', require('./components/Navigation').default);
Vue.component('error-alert', require('./components/ErrorAlert').default);
Vue.component('success-alert', require('./components/SuccessAlert').default);
// Vue.component(HasError.name, HasError);

const app = new Vue({
    el: '#app',
    router,
    store
});

let link = document.querySelector('#mainMenu li a');
let subLink = document.querySelector('#mainMenu li ul li a');

link.addEventListener('click', function() {
    link.parentNode.classList.add("active");
});

subLink.addEventListener('click', function() {
    subLink.parentNode.classList.add("active");
});
