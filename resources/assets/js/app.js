/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery');
require('trumbowyg');
window.Vue = require('vue');
window.VueResource = require('vue-resource');
window.moment = require('vue-moment');
import VueTrumbowyg from 'vue-trumbowyg';
Vue.use(require('vue-the-mask'));
Vue.use(VueResource);
Vue.use(moment);
Vue.use(VueTrumbowyg);
// Vue.component('modal-component', require('./components/admin/ModalComponent.vue').default);
