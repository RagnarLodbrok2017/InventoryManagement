<template>
    <div id="index-salary">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Categories :</h5>
                        <router-link to="/dashboard/index-employee" class="btn btn-primary">Add Salary</router-link>
                        <router-link to="/dashboard/create-salary" class="btn btn-danger">
                            Delete all Categories
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Categories Table</h6>
                                <div class="col-4">
                                    <input type="text" class="form-control" v-model="searchTerm"
                                        placeholder="Search Here" />
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Month Name</th>
                                            <th>Total Salary</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="salary in filterSearch" :key="salary.id">
                                            <td>{{ salary.month }}</td>
                                            <td> {{ salary.total_salary}}</td>
                                            <router-link :to="{ name:'view-salary',
                                             params:{
                                                month:salary.month
                                            }}" class="btn btn-primary">View Salary</router-link>
                                        </tr>
                                    </tbody>
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
        this.fetchSalaries();
    },
    data() {
        return {
            salaries:[],
            errors:{},
            searchTerm:"",
            editForm:{
                name:'',
                description:'',
            },
            addFrom:{
                name:'',
                description:'',
            },

        }
    },
    methods:{
        fetchSalaries()
        {
            axios.get('../api/dashboard/salary')
            .then(response =>{
                this.salaries = response.data;
                console.log(this.salaries);
            })
            .catch(error => {
                this.errors = error.response.errors;
            })
        },
        editSalary(salary){
            this.editForm.id = salary.id;
            this.editForm.month = salary.month;
            this.editForm.amount = salary.amount;
            this.errors = "";
        },
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
