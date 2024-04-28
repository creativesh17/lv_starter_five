<template>
     <!-- Layout wrapper -->
     <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -Sidebar -->
            <Sidebar></Sidebar>
            <!-- / Menu -Sidebar -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <top-header></top-header>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <router-view></router-view>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->
</template>

<script>
import Sidebar from './partials/Sidebar.vue'
import TopHeader from './partials/TopHeader.vue'
export default {
    components: {
        Sidebar,
        TopHeader,
    },
}
</script>

<style>

</style>