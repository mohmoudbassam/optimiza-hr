<template>
    <Layout>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Notice-->
                <div class="alert alert-custom alert-white alert-shadow gutter-b d-flex " role="alert">

                    <div class="alert-text">My Tasks in {{ getMonthYear()}}</div>
                    <div>
                        working hours : {{$page.props.user.monthly_working_hours}}
                    </div>
                </div>
                <!--end::Notice-->
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-body">

                            <div class="mb-7">
                                <div v-for="(task,index) in tasks">
                                    <Task   :errors="errors" :key="index"
                                          :task_id="index" @updateHours="updateHours" @deleteTask="deleteTask" :task="task"
                                          :projects="projects"></Task>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-3 col-xl-3">
                                        <button :disabled="totalPercentage>100" v-if="salary != '' " type="button"
                                                @click="addTask" class="btn btn-primary mr-2">Add Task
                                        </button>
                                        <button :disabled="disableSubmit" @click="submit" type="submit"
                                                class="btn btn-primary mr-2">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>

                        <span v-if="errors.percentage" class="text-danger" v-text="errors.percentage"></span>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../Shared/Layout.vue";
import Task from "./Task.vue";

import axios from "axios";
export default {
    name: "MyTasks",
    components: {Layout, Task},
    props:{
        bill: Object,
        errors: Object,
        projects: Array,
        tasks: [],
    },
    data(){
      return {
          disableSubmit: true,
      }
    },
    mounted() {
        this.updateHours();
    },
    methods: {
        addTask() {
            this.tasks.push({
                id: '',
                task_name: '',
                hours: '',
                percentage: '',
                paid: '',
                project_id: '',
                project_name: '',
                company_id: this.bill.id,
            })
        },
        getMonthYear(){
            return this.bill.month + '-' + this.bill.year;
        },
        deleteTask(index) {
            this.tasks.splice(index, 1);
            this.updateHours();
        },
        updateHours(){
          const total_hours= this.tasks.reduce((acc,task)=>{
             return   acc+task.hours;
           },0)

            this.disableSubmit = total_hours > this.$page.props.user.monthly_working_hours;
        },
        submit() {

            this.$inertia.post(route('tasks.store_tasks'), {

                tasks: this.tasks,
                bill_id: this.bill.id,
            })
        },

    },

}
</script>

<style scoped>

</style>
