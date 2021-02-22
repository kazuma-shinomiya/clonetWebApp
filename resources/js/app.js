
import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import CoordinationTagsInput from './components/CoordinationTagsInput'

const app = new Vue({
    el: '#app',
    components: {
        ArticleLike,
        CoordinationTagsInput,
    }
})

// window.Vue = require('vue');




