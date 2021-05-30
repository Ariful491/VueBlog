import moment from 'moment';
 import Vue from 'vue';

Vue.filter('time',(a)=>{
    return moment(a).format('MMMM Do YYYY');
})
Vue.filter('timeFormat',(a)=>{
    return moment(a).format("MMM Do YYYY");
})

Vue.filter('subString',(content,length)=>{
    if(content.length>length){
        return content.substring(0,length)+'...'
    }
    else {
        return content
    }

})
Vue.filter('Capital',(status)=>{
    return  status.charAt(0).toUpperCase() + status.slice(1);
})
