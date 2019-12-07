import Vue from 'vue';
import moment from 'moment';

Vue.filter('toTimeFormat', (value) => {
  return moment(value).format('HH:mm');
})

Vue.filter('toDateFormat', (value) => {
  return moment(value).format('DD/MM/YYYY');
})
