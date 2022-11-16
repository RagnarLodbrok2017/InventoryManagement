<template>
    <div id="index-salary">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">Salaries of {{month}}:</h5>
                      <router-link to="/dashboard/index-employee" class="btn btn-primary">Add Salary</router-link>
                        <router-link to="/dashboard/index-salary" class="btn btn-info">
                            All Salaries
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Salaries Table</h6>
                                <div class="col-4">
                                    <input type="text" class="form-control" v-model="searchTerm"
                                        placeholder="Search Here" />
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Month</th>
                                            <th>Salary</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="salary in filterSearch" :key="salary.id">
                                            <td>{{ salary.name }}</td>
                                            <td>{{ salary.month }}</td>
                                            <td>{{ salary.amount }}</td>
                                            <td>{{ salary.date }}</td>
                                            <td>
                                                <button class="btn btn-primary" @click="editSalary(salary)" data-toggle="modal"
                                                data-target=".editSalary-lg">Edit Salary</button>
                                                <button class="btn btn-danger" @click="deleteSalary(salary.id)">Delete Salary</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Edit Salary Form -->
                                    <div class="modal fade editSalary-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Salary</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form @submit.prevent="">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="name">Employee Name:</label>
                                                                            <input class="form-control" type="text" v-model="editForm.employee_name" readonly=""/>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="months">Select Month:</label>
                                                                        <input type="text" v-model="editForm.month" class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="salary">Salary:</label>
                                                                        <input type="number" class="form-control" v-model="editForm.amount" required/>
                                                                        <small v-if="errors.amount" class="text-danger">
                                                                            {{ errors.amount[0] }}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <label for="months">Select Type:</label>
                                                                        <select v-model="editForm.type" class="form-control">
                                                                            <option value="Base pay" selected>Base pay</option>
                                                                            <option value="Commission">Commission</option>
                                                                            <option value="Equity">Equity</option>
                                                                            <option value="Benefits">Benefits</option>
                                                                            <option value="Bonuses">Bonuses</option>
                                                                        </select>
                                                                        <small v-if="errors.type" class="text-danger">
                                                                            {{ errors.type[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" @click="updateSalary(editForm)">Save Changes</button>
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
        this.viewSalaries();
    },
    data() {
        return {
            month:null,
            salaries:[],
            errors:{},
            searchTerm:"",
            editForm:{},
            addFrom:{},

        }
    },
    methods:{
        viewSalaries()
        {
            this.month = this.$route.params.month;
            axios.get("/api/dashboard/salary/view/"+ this.month)
            .then(response =>{
                this.salaries = response.data;
            })
            .catch(error => {
                this.errors = error.response.errors;
            })
        },
        editSalary(salary){
            this.editForm.id = salary.id;
            this.editForm.month = salary.month;
            this.editForm.amount = salary.amount;
            this.editForm.type = salary.type;
            this.editForm.employee_name = salary.name;
            this.errors = "";
        },
        updateSalary(salary){
            axios.put("/api/dashboard/salary/view/"+this.editForm.id, salary)
            .then(response=>{
                Notification.success();
                this.viewSalaries();
                this.errors = "";
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        deleteSalary(id){
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
                    axios.delete('/api/dashboard/salary/view/' + id)
                        .then(() => {
                            this.salaries = this.salaries.filter(salary => {
                                return salary.id != id;
                                Notification.success();
                            })
                        })
                        .catch((error) => {
                            if (error.response.data.errors) {
                                this.errors = error.response.data.errors;
                                Notifications.error();
                            }
                            this.$router.push('/dashboard/index-salary');
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
            return this.salaries.filter(salary => {
                return salary.month.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
    }
}
</script>
<style type="text/css"></style>
