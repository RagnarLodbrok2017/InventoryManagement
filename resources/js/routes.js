let dashboardComponent =  require('./components/dashboard/DashboardComponent.vue').default;
let loginComponent =  require('./components/auth/LoginComponent.vue').default;
let registerComponent =  require('./components/auth/RegisterComponent.vue').default;
let forgetPasswordComponent =  require('./components/auth/ForgetPasswordComponent.vue').default;
let homeComponent = require('./components/HomeComponent.vue').default;
let logoutComponent = require('./components/auth/LogoutComponent.vue').default;






export const routes = [
    {
        path:'/login',
        name : 'login',
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
        path:'/dashboard',
        name : 'dashboard',
        component:dashboardComponent,
        // meta: {
        //     middleware: [auth],
        //   },
    },
    {
        path:'/logout',
        name : 'logout',
        component:logoutComponent
    },
]
