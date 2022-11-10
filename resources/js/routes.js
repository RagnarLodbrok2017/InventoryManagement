let dashboardComponent =  require('./components/dashboard/DashboardComponent.vue').default;
let loginComponent =  require('./components/auth/LoginComponent.vue').default;
let registerComponent =  require('./components/auth/RegisterComponent.vue').default;
let forgetPasswordComponent =  require('./components/auth/ForgetPasswordComponent.vue').default;
let homeComponent = require('./components/HomeComponent.vue').default;
let logoutComponent = require('./components/auth/LogoutComponent.vue').default;
//Employees Routes
let CreateEmployeeComponent = require('./components/employees/CreateComponent.vue').default;
let IndexEmployeeComponent = require('./components/employees/IndexComponent.vue').default;

//Suppliers Routes
let CraeteSupplierComponent = require('./components/suppliers/CreateComponent.vue').default;
let IndexSupplierComponent = require('./components/suppliers/IndexComponent.vue').default;

//Categories Routes
let IndexCategoryComponent = require('./components/categories/indexComponent.vue').default;

//Products Routes
let IndexProductComponent = require('./components/products/indexComponent.vue').default;






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
        path:'/dashboard/index-employee',
        name : 'index-employee',
        component: IndexEmployeeComponent
    },
    // {
    //     path: '/:catchAll(.*)*',
    //     name: "PageNotFound",
    //     component: PageNotFound,
    //   },
    {
        path:'/dashboard/create-supplier',
        name : 'create-supplier',
        component: CraeteSupplierComponent,
    },
    {
        path:'/dashboard/index-supplier',
        name : 'index-supplier',
        component: IndexSupplierComponent,
    },
    {
        path:'/dashboard/index-category',
        name: 'index-category',
        component:IndexCategoryComponent
    },
    {
        path:'/dashboard/index-product',
        name: 'index-product',
        component:IndexProductComponent
    }

]
