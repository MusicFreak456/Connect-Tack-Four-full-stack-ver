require('./bootstrap');

import GameStoreModule from './store_modules/GameStore.vue';
import Game from './components/game/Game';
import Rules from './components/rules/Rules';
import About from './components/about/About';
import Login from './components/auth/Login';
import Register from './components/auth/Register';

import VueRouter from 'vue-router';
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
Vue.use(VueRouter);

const routes = [
    {path: '/', component: Game},
    {path: '/about', component: About},
    {path: '/rules', component: Rules},
    {path: '/login', component: Login},
    {path: '/register', component: Register}
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

const store = new Vuex.Store({
    state: {
        activeTab: 1,
        username: undefined
    },
    modules: {
        GameStoreModule: GameStoreModule
    },
    mutations: {
        changeActiveTab(state, newId){
            state.activeTab = newId;
        },

        setUsername(state, username){
            state.username = username;
        }
    }
}) 


Vue.component('App', require('./components/App.vue').default);
Vue.component('Navbar',require('./components/navbar/Navbar.vue').default);


const app = new Vue({
    el: '#app',
    store: store,
    router: router
});
