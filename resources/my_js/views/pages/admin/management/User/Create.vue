<template>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create User</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="ti ti-user"></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                    <input type="text" id="basic-icon-default-email" class="form-control" placeholder="john.doe" aria-label="john.doe" aria-describedby="basic-icon-default-email2" />
                                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                                </div>
                                <div class="form-text">You can use letters, numbers &amp; periods</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="ti ti-phone"></i></span>
                                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="658 799 8941" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">Upload Image</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-company2" class="input-group-text"><i class="ti ti-photo"></i></span>
                                    <input type="file" id="basic-icon-default-company" class="form-control" name="image"/>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">Message</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i class="ti ti-message-dots"></i></span>
                                    <textarea
                                        id="basic-icon-default-message"
                                        class="form-control"
                                        placeholder="Hi, Do you have a moment to talk Joe?"
                                        aria-label="Hi, Do you have a moment to talk Joe?"
                                        aria-describedby="basic-icon-default-message2"
                                    ></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
    export default {

    }
</script>

<style lang="scss" scoped>

</style>