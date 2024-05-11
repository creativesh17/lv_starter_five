<template>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Dashboard /</span> User Management
        </h4>

        <!-- Basic Bootstrap Table -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
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
                                    <tr v-for="(user, index) in users" :key="user.id">
                                        <th scope="row">{{ index + 1}}</th>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.phone }}</td>
                                        <td>{{ user.total }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash "></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
        }
    },
    mounted() {
        console.log('Component mounted!');
        this.getData();
    },
    methods: {
        getData() {
            this.$Progress.start();
            axios.get('/api/users')
                .then(response => {
                    // console.log(response.data.data);
                    this.users = response.data.data;
                    this.$Progress.finish();
                })
                .catch(e => {
                    console.log(e);
                    this.$Progress.fail();
                });
        }
    }
};
</script>

<style></style>
