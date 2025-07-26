
import axios from 'axios';
import jQuery from 'jquery';
import moment from 'moment-timezone';
import select2 from "select2";
import 'datatables.net-dt';

window.$ = jQuery;
window.jQuery = jQuery;
window.axios = axios;
window.moment = moment;
select2($);

$.fn.select2.defaults.set("width", "100%");

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
