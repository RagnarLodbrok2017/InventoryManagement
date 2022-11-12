<template>
    <div id="index-salary">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Categories :</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target=".addSalary-lg">Add
                            Salary</button>
                        <!-- Add Salary Form Model -->
                        <div id="addSalary" class="modal fade addSalary-lg" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Salary</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form @submit.prevent="storeSalary">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <label for="name">*Enter the name of salary:</label>
                                                            <input class="form-control" type="text" v-model="addFrom.name" placeholder="Name:" />
                                                            <small class="text-danger" v-if="errors.name">
                                                                {{errors.name[0]}}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <label for="description">Enter the description of salary:</label>
                                                            <input class="form-control" type="text" v-model="addFrom.description"
                                                                placeholder="descriptions:" />
                                                            <small class="text-danger" v-if="errors.description">
                                                                {{errors.description[0]}}
                                                            </small>
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
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="salary in filterSearch" :key="salary.id">
                                            <td>{{ salary.id }}</td>
                                            <td>{{ salary.name }}</td>
                                            <td>{{ salary.description }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".editSalary-lg"
                                                    @click="editSalary(salary)">Edit</button>
                                                <button @click="deleteSalary(salary.id)" class="btn btn-danger">Delete</button>
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
                                                        <form @submit.pervent="">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-12">
                                                                        <label for="name">*Enter the name of salary:</label>
                                                                        <input class="form-control" type="text" v-model="editForm.name" placeholder="Name:" />
                                                                        <small class="text-danger" v-if="errors.name">
                                                                            {{errors.name[0]}}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-12">
                                                                            <label for="description">*Enter the description of salary:</label>
                                                                        <input class="form-control" type="text" v-model="editForm.description" placeholder="descriptions:" />
                                                                        <small class="text-danger" v-if="errors.description">
                                                                            {{errors.description[0]}}
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
        this.fetchCategories();
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
        fetchCategories()
        {
            axios.get('../api/dashboard/salary')
            .then(response =>{
                this.salaries = response.data;
            })
            .catch(error => {
                this.errors = error.response.errors;
            })
        },
        editSalary(salary){
            this.editForm.id = salary.id;
            this.editForm.name = salary.name;
            this.editForm.description = salary.description;
            this.errors = "";
        },
        updateSalary(salary){
            axios.put("../api/dashboard/salary/"+this.editForm.id, salary)
            .then(response=>{
                Notification.success();
                this.fetchCategories();
                this.errors = "";
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        storeSalary() {
            axios.post("../api/dashboard/salary/",this.addFrom)
            .then(response =>{
                Notification.success();
                this.fetchCategories();
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
                    axios.delete('../api/dashboard/salary/' + id)
                        .then(() => {
                            this.salaries = this.salaries.filter(salary => {
                                return salary.id != id
                            })
                        })
                        .catch(() => {
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
            return this.salaries.filter(salary=>{
                return salary.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
    }
}
</script>
<style type="text/css"></style>
