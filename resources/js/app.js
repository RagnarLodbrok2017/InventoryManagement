/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import {routes} from './routes'

Vue.use(VueRouter)

//Import User Helper to be globally
import User from './Helpers/User'
window.User = User;

//Import Sweetalert2  as a global
import Swal from "sweetalert2"
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

// axios.defaults.headers.common['Authorization'] = 'Bearer ' + User.getToken();
const refreshToken= ()=>{
    // gets new access token
    axios.get('/api/auth/refreshtoken')
    .then((response) => {
        console.log(response.data);
        // User.responeAfterLogin(res);
        Toast.fire({
            icon: "success",
            title: "Token refershed",
        });
    })
    .catch(error =>{
        console.log("catch error"+ error);
    })
  };
axios.interceptors.request.use(
    config => {
        const token = localStorage.getItem('token');
        if(token)
        {
            config.headers['Authorization'] = 'Bearer '+ token;
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }

);
axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        // console.log("the error is "+ error);
        const { config, data, status } = error.response;
        if ((status == 401) && (data.error === 'token_expired_and_refreshed')) {
            console.log('token_expired_and_refreshed');
            refreshToken();
        }
        if ((status == 401) && (data.error === 'token_expired')) {
            console.log('token_expired');
            // console.log(data.error);
            refreshToken();
        }
        if ((status == 401) && (data.error === 'token_invalid')) {
            console.log('token_invalid');
            // console.log(data.error);
            // this.refreshToken();
            User.responeAfterLogin(error.response.data.token);
        }
    }
);

//import Notification Helpers
import Notification from './Helpers/Notifications';
window.Notification = Notification;

const router = new VueRouter({
    routes,
    mode:'history'
});


const app = new Vue({
    el: '#app',
    router

});
