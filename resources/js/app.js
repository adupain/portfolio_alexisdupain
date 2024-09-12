/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery')
import './bootstrap';
const _ = require('lodash');
//  global.$ = global.jQuery = require('jquery');
import Vue from "vue";
window.Vue = require('vue').default;
// //bootstrap vue
// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// // Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

// // Make BootstrapVue available throughout your project
// Vue.use(BootstrapVue)
// // Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin)

// import {VGrid} from '@revolist/vue-datagrid';

// //

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/*
Split des fichiers vue en js :
installer babel-plugin-syntax-dynamic-import et babel-preset-env avec npm
Créer le fichier .babelrc à la racine du projet
{
    "presets": [
        "@babel/preset-env"
    ],
    "plugins": [
        "babel-plugin-syntax-dynamic-import"
    ]
}
dans le app.js
const files = require.context('./components/', true, /\.vue$/i,'lazy'); //mettre lazy à la fin sinon ça ne splittera pas les js
files.keys().map(key => Vue.component( (key.split('/').pop().split('.')[0]).replace(/([a-zA-Z])(?=[A-Z])/g,'$1-').toLowerCase(), () => import('./components'+key.replace('.',''))));


*/
//Enregistre automatiquement tous les composants .vue avec la base du fichier:
//Ex: components/commercial/TotoTutu.vue => composant à cherger sera <toto-tutu></toto-tutu>
const files = require.context('./components/', true, /\.vue$/i,'lazy');
files.keys().map(key => Vue.component( (key.split('/').pop().split('.')[0]).replace(/([a-zA-Z])(?=[A-Z])/g,'$1-').toLowerCase(), () => import('./components'+key.replace('.',''))));

// dans un blade
//  const app = new Vue({
//     el: '#app',

// });

