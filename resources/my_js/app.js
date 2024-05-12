// setup  files
import './bootstrap';

import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from 'vue-router';
import VueProgressBar from "@aacassandra/vue3-progressbar";
// import Pagination from './views/components/Pagination.vue'

// welcome
import WelcomeLayout from './views/Welcome.vue'
import App from './views/App.vue';


import AdminLayout from './views/pages/admin/Layout.vue' 
import AdminDashboard from './views/pages/admin/Dashboard.vue'

import AdminUserLayout from './views/pages/admin/management/User/Layout.vue'
import AdminUserAll from './views/pages/admin/management/User/All.vue'
import AdminUserCreate from './views/pages/admin/management/User/Create.vue'

// common components



const VueProgressBarOptions = {
    color: "#7367f0",
    failedColor: "#874b4b",
    thickness: "5px",
    transition: {
      speed: "0.5s",
      opacity: "0.6s",
      termination: 500,
    },
    autoRevert: true,
    location: "top",
    inverse: false,
};


// project routes
// routers
const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: "/",
            component: WelcomeLayout
        },
        {
            path: "/admin",
            component: App,
            children: [
                {
                    path: "",
                    name: "adminLayout",
                    component: AdminLayout,
                    children: [
                        {
                            path: "dashboard",
                            name: "adminDashboard",
                            component: AdminDashboard,
                        },
                        {
                            path: "user",
                            name: "adminUserLayout",
                            component: AdminUserLayout,
                            children: [
                                {
                                    path: "all",
                                    name: "adminUserAll",
                                    component: AdminUserAll,
                                },
                                {
                                    path: "create",
                                    name: "adminUserCreate",
                                    component: AdminUserCreate,
                                },
                            ]
                        }
                    ]
                }
            ]
        }
    ]
})

// previous route store
router.beforeEach((to, from, next) => {
    to.href.length > 2 &&
        window.sessionStorage.setItem('prevurl', to.href);
    next();
});

// render component
const app = createApp({});

app.component('app', App);
// app.component('Pagination', Pagination);
app.use(router).use(VueProgressBar, VueProgressBarOptions);
app.mount('#app')
