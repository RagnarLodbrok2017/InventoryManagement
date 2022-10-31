<template>
    <div id="create-employee">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">Add Employee Menu :</h5>
                        <router-link to="/dashboard/index-employee" class="btn btn-primary">
                            All Employees
                        </router-link>
                        <router-link to="/dashboard/create-employee" class="btn btn-danger">
                            Delete all Employees
                        </router-link>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createEmployee">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-6">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter Employee Name"
                                            v-model="form.name" />
                                        <small v-if="errors.name" class="text-danger">
                                            {{ errors.name[0] }}
                                        </small>
                                    </div>

                                    <div class="col-6">
                                        <label for="email">Email Address:</label>
                                        <input type="email" class="form-control"
                                            placeholder="Enter Employee Email Address" v-model="form.email" />
                                        <small v-if="errors.email" class="text-danger">
                                            {{ errors.email[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-6">
                                        <label for="address">Address:</label>
                                        <input type="text" class="form-control" placeholder="Enter Employee Address"
                                            v-model="form.address" />
                                        <small v-if="errors.address" class="text-danger">
                                            {{ errors.address[0] }}
                                        </small>
                                    </div>

                                    <div class="col-6">
                                        <label for="salary">Salary:</label>
                                        <input type="number" class="form-control" placeholder="Enter Employee Salary"
                                            v-model="form.salary" />
                                        <small v-if="errors.salary" class="text-danger">
                                            {{ errors.salary[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-4">
                                        <label for="Joining Date">Joining Date:</label>
                                        <input type="date" class="form-control" placeholder="Enter Joining Date: "
                                            v-model="form.joining_date" />
                                        <small v-if="errors.joining_date" class="text-danger">
                                            {{ errors.joining_dates[0] }}
                                        </small>
                                    </div>

                                    <div class="col-4">
                                        <label for="text">Nid:</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Nid"
                                            v-model="form.nid" />
                                        <small v-if="errors.nid" class="text-danger">
                                            {{ errors.nid[0] }}
                                        </small>
                                    </div>
                                    <div class="col-4">
                                        <label for="Phone">Phone:</label>
                                        <input type="text" class="form-control" placeholder="Enter Phone Number: "
                                            v-model="form.phone" />
                                        <small v-if="errors.phone" class="text-danger">
                                            {{ errors.phone[0] }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
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
                                        <img :src="form.photo" style="height: 100px; width: 120px" />
                                    </div>
                                    <div class="col-3">
                                        <small v-if="errors.photo" class="text-danger">
                                            {{ errors.photo[0] }}
                                        </small>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing" />
                                    <label class="custom-control-label" for="customControlAutosizing">Remember
                                        me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                address: null,
                salary: null,
                joining_date: null,
                nid: null,
                phone: null,
                photo:null,
            },
            errors:{},
        };
    },
    methods:{
        createEmployee($request)
        {
            axios
                .post("/employee/store-employee", this.form)
                .then((res) => {
                    console.log(res.data);
                    Toast.fire({
                        icon: "success",
                        title: "Employee Created Successfully",
                    });
                })
                .catch();
        },
        onFileSelected(event)
        {
            let file = event.target.files[0];
            if(file.size > 200473)
            {
                Notification.Image_validation();
            }
            else{
                console.log(event.target.files[0].size);
                let render = new FileReader();
                render.onload = event => {
                    this.form.photo = event.target.result;
                };
                render.readAsDataURL(file);
            }
        }
    },
};
</script>

<style type="text/css">

</style>
