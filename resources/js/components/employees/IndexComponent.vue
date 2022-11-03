<template>
    <div id="index-employees">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Employees :</h5>
                        <router-link to="/dashboard/create-employee" class="btn btn-primary">
                            Add Employee
                        </router-link>
                        <router-link to="/dashboard/create-employee" class="btn btn-danger">
                            Delete all Employees
                        </router-link>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Employees Table</h6>
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
                                            <th>Salary</th>
                                            <th>Joining Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="employee in filtersearch" :key="employee.id">
                                            <td>{{ employee.name }}</td>
                                            <td><img :src="'/'+employee.photo" id="em_photo"></td>
                                            <td>{{ employee.phone }}</td>
                                            <td>{{ employee.salary }}</td>
                                            <td>{{ employee.joining_date }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary">Edit</button>
                                                <button @click="deleteEmployee(employee.id)" class="btn btn-danger">Delete</button>
                                            </td>
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
    created() {
        if (!User.loggedIn()) {
            this.$router.push("/login");
        }
        this.allEmployees();
    },
    data() {
        return {
            employees: [],
            errors: {},
            searchTerm: ''
        };
    },
    methods: {
        allEmployees() {
            axios.get("../api/dashboard/employee/")
                .then((response) => {
                    this.employees = response.data;
                })
                .catch(eroor => {
                    Notification.error();
                })
        },
        deleteEmployee(id) {
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
                    axios.delete('../api/dashboard/employee/'+ id)
                    .then( () => {
                        this.employees = this.employees.filter(employee=> {
                            return employee.id != id
                        })
                    })
                    .catch( () => {
                        this.$router.push('/dashboard/index-employee');
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
    computed: {
        filtersearch() {
            return this.employees.filter(employee => {
                return employee.name.toLowerCase().includes(this.searchTerm.toLowerCase());
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
