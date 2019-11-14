window._ = require('lodash');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let root = document.head.querySelector('meta[name="root"]').content;
console.log(root)
axios.defaults.baseURL = `${root}api`;

