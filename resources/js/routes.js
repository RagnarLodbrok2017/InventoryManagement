let dashboardComponent =  require('./components/dashboard/DashboardComponent.vue').default;
let loginComponent =  require('./components/auth/LoginComponent.vue').default;
let registerComponent =  require('./components/auth/RegisterComponent.vue').default;
let forgetPasswordComponent =  require('./components/auth/ForgetPasswordComponent.vue').default;
let homeComponent = require('./components/HomeComponent.vue').default;






export const routes = [
    {
        path:'/login',
        name : '/login',
        component:loginComponent
    },
    {
        path:'/register',
        name : '/register',
        component:registerComponent
    },
    {
        path:'/forget',
        name : '/forget',
        component:forgetPasswordComponent
    },
    {
        path:'/',
        name : '/',
        component:dashboardComponent
    },
    {
        path:'/home',
        name : 'home',
        component:homeComponent,
        // meta: {
        //     middleware: [auth],
        //   },
    }
]
