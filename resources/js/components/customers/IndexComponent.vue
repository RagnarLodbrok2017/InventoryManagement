<template>
    <div id="index-customers">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Customers :</h5>
                        <router-link to="/dashboard/create-customer" class="btn btn-primary">
                            Add Customer
                        </router-link>
                        <router-link to="/dashboard/create-customer" class="btn btn-danger">
                            Delete all Customers
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Customers Table</h6>
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
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="customer in filtersearch" :key="customer.id">
                                            <td>{{ customer.name }}</td>
                                            <td><img :src="'/' + customer.photo" id="em_photo"></td>
                                            <td>{{ customer.email }}</td>
                                            <td>{{ customer.phone }}</td>
                                            <td>{{ customer.balance }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".editCustomer-lg"
                                                    @click="editCustomer(customer)">Edit</button>
                                                <button @click="deleteCustomer(customer.id)" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Edit Customer Form -->
                                    <div class="modal fade editCustomer-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Edit Customer</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form @submit.prevent="updateCustomer">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="name">Name:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Customer Name"
                                                                            v-model="editForm.name" />
                                                                        <small v-if="editFormErrors.name" class="text-danger">
                                                                            {{ editFormErrors.name[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="email">Email:</label>
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Enter Customer Email Address" v-model="editForm.email" />
                                                                        <small v-if="editFormErrors.email" class="text-danger">
                                                                            {{ editFormErrors.email[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="address">Address:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Customer Address"
                                                                            v-model="editForm.address" />
                                                                        <small v-if="editFormErrors.address" class="text-danger">
                                                                            {{ editFormErrors.address[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="Phone">Phone:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Phone Number: "
                                                                            v-model="editForm.phone" />
                                                                        <small v-if="editFormErrors.phone" class="text-danger">
                                                                            {{ editFormErrors.phone[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="Photo">Upload Photo
                                                                            :</label>
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
                                                    <button type="submit" class="btn btn-primary" @click="updateCustomer(editForm)">Save
                                                        Changes</button>
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
        this.allCustomers();
    },
    data() {
        return {
            customers: [],
            salaries:null,
            errors: {},
            searchTerm: '',
            editForm: {
                name: null,
                email: null,
                address: null,
                phone: null,
                photo:null,
            },
            editFormErrors:{}
        };
    },
    methods: {
        allCustomers() {
            axios.get("../api/dashboard/customer/")
                .then((response) => {
                    this.customers = response.data;
                })
                .catch(eroor => {
                    Notification.error();
                })
        },
        deleteCustomer(id) {
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
                    axios.delete('../api/dashboard/customer/' + id)
                        .then(() => {
                            this.customers = this.customers.filter(customer => {
                                return customer.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push('/dashboard/index-customer');
                        })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        },
        editCustomer(customer) {
            this.editFormErrors = {};
            this.editForm.id = customer.id;
            this.editForm.name = customer.name;
            this.editForm.email = customer.email;
            this.editForm.address = customer.address;
            this.editForm.phone = customer.phone;
            this.editForm.photo = customer.photo;
        },
        updateCustomer(customer) {
            axios.put('../api/dashboard/customer/'+this.editForm.id, customer)
            .then((response) => {
                Notification.success();
                this.allCustomers();
                    console.log(response.data)
            })
            .catch((error) => {
                this.editFormErrors = error.response.data.errors;
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
            return this.customers.filter(customer => {
                return customer.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            })
        }
    }
};
</script>

<style type="text/css">
#em_photo {
    width: 40px;
    height: 40px;
}
</style>
