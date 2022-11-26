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
        if (error.response.status == 403) {
            const newToken = error.response.data.token;
            localStorage.setItem('token', newToken);
            Notification.successWithMessage("please reload the page");
            window.location.reload();
        }
        if (error.response.status == 401) {
            const newToken = error.response.data.token;
            localStorage.setItem('token', newToken);
            Notification.successWithMessage("please reload the page");
            window.location.reload();
        }
        if(error.response.status == 400) {
            localStorage.removeItem('token','user');
            Notification.errorWithMessage("Sign Out");
            window.location.reload();
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
