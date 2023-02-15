<template>
    <Layout>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Notice-->
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
                    <div class="alert-text">Add Expenses To Bill</div>
                </div>
                <!--end::Notice-->
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="col-lg-3 col-xl-3">
<!--                            <div class="form-group">-->
<!--                                <label for="exampleSelect1">Users-->
<!--                                    <span class="text-danger"></span></label>-->
<!--                                <select class="form-control" v-model="user_id" @change="onChangeUser">-->
<!--                                    <option v-for="user in users" :value="user.id"> {{ user.name }}</option>-->

<!--                                </select>-->
<!--                                <span v-if="errors.user_id" class="text-danger" v-text="errors.user_id"></span>-->
<!--                            </div>-->
                        </div>
                        <div class="col-lg-3 col-xl-3">
<!--                            <div class="form-group">-->
<!--                                <label>Salary <span class="text-danger"></span></label>-->
<!--                                <input type="text" disabled v-model="salary" class="form-control" placeholder="Salary"/>-->
<!--                                <span class="text-danger"></span>-->
<!--                            </div>-->
                        </div>
                        <div class="col-lg-3 col-xl-3">
<!--                            <div class="form-group">-->
<!--                                <label>Monthly Working Hours <span class="text-danger"></span></label>-->
<!--                                <input type="text" disabled v-model="monthly_working_hours" class="form-control"-->
<!--                                       placeholder="Monthly Working Hours"/>-->
<!--                                <span class="text-danger"></span>-->
<!--                            </div>-->
                        </div>

                    </div>
                    <div class="card-body">
                            <div class="mb-7">
                                <div v-for="(expense,index) in expenses">
                                    <Expense :expense_id="index" :expense="expense" @deleteExpense="deleteExpense" :errors="errors" :key="index"></Expense>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-3 col-xl-3">
                                        <button   type="button"
                                                @click="addExpense" class="btn btn-primary mr-2">Add Expense
                                        </button>
                                        <button @click="submit" :disabled="expenses.length <= 0" type="submit"
                                                class="btn btn-primary mr-2">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>

<!--                        <span v-if="errors.percentage" class="text-danger" v-text="errors.percentage"></span>-->
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import Expense from "./Expense.vue";
import {createToast} from "mosha-vue-toastify";

export default {
    name: "AddExpensesToBill",
    components: {
        Expense,
        Layout
    },
    props: {
        errors:Object,
        bill:Object,

    },
    data(){
        return {
            expenses: [],
        }
    },
    mounted() {
        this.expenses = this.bill.expenses;
    },
    methods: {
        addExpense(){
            this.expenses.push({
                description: '',
                amount: '',
            })
        },
        deleteExpense(index){
            console.log(index);
            this.expenses.splice(index,1)
        },
        submit(){
            this.$inertia.post(route('bills.add_expenses_to_bill_action', {id: this.bill.id}), {
                user_id: this.user_id,
                expenses: this.expenses,
            })
        }
    },


}
</script>

<style scoped>

</style>
