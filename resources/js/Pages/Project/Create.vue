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
                    <div class="alert-text">Create New Project </div>
                </div>
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            Project Form
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
                                <label>Project Name  <span class="text-danger">*</span></label>
                                <input type="text" v-model="form.name"   class="form-control"  placeholder="Project Name "/>
                                <span v-if="errors.name" class="text-danger" v-text="errors.name"></span>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" v-model="form.description" class="form-control form-control-solid" rows="3"></textarea>
                                <span v-if="errors.description" class="text-danger" v-text="errors.description"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">Company
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" v-model="form.company_id">
                                    <option v-for="company in companies" :value="company.id">{{ company.name }}</option>

                                </select>
                                <span v-if="errors.company_id" class="text-danger" v-text="errors.company_id"></span>
                            </div>

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
import Layout from "@/Shared/Layout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import {createToast} from "mosha-vue-toastify";
export default {
    name: "Create",
    components: {Layout, Link},
    props: {
        errors: Object,
        companies: Object,
    },
    setup() {
        const form= useForm({
            name: "",
            description: "",
            company_id: "",
        });
        const submit = () => {
            form.post(route("projects.store"), {
                preserveScroll: true,
                onSuccess: () => {
                    console.log("success");
                    form.reset("name", "description");
                    createToast("Project Created Successfully", {
                        type: "success",
                        position: "top-right",
                        timeout: 3000,
                    });
                },
            });
        };

        return {
            form,
            submit,
        };
    },
}
</script>

<style scoped>

</style>
