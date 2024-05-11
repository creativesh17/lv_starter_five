<template lang="">
    <div class="container page-container">
        <div class="row justify-content-left">
            <div class="col-md-4">
                <div class="card">

                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <router-link to="/admin" class="rounded-md px-3 py-2 mt-5 btn-info">
                            Dashboard
                        </router-link>
                    </div>
                    
                </div>
            </div>
        </div>
    </div> 
</template>
<script>
export default {
    created: function() {
        console.log("created Welcome");
    }
}
</script>
<style lang="">

</style>