<template>
    <Layout>
        <div class="d-flex flex-column-fluid">

            <div class="container">
                <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                    <div class="alert-icon">
										<span class="svg-icon svg-icon-primary svg-icon-xl">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path
                                                        d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
                                                        fill="#000000" opacity="0.3"></path>
													<path
                                                        d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
                                                        fill="#000000" fill-rule="nonzero"></path>
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
                    </div>
                    <div class="alert-text">Create New User</div>
                </div>
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            User Form
                        </h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form @submit.prevent="submit">

                        <div class="card-body">

                            <div class="form-group">
                                <label>User Name <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.name" name="name" class="form-control"
                                       placeholder="User Name "/>
                                <span v-if="errors.name" class="text-danger" v-text="errors.name"></span>
                            </div>

                            <div class="form-group">
                                <label>Email address <span class="text-danger">*</span></label>
                                <input type="email" v-model="form.email" name="email" class="form-control"
                                       placeholder="Enter email"/>
                                <span v-if="errors.email" class="text-danger" v-text="errors.email"></span>
                            </div>
                            <div class="form-group">
                                <label>Salary <span class="text-danger">*</span></label>
                                <input type="number" v-model="form.salary" name="salary" class="form-control"
                                       placeholder="Salary"/>
                                <span v-if="errors.salary" class="text-danger" v-text="errors.salary"></span>
                            </div>
                            <div class="form-group">
                                <label>Monthly Working Hours <span class="text-danger">*</span></label>
                                <input type="number" v-model="form.monthly_working_hours" name="monthly_working_hours"
                                       class="form-control" placeholder="Monthly Working Hours"/>
                                <span v-if="errors.monthly_working_hours" class="text-danger"
                                      v-text="errors.monthly_working_hours"></span>
                            </div>

                            <div class="form-group">
                                <label>DOB <span class="text-danger">*</span></label>
                                <input type="date" v-model="form.dob" class="form-control" name="dob"
                                       placeholder="DOB"/>
                                <span v-if="errors.dob" class="text-danger" v-text="errors.dob"></span>
                            </div>
                            <div>
                                <label for="File">Image</label>
                            </div>

                            <FilePond

                                ref="pond"
                                label-idle="Drop files here..."
                                v-bind:allow-multiple="false"
                                name="image"

                                accepted-file-types="image/jpeg, image/png"
                                :server="{
                               url: route('users.upload_image'),
                               process: {
                               headers: {
                                   'X-CSRF-TOKEN': csrfToken
                                 },
                                 onload:handleFileUpload,
                                 },

                               }"

                                v-on:init="handleFilePondInit"
                            />


                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>

            </div>

        </div>


    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import {useForm} from "@inertiajs/vue3";
import {createToast} from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css'
// Import Vue FilePond
import vueFilePond from "vue-filepond";

// Import FilePond styles
import "filepond/dist/filepond.min.css";

// Import FilePond plugins
// Please note that you need to install these plugins separately

// Import image preview plugin styles
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";

// Import image preview and file type validation plugins
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";

// Create component
const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);
export default {
    name: "Create",
    components: {
        Layout,
        FilePond
    },

    props: {
        errors: Object,
    },
    data() {
        return {
            url: null,
            csrfToken: '',
            image_path: '',
        }
    },
    mounted() {
        this.csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const elements = document.getElementsByClassName("filepond--credits");
        for (const element of elements) {
            element.style.visibility = "hidden";
        }
    },
    methods: {
        handleFileUpload(response) {

            if (response) {
                this.form.image = JSON.parse(response).filename;
            }
        }
    },
    setup() {

        const form = useForm({
            name: '',
            email: '',
            salary: '',
            dob: '',
            monthly_working_hours: '',
            image: '',
        });
        const submit = () => {

            form.post(route('users.store'), {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset('name', 'email', 'salary', 'dob');
                    createToast({type: 'warning', title: 'Successfully', description: 'user created Successfully'})
                },
                onError: () => {

                }
            });
        }


        const handleFilePondInit = function (e) {

        }

        return {
            form, submit, handleFilePondInit
        }
    }
}
</script>

<style scoped>

</style>
