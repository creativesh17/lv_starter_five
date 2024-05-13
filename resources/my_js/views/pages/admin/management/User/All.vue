<template>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> User Management
        </h4>
        <!-- <div>
            <pre>
                {{ JSON.stringify(query, NULL, 2) }} 
                {{ JSON.stringify(queryField, NULL, 2) }} 
            </pre>
        </div> -->

        <!-- Basic Bootstrap Table -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users</h4>
                        <div class="card-tools" style="position: absolute; right: 1rem; top: .5rem">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#userModalLong"  @click="create()" style="margin-right: 10px;">Add New <i class="fas fa-plus" style="margin-left: 4px;"></i></button>
                            <button type="button" class="btn btn-primary" @click="reload()">Reload <i clas s="fas fa-sync"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <strong>Search By : </strong>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="queryField" class="form-control" id="fields">
                                        <option value="name">Name</option>
                                        <option value="email">Email</option>
                                        <option value="phone">Phone</option>
                                        <option value="address">Address</option>
                                        <option value="total">Total</option>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <input v-model="query" type="text" class="form-control" placeholder="Search">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-show="users.length" v-for="(user, index) in users" :key="user.id">
                                        <th scope="row">{{ index + 1}}</th>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.phone }}</td>
                                        <td>{{ user.total }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm mlr-4">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm mlr-4">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm mlr-4">
                                                <i class="fas fa-trash "></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-show="!users.length">
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-danger" role="alert">
                                                No Data Found
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <Pagination class="mtb-5" v-if="pagination.last_page > 1"
                                            :pagination="pagination"
                                            :offset="5"
                                            @paginate="query ===  '' ? getData() : searchData()">
                            </Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="userModalLong" tabindex="-1" role="dialog" aria-labelledby="userModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="store"> 
                        <div class="modal-body">                
                            
                            <!-- <input v-model="form.name" type="text" name="name" placeholder="Name">
                            <div v-if="form.errors.has('name')" v-html="form.errors.get('name')" /> -->

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input v-model="form.name" type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input v-model="form.email" type="email" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input v-model="form.phone" type="tel" name="phone" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input v-model="form.address" type="text" name="address" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="total">Total</label>
                                <input v-model="form.total" type="text" name="total" class="form-control">
                            </div>

                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" :disabled="form.busy" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
import Pagination from '../../../../components/Pagination.vue'
export default {
    components: {
        Pagination
    }, 
    data() {
        return {
            users: [],
            pagination: {
                current_page: 1,
            },
            query: '',
            queryField: 'name',
            form: {
                id: '',
                name: '',
                email: '',
                phone: '',
                address: '',
                total: '',
            },
        }
    },
    watch: {
        query: function(newQ, oldQ) {
            if(newQ === '') {
                this.getData()
            } else {
                this.searchData()
            }
        }
    },
    mounted() {
        console.log('Component mounted!');
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('/api/users?page='+this.pagination.current_page) 
                .then(response => {
                    console.log(response);
                    console.log(response.data.data);
                    this.users = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish();
                })
                .catch(e => {
                    console.log(e);
                    this.$Progress.fail();
                });
        },
        searchData() {
            this.$Progress.start()
            axios.get('/api/search/users/'+this.queryField+'/'+this.query+'?page='+this.pagination.current_page)
                .then(response => {
                    this.users = response.data.data;
                    this.pagination = response.data.meta;
                    this.$Progress.finish(); 
                })
                .catch(e => {
                    console.log(e);
                    this.$Progress.fail();
                })
        },
        reload() {
            this.getData();
            this.query = '';
            this.queryField = 'name';
            this.$toast.open({
                message: 'Data successfully reloaded!',
                type: 'success',
                position: 'top-right'
            });

        },
        create() {
            $('#userModalLong').modal('show');
        },
        store() {
            console.log("Hello");
        }
    }
};
</script>

<style></style>
