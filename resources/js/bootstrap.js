import axios from 'axios';
import $ from 'jquery';

window.axios = axios;
window.jQuery = window.$ = $;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
