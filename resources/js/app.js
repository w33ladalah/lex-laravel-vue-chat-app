import './bootstrap';
import Vue from 'vue';

Vue.component('chat-component', require('./components/ChatComponent.vue'));

const app = new Vue({
    el: '#app'
});
