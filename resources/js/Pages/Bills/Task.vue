<template>
    <div class="row align-items-center">
        <div class="col-lg-2 col-xl-2">
            <div class="form-group">
                <label for="exampleSelect1">Project
                    <span class="text-danger"></span></label>
                <select class="form-control"  v-model="task.project_id" @change="onProjectChange">
                    <option v-for="project in projects" :value="project.id"> {{ project.name }}</option>
                </select>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">

                <div class="form-group">
                    <label>Task Name  <span class="text-danger">*</span></label>
                    <input type="text" v-model="task.task_name"   class="form-control"  placeholder="Task Name"/>

                </div>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">

                <div class="form-group">
                    <label>Percentage %  <span class="text-danger">*</span></label>
                    <input   type="number"  @input="updatePercentage"  v-model="task.percentage"   class="form-control"  placeholder="Percentage"/>
                </div>
                <span v-if="errors[`tasks.${task_id}.percentage`]" class="text-danger" >{{errors[`tasks.${task_id}.percentage`]}}</span>

            </div>
        </div>
        <div class="col-xl-1">
            <div class="form-group">

                <div class="form-group">
                    <label>Hours   <span class="text-danger"></span></label>
                    <input disabled   type="number"  v-model="task.hours"   class="form-control"  placeholder="Hours"/>
                </div>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">

                <div class="form-group">
                    <label>Company  <span class="text-danger">*</span></label>
                    <input type="text" disabled v-model="task.company_id"   class="form-control"  placeholder="Company"/>

                </div>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">

                <div class="form-group">
                    <label>Paid  <span class="text-danger">*</span></label>
                    <input type="text" disabled v-model="task.paid"   class="form-control"  placeholder="Company"/>

                </div>
            </div>
        </div>
        <div class="col-lg-1 col-xl-1">
            <span @click="deleteTask"><i class="fa fa-trash" style='color: red ;cursor: pointer' ></i></span>
        </div>
        <hr>
    </div>
</template>

<script>
import { Form, Field } from 'vee-validate';
import {createToast} from "mosha-vue-toastify";
export default {
    name: "Task",
    components: {
        Form,
        Field
    },
    props: {
        user: Object,
        projects: Array,
        task: Object,
        task_id: Number,
        errors: Object,
    },
    watch: {
     user: function (newVal, oldVal) {
         this.task.hours= (this.task.percentage /100)*this.user.monthly_working_hours;
         this.task.paid= (this.task.percentage /100)*this.user.salary;
     },
    },
    data() {
        return {
            project_id: this.task.project_id,
            percentage: this.task.percentage,
            task_name: this.task.percentage,
            company_id: this.task.company_id,
            hours: this.task.hours,
            paid: this.task.paid,
        }
    },

    methods: {
        onProjectChange() {
            this.task.company_id = this.projects.find(project => project.id === this.task.project_id).company.name;
        },
        deleteTask() {
            this.$emit('deleteTask', this.task_id);
        },
        updatePercentage(e) {
            this.task.hours= (this.task.percentage /100)*this.user.monthly_working_hours;
            this.task.paid= (this.task.percentage /100)*this.user.salary;
            this.$emit('updatePercentage');
        },
    }
}
</script>

<style scoped>

</style>
