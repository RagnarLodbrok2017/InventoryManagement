<template>
    <div id="index-product">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Products :</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target=".addProduct-lg">Add
                            Product</button>
                        <!-- Add Product Form Model -->
                        <div id="addProduct" class="modal fade addProduct-lg" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form @submit.prevent="storeProduct">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-6">
                                                            <label for="name">Product Name:</label>
                                                            <input class="form-control" type="text" v-model="addForm.name" required placeholder="Name:" />
                                                            <small class="text-danger" v-if="errors.name">
                                                                {{errors.name[0]}}
                                                            </small>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="code">Product Code:</label>
                                                            <input class="form-control" type="text" v-model="addForm.code" required placeholder="Code:" />
                                                            <small class="text-danger" v-if="errors.code">
                                                                {{errors.code[0]}}
                                                            </small>
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="root">Product Root:</label>
                                                            <input class="form-control" type="text" v-model="addForm.root" required placeholder="Root:" />
                                                            <small class="text-danger" v-if="errors.root">
                                                                {{errors.root[0]}}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-4">
                                                            <label for="buying_price">Product Buying Price:</label>
                                                            <input class="form-control" type="number" v-model="addForm.buying_price" placeholder="000" />
                                                            <small class="text-danger" v-if="errors.buying_price">
                                                                {{errors.buying_price[0]}}
                                                            </small>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="selling_price">Product Selling Price:</label>
                                                            <input class="form-control" type="number" v-model="addForm.selling_price" required placeholder="000" />
                                                            <small class="text-danger" v-if="errors.selling_price">
                                                                {{errors.selling_price[0]}}
                                                            </small>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="buying_date">Product Buying Date:</label>
                                                            <input class="form-control" type="date" v-model="addForm.buying_date" placeholder="Date:" />
                                                            <small class="text-danger" v-if="errors.buying_date">
                                                                {{errors.buying_date[0]}}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-4">
                                                            <label for="select_supplier">Select Category:</label>
                                                            <select class="form-control" v-model="addForm.category_id" required>
                                                                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="select_supplier">Select Supplier:</label>
                                                            <select class="form-control" v-model="addForm.supplier_id" required>
                                                                <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="name">Product Quantity:</label>
                                                            <input class="form-control" type="number" v-model="addForm.quantity" required placeholder="000" />
                                                            <small class="text-danger" v-if="errors.quantity">
                                                                {{errors.quantity[0]}}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-6">
                                                        <label for="Photo">Upload Photo :</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile"
                                                             @change="onFileSelected" />
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <img :src="addForm.photo" style="height: 100px; width: 120px" />
                                                    </div>
                                                    <div class="col-3">
                                                        <small v-if="errors.photo" class="text-danger">
                                                            {{ errors.photo[0] }}
                                                        </small>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <router-link to="/dashboard/create-product" class="btn btn-danger">
                            Delete all Products
                        </router-link>
                    </div>

                    <!-- Show all Products -->
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Products Table</h6>
                                <div class="col-4">
                                    <input type="text" class="form-control" v-model="searchTerm"
                                        placeholder="Search Here" />
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Code</th>
                                            <th>Sell Price</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>Status</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="product in filterSearchProducts" :key="product.id">
                                            <td class="font-weight-bold">{{ product.name }}</td>
                                            <td> <img :src="'/'+product.photo" style="width:40px;height:40px"/></td>
                                            <td>{{ product.code }}</td>
                                            <td>{{ product.selling_price }}</td>
                                            <td>{{ product.category.name }}</td>
                                            <td>{{ product.supplier.name }}</td>
                                            <td v-if="product.quantity >= 1 ">
                                                <button class="btn btn-outline-success">
                                                    <span class="badge badge-success">Available</span>
                                                </button>
                                            </td>
                                            <td v-else>
                                                <button class="btn btn-outline-danger">
                                                    <span class="badge badge-danger">Stock-Out</span>
                                                </button>
                                             </td>
                                            <td>{{ product.quantity }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".editProduct-lg"
                                                    @click="editProduct(product)">Edit</button>
                                                <button @click="deleteProduct(product.id)" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Edit Product Form -->
                                    <div class="modal fade editProduct-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form @submit.prevent="">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="name">Product Name:</label>
                                                                        <input class="form-control" type="text" v-model="editForm.name" placeholder="Name:" />
                                                                        <small class="text-danger" v-if="errors.name">
                                                                            {{errors.name[0]}}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label for="name">Product Code:</label>
                                                                        <input class="form-control" type="text" v-model="editForm.code" placeholder="Code:" />
                                                                        <small class="text-danger" v-if="errors.code">
                                                                            {{errors.code[0]}}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <label for="name">Product Root:</label>
                                                                        <input class="form-control" type="text" v-model="editForm.root" placeholder="Root:" />
                                                                        <small class="text-danger" v-if="errors.name">
                                                                            {{errors.root[0]}}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-4">
                                                                        <label for="name">Product Buying Price:</label>
                                                                        <input class="form-control" type="number" v-model="editForm.buying_price" placeholder="000" />
                                                                        <small class="text-danger" v-if="errors.buying_price">
                                                                            {{errors.buying_price[0]}}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="name">Product Selling Price:</label>
                                                                        <input class="form-control" type="number" v-model="editForm.selling_price" placeholder="000" />
                                                                        <small class="text-danger" v-if="errors.selling_price">
                                                                            {{errors.selling_price[0]}}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="name">Product Buying Date:</label>
                                                                        <input class="form-control" type="date" v-model="editForm.buying_date" placeholder="Date:" />
                                                                        <small class="text-danger" v-if="errors.buying_date">
                                                                            {{errors.buying_date[0]}}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-4">
                                                                        <label for="select_supplier">Select Category:</label>
                                                                        <select class="form-control" v-model="editForm.category_id">
                                                                            <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="select_supplier">Select Supplier:</label>
                                                                        <select class="form-control" v-model="editForm.supplier_id">
                                                                            <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.name }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="name">Product Quantity:</label>
                                                                        <input class="form-control" type="number" v-model="editForm.quantity" placeholder="000" />
                                                                        <small class="text-danger" v-if="errors.quantity">
                                                                            {{errors.quantity[0]}}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="col-6">
                                                                    <label for="Photo">Upload Photo :</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="customFile"
                                                                         @change="onFileSelected" />
                                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3">
                                                                    <img :src="editForm.photo" style="height: 100px; width: 120px" />
                                                                </div>
                                                                <div class="col-3">
                                                                    <small v-if="errors.photo" class="text-danger">
                                                                        {{ errors.photo[0] }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" @click="updateProduct(editForm)">Save Changes</button>
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
        </div>
    </div>
</template>
<script type="text/javascript">
export default {
    created()
    {
        if (!User.loggedIn()) {
            this.$router.push("/login");
        };
        this.fetchProducts();
        this.getCategoryandSupplierData();
    },
    data() {
        return {
            products: [],
            categories:[],
            suppliers:[],
            errors:{
                name:null,
            },
            searchTerm:"",
            product:{},
            addForm:{
                id:null,
                name:null,
                code:null,
                root:null,
                buying_price:null,
                selling_price:null,
                buying_date:null,
                quantity:null,
                photo:null,
                supplier_id:null,
                category_id:null,

            },
            editForm:{
                id:null,
                name:null,
                code:null,
                root:null,
                buying_price:null,
                selling_price:null,
                buying_date:null,
                quantity:null,
                photo:null,
                supplier_id:null,
                category_id:null,
            },
        }
    },
    methods:{
        fetchProducts()
        {
            axios.get('../api/dashboard/product')
            .then(response => {
                this.products = response.data;
                // console.log(response.data);
            })
            .catch(error => {
                this.erorrs = error.response.data.errors;
            })
        },
        getCategoryandSupplierData()
        {
            axios.get("../api/dashboard/category")
            .then(response=>{
                this.categories = response.data;
            });
            axios.get("../api/dashboard/supplier")
            .then(response=>{
                this.suppliers = response.data;
            });
        },
        storeProduct()
        {
            axios.post('../api/dashboard/product/', this.addForm)
            .then(response=>{
                this.fetchProducts();
                Notification.success();
            })
            .catch(error=>{
                this.errors = error.response.data.errors;
                console.log(this.errors.name[0]);
                Notification.error();
            })
        },
        editProduct(product)
        {
            this.editForm.id = product.id;
            this.editForm.name = product.name;
            this.editForm.code = product.code;
            this.editForm.root = product.root;
            this.editForm.buying_price = product.buying_price;
            this.editForm.selling_price = product.selling_price;
            this.editForm.buying_date = product.buying_date;
            this.editForm.quantity = product.quantity;
            this.editForm.supplier_id = product.supplier_id;
            this.editForm.category_id = product.category_id;
            this.editForm.photo = product.photo;
            this.errors = "";

        },
        updateProduct(product)
        {
            axios.put('../api/dashboard/product/'+this.editForm.id, product)
            .then(response=>{
                Notification.success();
                this.fetchProducts();
            })
            .catch(error=>{
                Notification.error();
            })
        },
        deleteProduct(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('../api/dashboard/product/' + id)
                        .then(() => {
                            this.products = this.products.filter(product => {
                                return product.id != id;
                            })
                        })
                        .catch(() => {
                            Notification.error();
                            this.$router.push('/dashboard/index-product');
                        })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        },
        onFileSelected(event)
        {
            let file = event.target.files[0];
            if(file.size > 300473)
            {
                Notification.Image_validation();
            }
            else{
                let render = new FileReader();
                render.onload = event => {
                    this.addForm.photo = event.target.result;
                    this.editForm.photo = event.target.result;
                };
                render.readAsDataURL(file);
            }
        }
    },
        computed:{
        filterSearchProducts()
        {
            return this.products.filter(product=>{
                return product.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
    }
}
</script>
<style type="text/css">
</style>
