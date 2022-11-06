<template>
    <div id="index-category">
        <div class="row">
            <div class="col-lg-12">
                <!-- Form Basic -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h5 class="m-0 font-weight-bold text-primary">All Categories :</h5>
                        <button class="btn btn-primary" data-toggle="modal" data-target=".addCategory-lg">Add
                            Category</button>
                        <!-- Add Category Form Model -->
                        <div id="addCategory" class="modal fade addCategory-lg" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <form @submit.prevent="storeCategory">
                                                <div class="form-group">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <label for="name">*Enter the name of category:</label>
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
                                                            <label for="description">Enter the description of category:</label>
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
                        <router-link to="/dashboard/create-category" class="btn btn-danger">
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
                                        <tr v-for="category in filterSearch" :key="category.id">
                                            <td>{{ category.id }}</td>
                                            <td>{{ category.name }}</td>
                                            <td>{{ category.description }}</td>
                                            <td>
                                                <button class="btn btn-success">Profile</button>
                                                <button class="btn btn-primary" data-toggle="modal" data-target=".editCategory-lg"
                                                    @click="editCategory(category)">Edit</button>
                                                <button @click="deleteCategory(category.id)" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- Edit Category Form -->
                                    <div class="modal fade editCategory-lg" tabindex="-1" role="dialog"
                                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form @submit.pervent="">
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-12">
                                                                        <label for="name">*Enter the name of category:</label>
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
                                                                            <label for="description">*Enter the description of category:</label>
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
                                                    <button type="submit" class="btn btn-primary" @click="updateCategory(editForm)">Save Changes</button>
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
            categories:[],
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
            axios.get('../api/dashboard/category')
            .then(response =>{
                this.categories = response.data;
            })
            .catch(error => {
                this.errors = error.response.errors;
            })
        },
        editCategory(category){
            this.editForm.id = category.id;
            this.editForm.name = category.name;
            this.editForm.description = category.description;
            this.errors = "";
        },
        updateCategory(category){
            axios.put("../api/dashboard/category/"+this.editForm.id, category)
            .then(response=>{
                Notification.success();
                this.fetchCategories();
                this.errors = "";
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        storeCategory() {
            axios.post("../api/dashboard/category/",this.addFrom)
            .then(response =>{
                Notification.success();
                this.fetchCategories();
            })
            .catch(error =>{
                this.errors = error.response.data.errors;
            })
        },
        deleteCategory(id){
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
                    axios.delete('../api/dashboard/category/' + id)
                        .then(() => {
                            this.categories = this.categories.filter(category => {
                                return category.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push('/dashboard/index-category');
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
            return this.categories.filter(category=>{
                return category.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            });
        },
    }
}
</script>
<style type="text/css"></style>
