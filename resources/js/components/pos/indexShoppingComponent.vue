<template>
    <div id="index-product">
        <!-- Form Basic -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Shopping Management:</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
        </div>
        <div class="row mb-3">
            <!-- Shopping Card -->
            <div class="col-xl-5 col-lg-5">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                        <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                                class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="table-responsive" style="font-size: 12px;">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="cart in carts" :key="cart.id">
                                    <td>{{ cart.product_name }}</td>
                                    <td><input type="text" readonly="" style="width: 15px;"
                                            :value="cart.quantity">
                                    </td>
                                    <td>{{ cart.product_price }}</td>
                                    <td>{{ cart.total_price }}</td>
                                    <td><a @click="removeItemFromCart(cart.id)" class="btn btn-sm btn-primary">
                                            <font color="#ffffff">X</font>
                                        </a></td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="card-footer">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">Total
                                Quantity:
                                <strong>{{ qty }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                                <strong>{{ subtotal }} $</strong>
                            </li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">Vat:
                                <strong>{{ vats.vat }} %</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">Total :
                                <strong>{{ subtotal * vats.vat / 100 + subtotal }} $</strong>
                            </li>

                        </ul>
                        <br>

                        <form @submit.prevent="orderdone">
                            <label>Customer Name</label>
                            <select class="form-control" v-model="customer_id">
                                <option :value="customer.id" v-for="customer in customers">{{ customer.name }}
                                </option>

                            </select>

                            <label>Pay</label>
                            <input type="text" class="form-control" required="" v-model="pay">

                            <label>Due</label>
                            <input type="text" class="form-control" required="" v-model="due">

                            <label>Pay By</label>
                            <select class="form-control" v-model="payby">
                                <option value="HandCash">Hand Cash </option>
                                <option value="Cheaque">Cheaque </option>
                                <option value="GiftCard">Gift Card </option>
                            </select>

                            <br>
                            <button type="submit" class="btn btn-success">Submit</button>

                        </form>



                    </div> -->
                </div>
            </div>
            <!-- Products From Customer -->
            <div class="col-xl-7 col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header py-3 bg-primary d-flex flex-row align-items-center justify-content-between">
                        <div class="col-6">
                            <h5 class="m-0 font-weight-bold text-light">Products:</h5>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" v-model="searchTerm" placeholder="Search Here" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="customer-message align-items-center">
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    <button class="nav-link active" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                     aria-selected="true" @click="fetchProducts()">All Products</button>
                                    <button v-for="category in categories" :key="category.id" class="nav-link" id="nav-contact-tab" data-toggle="tab"
                                        data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                        aria-selected="true" @click="getProductsByCategory(category.id)">{{ category.name }}</button>
                                </div>
                            </nav>
                            <div class="tab-content mt-3">
                                <div class="align-items-center">
                                    <div class="noMargin row row-cols-1 row-cols-md-3">
                                        <div class="col mb-4" v-for="product in filterSearch">
                                            <button @click.prevent="addToShoppingcard(product.id)" class="">
                                            <div class="card h-100">
                                              <img :src="'/'+product.photo" class="card-img-top" alt="...">
                                              <div class="card-body">
                                                <h6 class="card-title">
                                                    {{product.name}}
                                                </h6>
                                                <p class="card-text">
                                                    <span class="badge badge-success" v-if="product.quantity >=1">
                                                        Available: {{product.quantity}}
                                                    </span>
                                                    <span v-else class="badge badge-danger">
                                                        Stock out
                                                    </span>
                                                </p>
                                              </div>
                                              <div class="card-footer">
                                                <p class="font-weight-bold">
                                                    Price: <small class="text-muted">{{product.selling_price}}</small>
                                                </p>
                                              </div>
                                            </div>
                                        </button>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <a class="m-0 small text-primary card-link" href="#">View More <i
                                    class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Products Table</h6>
                        <div class="col-4">
                            <input type="text" class="form-control" v-model="searchTerm" placeholder="Search Here" />
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Details</th>
                                    <th>Amount $</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="product in filterSearch" :key="product.id">
                                    <td>{{ product.id }}</td>
                                    <td>{{ product.details }}</td>
                                    <td>{{ product.amount }}</td>
                                    <td>{{ product.product_date }}</td>
                                    <td>
                                        <button class="btn btn-success">Profile</button>
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target=".editExpense-lg" @click="editExpense(product)">Edit</button>
                                        <button @click="deleteExpense(product.id)"
                                            class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- Edit Expense Form -->
                            <div class="modal fade editExpense-lg" tabindex="-1" role="dialog"
                                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Expense</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <form @submit.pervent="">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-12">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">*Expense
                                                                            Details:</span>
                                                                    </div>
                                                                    <textarea @change="checkExpense()"
                                                                        v-model="editForm.details" required
                                                                        class="form-control"
                                                                        aria-label="With textarea"></textarea>
                                                                    <small class="text-danger" v-if="errors.details">
                                                                        {{ errors.details[0] }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-12">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">*Amount $</span>
                                                                    </div>
                                                                    <input v-model="editForm.amount" required
                                                                        type="number" class="form-control"
                                                                        aria-label="Amount (to the nearest dollar)">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text">.00</span>
                                                                    </div>
                                                                    <small class="text-danger" v-if="errors.amount">
                                                                        {{ errors.amount[0] }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <div class="col-12">
                                                                <div class="input-group mb-3">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"
                                                                            id="basic-addon3">{{ editForm.product_date
                                                                            }}</span>
                                                                    </div>
                                                                    <input v-model="editForm.product_date" type="date"
                                                                        class="form-control" id="basic-url"
                                                                        aria-describedby="basic-addon3">
                                                                </div>
                                                                <small class="text-danger" v-if="errors.product_date">
                                                                    {{ errors.product_date[0] }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary"
                                                @click="updateExpense(editForm)">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>


</template>
<script type="text/javascript">
export default {
    created() {
        if (!User.loggedIn()) {
            this.$router.push("/login");
        }
        this.fetchProducts();
        this.fetchcategories();
        this.fetchCustomers();
        this.fetchShoppingCarts();
        // this.getUser();
        this.refreshToken();
    },
    data() {
        return {
            user:{},
            user2:{},
            products: [],
            categories:[],
            getProducts:[],
            customers:[],
            carts:[],
            errors: {},
            product: {},
            searchTerm: "",
            editForm: {
                details: null,
                amount: null,
                product_date: null,
            },
        }
    },
    methods: {
        getUser(){
            axios.get('/api/auth/user')
               .then((response) => {
                    this.user = response.data;
               })
               .catch(error =>{
                // console.log(error.response.data.error);
               })
            },
        refreshToken() {
            axios.get('/api/auth/refreshtoken')
                .then((res) => {
                    //   console.log(res.data);
                    User.responeAfterLogin(res);
                    Toast.fire({
                        icon: "success",
                        title: "Token refershed",
                    });
                })
            },
        // getUser(){
        //     axios.get('/api/auth/user',{
        // getUser(){
        //     axios.get('/api/auth/user',{
        //         headers: {
        //           'Authorization': 'Bearer ' + User.getToken()
        //         }
        //     })
        //         .then(response => {
        //             this.user = response.data;
        //         })
        //         .catch(error => {
        //             this.errors = error.response.errors;
        //         });
        //         axios.get('/api/user2',{
        //         headers: {
        //           'Authorization': 'Bearer ' + User.getToken()
        //         }
        //     })
        //         .then(response => {
        //             this.user2 = response.data;
        //         })
        //         .catch(error => {
        //             this.errors = error.response.errors;
        //         });
        // },
        fetchProducts() {
            axios.get('../api/dashboard/product')
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    this.errors = error.response.errors;
                })
        },
        editExpense(product) {
            this.editForm.id = product.id;
            this.editForm.details = product.details;
            this.editForm.amount = product.amount;
            this.editForm.product_date = product.product_date;
            this.errors = "";
        },
        fetchcategories()
        {
            axios.get('../api/dashboard/category')
               .then(response => {
                    this.categories = response.data;
               })
               .catch(error =>{
                Notification.error();
               })
        },
        getProductsByCategory(id)
        {
            axios.get('/api/dashboard/category/'+id+'/products')
               .then(response => {
                    this.products = response.data;
               })
               .catch(()=>{
                console.log(this.errors);
               })
        },
        fetchCustomers()
        {
            axios.get('/api/dashboard/customer')
               .then(response => {
                    this.customers = response.data;
               })
        },
        addToShoppingcard(id){
            axios.post('/api/dashboard/shoppingcart/'+id)
            .then(response => {
                Notification.successWithMessage('Product Added to ShoppingCart');
                this.fetchShoppingCarts();
            })
            .catch(error => {
                Notification.error;
            })
        },
        fetchShoppingCarts()
        {
            axios.get('/api/dashboard/shoppingcart')
            .then(response=> {
                this.carts = response.data;
            })
            .catch(error => {
                this.errors = error.response.data.errros;
            })
        },
        removeItemFromCart(id){
            axios.delete('/api/dashboard/shoppingcart/'+id)
            .then(response =>{
                Notification.successWithMessage('Product removed !');
                this.fetchShoppingCarts();
            })
            .catch(()=>{
                Notification.error();
            })
        },

    },
    computed: {
        filterSearch() {
            return this.products.filter(product => {
                return product.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
    },
}
</script>
<style type="text/css">
.tab-content .align-items-center .noMargin{
    margin-right: 0;
    margin-left: 0;

}
</style>
