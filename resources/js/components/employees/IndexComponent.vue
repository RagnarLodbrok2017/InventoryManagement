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
    methood() {
        createEmployee($request);
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
        }
    },
};
</script>

<style type="text/css">

</style>
