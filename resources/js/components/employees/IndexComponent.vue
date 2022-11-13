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
                                            <td><img :src="'/' + employee.photo" id="em_photo"></td>
                                            <td>{{ employee.phone }}</td>
                                            <td>{{ employee.salary }}</td>
                                            <td>{{ employee.joining_date }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".editEmployee-lg"
                                                    @click="editEmployee(employee)">Edit</button>
                                                <button class="btn btn-warning" data-toggle="modal" data-target=".paySalary-lg"
                                                    @click="paySalaryButton(employee)">Pay Salary</button>

                                                <button @click="deleteEmployee(employee.id)" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Edit Employee Form -->
                                    <div class="modal fade editEmployee-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Edit Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form @submit.prevent="updateEmployee">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="name">Name:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Employee Name"
                                                                            v-model="editForm.name" />
                                                                        <small v-if="editFormErrors.name" class="text-danger">
                                                                            {{ editFormErrors.name[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="email">Address:</label>
                                                                        <input type="email" class="form-control"
                                                                            placeholder="Enter Employee Email Address" v-model="editForm.email" />
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
                                                                        <input type="text" class="form-control" placeholder="Enter Employee Address"
                                                                            v-model="editForm.address" />
                                                                        <small v-if="editFormErrors.address" class="text-danger">
                                                                            {{ editFormErrors.address[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="salary">Salary:</label>
                                                                        <input type="number" class="form-control" placeholder="Enter Employee Salary"
                                                                            v-model="editForm.salary" />
                                                                        <small v-if="editFormErrors.salary" class="text-danger">
                                                                            {{ editFormErrors.salary[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-4">
                                                                        <label for="Joining Date">Joining
                                                                            Date:</label>
                                                                        <input type="date" class="form-control" placeholder="Enter Joining Date: "
                                                                            v-model="editForm.joining_date" />
                                                                        <small v-if="editFormErrors.joining_date" class="text-danger">
                                                                            {{ editFormErrors.joining_date[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <label for="text">Nid:</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Your Nid"
                                                                            v-model="editForm.nid" />
                                                                        <small v-if="editFormErrors.nid" class="text-danger">
                                                                            {{ editFormErrors.nid[0] }}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-4">
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
                                                    <button type="submit" class="btn btn-primary" @click="updateEmployee(editForm)">Save
                                                        Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                     <!-- Pay Salary Form -->
                                    <div class="modal fade paySalary-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Edit Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form @submit.prevent="paySalaryMethod">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-6">
                                                                        <label for="name">Employee Name:</label>
                                                                            <input class="form-control" type="text" v-model="payForm.name" readonly=""/>
                                                                        <small v-if="payFormErrors.name" class="text-danger">
                                                                            {{ payFormErrors.name[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <label for="email">Address:</label>
                                                                        <input type="email" class="form-control" v-model="payForm.email" readonly="" />
                                                                        <small v-if="payFormErrors.email" class="text-danger">
                                                                            {{ payFormErrors.email[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-4">
                                                                        <label for="months">Select Month:</label>
                                                                        <select v-model="payForm.month" class="form-control" required>
                                                                            <option v-for="month in months" :value="month">{{ month }}</option>
                                                                            <!-- <option value="January">January</option>
                                                                            <option value="February">February</option>
                                                                            <option value="March">March</option>
                                                                            <option value="April">April</option>
                                                                            <option value="May">May</option>
                                                                            <option value="June">June</option>
                                                                            <option value="July">July</option>
                                                                            <option value="August">August</option>
                                                                            <option value="September">September</option>
                                                                            <option value="October">October</option>
                                                                            <option value="November">November</option>
                                                                            <option value="December">December</option> -->
                                                                        </select>
                                                                        <small v-if="payFormErrors.month" class="text-danger">
                                                                            {{ payFormErrors.month[0] }}
                                                                        </small>
                                                                    </div>

                                                                    <div class="col-4">
                                                                        <label for="salary">Salary:</label>
                                                                        <input type="number" class="form-control" v-model="payForm.amount" required/>
                                                                        <small v-if="payFormErrors.amount" class="text-danger">
                                                                            {{ payFormErrors.amount[0] }}
                                                                        </small>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <label for="months">Select Type:</label>
                                                                        <select v-model="payForm.type" class="form-control">
                                                                            <option value="Base pay" selected>Base pay</option>
                                                                            <option value="Commission">Commission</option>
                                                                            <option value="Equity">Equity</option>
                                                                            <option value="Benefits">Benefits</option>
                                                                            <option value="Bonuses">Bonuses</option>
                                                                        </select>
                                                                        <small v-if="payFormErrors.type" class="text-danger">
                                                                            {{ payFormErrors.type[0] }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div class="form-row">
                                                                    <div class="col-12">
                                                                        <h5 class="text-center">Salaries Paid</h5>
                                                                        <ul class="list-inline">
                                                                            <li class="text-center list-inline-item" v-for="salary in payForm.salaries">
                                                                                <button class="btn btn-info">{{ salary.month }} : {{ salary.amount }} $</button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary" @click="paySalaryMethod(payForm)">Pay</button>
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
        this.allEmployees();
    },
    data() {
        return {
            employees: [],
            salaries:null,
            errors: {},
            searchTerm: '',
            editForm: {
                name: null,
                email: null,
                address: null,
                salary: null,
                joining_date: null,
                nid: null,
                phone: null,
                photo:null,
            },
            payForm:{
                id:null,
                name: null,
                email:null,
                amount: null,
                month:null,
                type:null,
                salaries:null,
            },
            payFormErrors:{},
            editFormErrors:{},
            months:[]
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
                    axios.delete('../api/dashboard/employee/' + id)
                        .then(() => {
                            this.employees = this.employees.filter(employee => {
                                return employee.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push('/dashboard/index-employee');
                        })
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        },
        editEmployee(employee) {
            this.editFormErrors = {};
            this.editForm.id = employee.id;
            this.editForm.name = employee.name;
            this.editForm.email = employee.email;
            this.editForm.address = employee.address;
            this.editForm.salary = employee.salary;
            this.editForm.joining_date = employee.joining_date;
            this.editForm.nid = employee.nid;
            this.editForm.phone = employee.phone;
            this.editForm.photo = employee.photo;
        },
        updateEmployee(employee) {
            axios.put('../api/dashboard/employee/'+this.editForm.id, employee)
            .then((response) => {
                Notification.success();
                this.allEmployees();
                    console.log(response.data)
            })
            .catch((error) => {
                this.editFormErrors = error.response.data.errors;
            })
        },
        paySalaryButton(employee){
            this.salaries = employee.salaries;
            this.payForm.id = employee.id;
            this.payForm.name = employee.name;
            this.payForm.email = employee.email;
            this.payForm.amount = employee.salary;
            this.payForm.salaries = employee.salaries;
            this.filterMonths();
        },
        paySalaryMethod(salary){
            axios.post('../api/dashboard/salary/paid/'+this.payForm.id, salary)
            .then(response=>{
                Notification.success();
                this.allEmployees();
            })
            .catch(error => {
            this.payFormErrors = error.response.data.errors;
            Notification.error();
        })
        },
        filterMonths()
        {
            let months = ['January','February','March','April','May','June',
            'July','August','September','October','November','December',
        ];
        this.months = months;
            this.payForm.salaries.filter(salary => {
                 this.months.filter(month => {
                    if(month.toLowerCase().includes(salary.month.toLowerCase()) )
                    {
                        this.months.splice(this.months.indexOf(month), 1);
                    }
                });
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
