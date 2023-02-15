<template>
    <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
        <!--begin::Content body-->
        <div class="d-flex flex-column-fluid flex-center">
            <!--begin::Signin-->
            <div class="login-form login-signin rounded-1" style="width: 40% ; border-style: solid; border-width: 2px 2px; padding: 20px ; border-color: #c5c5c5; border-radius: 25px;">
                <!--begin::Form-->
                <form class="form"  @submit.prevent="submit" >
                    <!--begin::Title-->
                    <div class="pb-13 pt-lg-0 pt-5 text-center">
                        <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg ">Login</h3>
                    </div>
                    <!--begin::Title-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                        <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" v-model="form.email" style="background-color: white " type="text" name="email" autocomplete="off" />
                        <span v-if="errors.email" class="text-danger" v-text="errors.email"></span>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="d-flex justify-content-between mt-n5">
                            <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                        </div>
                        <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" v-model="form.password"  style="background-color: white " type="password" name="password" autocomplete="off" />
                        <span v-if="errors.password" class="text-danger" v-text="errors.password"></span>
                    </div>
                    <!--end::Form group-->
                    <!--begin::Action-->
                    <div class="pb-lg-0 pb-5 text-left">
                        <button type="submit" @click="asd" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>

            <!--end::Forgot-->
        </div>

    </div>

</template>

<script >
import {useForm} from "@inertiajs/vue3";



export default {
    name: "Login",
    layout:null,
    setup() {
        const form = useForm({
            email: '',
            password: '',
        });
        const submit = () => {
            form.post('/login', {
                onSuccess: () => {
                    form.reset();
                },
            });
        };

        return {
            form,
            submit
        }
    },

    props: {
        errors: Object,
    },

}



</script>

<style scoped>

</style>
