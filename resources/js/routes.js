let dashboardComponent =  require('./components/dashboard/DashboardComponent.vue').default;
let loginComponent =  require('./components/auth/LoginComponent.vue').default;
let registerComponent =  require('./components/auth/RegisterComponent.vue').default;
let forgetPasswordComponent =  require('./components/auth/ForgetPasswordComponent.vue').default;
let homeComponent = require('./components/HomeComponent.vue').default;
let logoutComponent = require('./components/auth/LogoutComponent.vue').default;
//Employees Routes
let CreateEmployeeComponent = require('./components/employees/CreateComponent.vue').default;
let IndexEmployeeComponent = require('./components/employees/IndexComponent.vue').default;






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
        // children: [
        //     {
        //       path: '/create-employee',
        //       name : 'create-employee',
        //       component: CreateEmployeeComponent,
        //     },
        //     {
        //       path: '/index-employees',
        //       name : 'index-employees',
        //       component: IndexEmployeeComponent,
        //     },
        // ]
        // meta: {
        //     middleware: [auth],
        //   },
    },
    {
        path:'/logout',
        name : 'logout',
        component:logoutComponent
    },
    {
        path:'/dashboard/create-employee',
        name : 'create-employee',
        component: CreateEmployeeComponent
    },
    {
        path:'/dashborard/index-employees',
        name : 'index-employees',
        component: IndexEmployeeComponent
    },
    // {
    //     path: '/:catchAll(.*)*',
    //     name: "PageNotFound",
    //     component: PageNotFound,
    //   },

]
