import moment from "moment";
import axios from "axios";
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// window.axios.defaults.headers.common["Authorization"] = `Bearer ${window.localStorage?.token}`;
// axios.defaults.baseURL = location.origin + "/api/v1/";


axios.interceptors.request.use(
    async function (config) {
        $('.form-validation-error').remove()
        return {
            ...config,
            // onUploadProgress,
            // onDownloadProgress,
        };
    },
    function (error) {
        // Do something with request error
        console.log("request error");
        return Promise.reject(error);
    }
);

window.render_form_errors = function (object, selector = "name") {
    for (const key in object) {
        if (Object.hasOwnProperty.call(object, key)) {
            const element = object[key];
            // console.log("resss",element);
            let el = document.querySelector(`input[${selector}="${key}`);
            if (!el) {
                el = document.getElementById(`${key}`);
            }

            /**
             *  if html element found then take action
             */
            if (el) {
                $(
                    `<div class="error text-warning form-validation-error">${element[0]}</div>`
                ).insertAfter(el);
                el.classList.add("border-warning");
            }
        }
    }
};

window.axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        let object = error.response?.data?.errors;
        render_form_errors(object);

        if (typeof error?.response?.data === "string") {
            console.log(
                "error",
                error?.response?.data ? error?.response?.data : error.response
            );
        } else {
            console.log(error.response || error);
            if (error.response.data.status == "server_error") {
                window.s_warning(error.response.data.message);
            }
            if (error.response.data.status == "error") {
                window.s_error(error.response.data.message);
            }
        }

        // if(error.response.status == 401){
        //     window.clear_session();
        // }
        console.log(error);
        // let status = error.response.status;
        // window.s_alert('error '+status+': '+error.response?.statusText,'error')
        throw error;
    }
);