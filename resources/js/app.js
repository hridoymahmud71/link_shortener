
import Vue from 'vue';

// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component(
    "link-generation-component",
    require("./components/LinkGenarationComponent.vue").default
);

// Initialize Vue
const app = new Vue({
    el: '#app',
});
