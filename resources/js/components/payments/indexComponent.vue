<template>
    <div id="index-payment">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Payments :</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target=".addPayment-lg">Add
                            Payment</button>
                        <!-- Add Payment Form Model -->
                        <div id="addPayment" class="modal fade addPayment-lg" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Payment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <!-- Add Payment Form  -->
                                            <form @submit.prevent="storePayment">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                  <span class="input-group-text">Pay</span>
                                                                </div>
                                                                <input v-model="addForm.type" type="text" class="form-control">
                                                                <div class="input-group-append">
                                                                  <span class="input-group-text">Type</span>
                                                                </div>
                                                                <small class="text-danger" v-if="errors.type">
                                                                    {{errors.type[0]}}
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
                                                                  <span class="input-group-text">Card Details:</span>
                                                                </div>
                                                                <textarea v-model="addForm.cardDetails" required class="form-control" aria-label="With textarea"></textarea>
                                                                <small class="text-danger" v-if="errors.cardDetails">
                                                                    {{errors.cardDetails[0]}}
                                                                </small>
                                                            </div>
                                                        </div>
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
                        <router-link to="/dashboard/create-payment" class="btn btn-danger">
                            Delete all Payments
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Payments Table</h6>
                                <div class="col-4">
                                    <input type="text" class="form-control" v-model="searchTerm"
                                        placeholder="Search Here" />
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Card details $</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="payment in filterSearch" :key="payment.id">
                                            <td>{{ payment.id }}</td>
                                            <td>{{ payment.type }}</td>
                                            <td>{{ payment.cardDetails }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".editPayment-lg"
                                                    @click="editPayment(payment)">Edit</button>
                                                <button @click="deletePayment(payment.id)" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Edit Payment Form -->
                                    <div class="modal fade editPayment-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Payment</h5>
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
                                                                              <span class="input-group-text">Pay</span>
                                                                            </div>
                                                                            <input  @change="checkPayment()" v-model="editForm.type" required type="text" class="form-control">
                                                                            <div class="input-group-append">
                                                                              <span class="input-group-text">Type</span>
                                                                            </div>
                                                                            <small class="text-danger" v-if="errors.type">
                                                                                {{errors.type[0]}}
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
                                                                              <span class="input-group-text">Card:</span>
                                                                            </div>
                                                                            <textarea v-model="editForm.cardDetails" class="form-control" aria-label="With textarea"></textarea>
                                                                            <small class="text-danger" v-if="errors.cardDetails">
                                                                                {{errors.cardDetails[0]}}
                                                                            </small>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" @click="updatePayment(editForm)">Save Changes</button>
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
    created(){
        if (!User.loggedIn()) {
            this.$router.push("/login");
        }
        this.fetchPayments();
    },
    data() {
        return {
            payments:[],
            errors:{},
            payment:{
                details:null,
            },
            searchTerm:"",
            editForm:{
                cardDetails:null,
                type:null,
            },
            addForm:{
                cardDetails:null,
                type:null,
            },

        }
    },
    methods:{
        fetchPayments()
        {
            axios.get('/api/dashboard/payment')
            .then(response =>{
                this.payments = response.data;
            })
            .catch(error => {
                this.errors = error.response.errors;
            })
        },
        editPayment(payment){
            this.editForm.id = payment.id;
            this.editForm.cardDetails = payment.cardDetails;
            this.editForm.type = payment.type;
            this.errors = "";
        },
        updatePayment(payment){
            this.checkPayment(this.editForm.details);
            axios.put("../api/dashboard/payment/"+this.editForm.id, payment)
            .then(response=>{
                Notification.success();
                this.fetchPayments();
                this.errors = "";
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        storePayment() {
            axios.post("../api/dashboard/payment/",this.addForm)
            .then(response =>{
                Notification.success();
                this.fetchPayments();
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        deletePayment(id){
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
                    axios.delete('../api/dashboard/payment/' + id)
                        .then(() => {
                            this.payments = this.payments.filter(payment => {
                                return payment.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push('/dashboard/index-payment');
                        })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        },
        checkPayment()
        {
             let check = this.payments.find((payment) => {
                return payment.type.toLowerCase().includes(this.editForm.type.toLowerCase());
            });
            if (check)
            {
                console.log(check);
                Notification.exist();
            }
        },
    },
    computed:{
        filterSearch()
        {
            return this.payments.filter(payment=>{
                return payment.type.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
    },
}
</script>
<style type="text/css"></style>
