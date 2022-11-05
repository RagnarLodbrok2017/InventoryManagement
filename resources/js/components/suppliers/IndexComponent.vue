<template>
    <div id="index-suppliers">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Suppliers :</h5>
                        <router-link to="/dashboard/create-supplier" class="btn btn-primary">
                            Add Supplier
                        </router-link>
                        <router-link to="/dashboard/create-supplier" class="btn btn-danger">
                            Delete all Suppliers
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Suppliers Table</h6>
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
                                            <th>Photo</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Shop Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="supplier in filtersearch" :key="supplier.id">
                                            <td>{{ supplier.name }}</td>
                                            <td><img :src="'/' + supplier.photo" id="em_photo"></td>
                                            <td>{{ supplier.phone }}</td>
                                            <td>{{ supplier.email }}</td>
                                            <td>{{ supplier.shopname }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target=".editSupplier-lg" @click="editSupplier(supplier)">Edit</button>

                                                <button @click="deleteSupplier(supplier.id)" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Edit Supplier Form -->
                                    <div v-if="editForm" class="modal fade editSupplier-lg" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Edit Supplier</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form @submit.prevent="updateSupplier">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="name">Name:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Supplier Name"
                                                                            v-model="editForm.name" />
                                                                        <small v-if="editFormErrors.name" class="text-danger">
                                                                            {{ editFormErrors.name[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="email">Email Address:</label>
                                                                        <input type="email" class="form-control" placeholder="Enter Supplier Email Address"
                                                                            v-model="editForm.email" />
                                                                        <small v-if="editFormErrors.email" class="text-danger">
                                                                            {{ editFormErrors.email[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-3">
                                                                        <label for="address">Shop Name:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Supplier Shop Name:"
                                                                            v-model="editForm.shopname" />
                                                                        <small v-if="editFormErrors.shopname" class="text-danger">
                                                                            {{ editFormErrors.shopname[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-3">
                                                                        <label for="salary">Phone:</label>
                                                                        <input type="number" class="form-control" placeholder="Enter Supplier Phone Number:"
                                                                            v-model="editForm.phone" />
                                                                        <small v-if="editFormErrors.phone" class="text-danger">
                                                                            {{ editFormErrors.phone[0] }}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="text">Address:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Your Address"
                                                                            v-model="editForm.Address" />
                                                                        <small v-if="editFormErrors.Address" class="text-danger">
                                                                            {{ editFormErrors.Address[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="Photo">Upload Photo:</label>
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
                                                                        <small v-if="editFormErrors.photo" class="text-danger">
                                                                            {{ editFormErrors.photo[0] }}
                                                                        </small>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" data-dismiss="modal" @click="updateSupplier(editForm)">Save Changes</button>
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
    created() {
        if (!User.loggedIn()) {
            this.$router.push("/login");
        }
        this.fetchSuppliers();
    },
    data() {
        return {
            suppliers: [],
            errors: {},
            searchTerm:"",
            editFormErrors:{},
            editForm:{
                name: null,
                email: null,
                address: null,
                shopname: null,
                phone: null,
                photo:null,
            },

        }
    },
    methods: {
        fetchSuppliers() {
            axios.get('../api/dashboard/supplier/')
                .then(response => {
                    this.suppliers = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data;
                })
        },
        editSupplier(supplier) {
            this.editFormErrors = {};
            this.editForm.id = supplier.id;
            this.editForm.name = supplier.name;
            this.editForm.email = supplier.email;
            this.editForm.address = supplier.address;
            this.editForm.phone = supplier.phone;
            this.editForm.shopname = supplier.shopname;
            this.editForm.photo = supplier.photo;
        },
        updateSupplier(supplier) {
            axios.put('../api/dashboard/supplier/'+supplier.id, supplier)
                .then(response => {
                    Notification.success();
                    this.fetchSuppliers();
                })
                .catch(error => {
                    this.editFormErrors = error.response.data;
                })
        },
        deleteSupplier(id)
        {
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
                    axios.delete('../api/dashboard/supplier/' + id)
                        .then(() => {
                            this.suppliers = this.suppliers.filter(supplier => {
                                return supplier.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push('/dashboard/index-supplier');
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
            if(file.size > 200473)
            {
                Notification.Image_validation();
            }
            else{
                // console.log(event.target.files[0].size);
                let render = new FileReader();
                render.onload = event => {
                    this.editForm.photo = event.target.result;
                };
                render.readAsDataURL(file);
            }
        },
    },
    computed: {
        filtersearch() {
            return this.suppliers.filter(supplier => {
                return supplier.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            })
        }
    }
}
</script>
<style type="text/css">
.table-responsive ,
.table-responsive button {
    font-size: 14px;
}

</style>
