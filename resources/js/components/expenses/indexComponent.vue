<template>
    <div id="index-expense">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Expenses :</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target=".addExpense-lg">Add
                            Expense</button>
                        <!-- Add Expense Form Model -->
                        <div id="addExpense" class="modal fade addExpense-lg" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Expense</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <!-- Add Expense Form  -->
                                            <form @submit.prevent="storeExpense">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                  <span class="input-group-text">*Expense Details:</span>
                                                                </div>
                                                                <textarea v-model="addForm.details" required class="form-control" aria-label="With textarea"></textarea>
                                                                <small class="text-danger" v-if="errors.details">
                                                                    {{errors.details[0]}}
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
                                                                <input v-model="addForm.amount" required type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
                                                                <div class="input-group-append">
                                                                  <span class="input-group-text">.00</span>
                                                                </div>
                                                                <small class="text-danger" v-if="errors.amount">
                                                                    {{errors.amount[0]}}
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
                        <router-link to="/dashboard/create-expense" class="btn btn-danger">
                            Delete all Expenses
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Expenses Table</h6>
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
                                            <th>Details</th>
                                            <th>Amount $</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="expense in filterSearch" :key="expense.id">
                                            <td>{{ expense.id }}</td>
                                            <td>{{ expense.details }}</td>
                                            <td>{{ expense.amount }}</td>
                                            <td>{{ expense.expense_date }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".editExpense-lg"
                                                    @click="editExpense(expense)">Edit</button>
                                                <button @click="deleteExpense(expense.id)" class="btn btn-danger">Delete</button>
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
                                                                              <span class="input-group-text">*Expense Details:</span>
                                                                            </div>
                                                                            <textarea v-model="editForm.details" required class="form-control" aria-label="With textarea"></textarea>
                                                                            <small class="text-danger" v-if="errors.details">
                                                                                {{errors.details[0]}}
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
                                                                            <input v-model="editForm.amount" required type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
                                                                            <div class="input-group-append">
                                                                              <span class="input-group-text">.00</span>
                                                                            </div>
                                                                            <small class="text-danger" v-if="errors.amount">
                                                                                {{errors.amount[0]}}
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
                                                                              <span class="input-group-text" id="basic-addon3">{{ editForm.expense_date }}</span>
                                                                            </div>
                                                                            <input v-model="editForm.expense_date" type="date" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                                        </div>
                                                                        <small class="text-danger" v-if="errors.expense_date">
                                                                            {{errors.expense_date[0]}}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" @click="updateExpense(editForm)">Save Changes</button>
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
        this.fetchExpenses();
    },
    data() {
        return {
            expenses:[],
            errors:{},
            searchTerm:"",
            editForm:{
                details:null,
                amount:null,
                expense_date:null,
            },
            addForm:{
                details:null,
                amount:null,
                expense_date:null,
            },

        }
    },
    methods:{
        fetchExpenses()
        {
            axios.get('../api/dashboard/expense')
            .then(response =>{
                this.expenses = response.data;
            })
            .catch(error => {
                this.errors = error.response.errors;
            })
        },
        editExpense(expense){
            this.editForm.id = expense.id;
            this.editForm.details = expense.details;
            this.editForm.amount = expense.amount;
            this.editForm.expense_date = expense.expense_date;
            this.errors = "";
        },
        updateExpense(expense){
            axios.put("../api/dashboard/expense/"+this.editForm.id, expense)
            .then(response=>{
                Notification.success();
                this.fetchExpenses();
                this.errors = "";
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        storeExpense() {
            axios.post("../api/dashboard/expense/",this.addForm)
            .then(response =>{
                Notification.success();
                this.fetchExpenses();
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        deleteExpense(id){
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
                    axios.delete('../api/dashboard/expense/' + id)
                        .then(() => {
                            this.expenses = this.expenses.filter(expense => {
                                return expense.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push('/dashboard/index-expense');
                        })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }

    },
    computed:{
        filterSearch()
        {
            return this.expenses.filter(expense=>{
                return expense.details.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
    }
}
</script>
<style type="text/css"></style>
