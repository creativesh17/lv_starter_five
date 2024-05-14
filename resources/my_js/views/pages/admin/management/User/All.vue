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
                                            <button type="button" class="btn btn-info btn-sm mlrp-4">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm mlrp-4">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm mlrp-4">
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
                            <Pagination class="mtbp-10" v-if="pagination.last_page > 1"
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
                        <h5 class="modal-title" id="userModalLongTitle">Add New User</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="store"> 
                        <div class="modal-body">                                        

                            <div class="form-group">
                                <label class="mp-5" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control mp-5"  v-model="form.name">
                            </div>

                            <div class="form-group">
                                <label class="mp-5" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control mp-5" v-model="form.email">
                            </div>

                            <div class="form-group">
                                <label class="mp-5" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control mp-5" v-model="form.password">
                            </div>

                            <div class="form-group">
                                <label class="mp-5" for="password_confirmation"> Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control mp-5" v-model="form.password_confirmation">
                            </div>

                            <div class="form-group">
                                <label class="mp-5" for="phone">Phone</label>
                                <input type="tel" id="phone" name="phone" class="form-control mp-5" v-model="form.phone">
                            </div>

                            <div class="form-group">
                                <label class="mp-5" for="address">Address</label>
                                <!-- <input type="text" id="address" name="address" class="form-control mp-5" v-model="form.address"> -->
                                <textarea name="address" id="address" class="form-control mp-5" v-model="form.address"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="mp-5" for="total">Total</label>
                                <input type="number" id="total" name="total" class="form-control mp-5" v-model="form.total">
                            </div>

                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                password: '',
                password_confirmation: '',
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
                position: 'top-right',
                duration: 3000
            });

        },
        create() {
            $('#userModalLong').modal('show');
        },
        async store() {
            // console.log("Hello");
            this.$Progress.start();
            await axios.post('/api/users', this.form)
                    .then(response => {
                        // console.log("Dekhi ", response);
                        this.getData();
                        $('#userModalLong').modal('hide');
                        // this.form.reset();
                        // $('.modal-body').reset();                        
                        // $('.modal-body').clear();
                        this.$Progress.finish();
                        this.$toast.open({
                            message: 'Data successfully added!',
                            type: 'success',
                            position: 'top-right'
                        });
                    })
                    .catch(e => {
                        // console.log("Error first ", e.response);
                        var getErrors = e.response.data.errors;
                        console.log("Error cleaner ", getErrors);


                        for (const key in getErrors) {
                            if (Object.hasOwnProperty.call(getErrors, key)) {
                                const element = getErrors[key];
                                // console.log("resss",element);
                                let selector = "name";
                                let el = document.querySelector(`input[${selector}="${key}`);
                                if (!el) {
                                    el = document.getElementById(`${key}`);
                                }

                                /**
                                 *  if html element found then take action
                                 */
                                if (el) {
                                    $(`<div class="error text-warning">${element[0]}</div>`).insertAfter(el);
                                    el.classList.add("border-warning");
                                }
                            }
                        }

                        this.$Progress.fail();
                        this.$toast.open({
                            message: 'Something went wrong!',
                            type: 'error',
                            position: 'top-right'
                        })

                    
                    });

        }
    }
};
</script>

<style></style>


<!-- <span class="invalid-feedback" alert="role"> 
    <strong>{{$errors->first('name')}}</strong>
</span> -->