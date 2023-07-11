<template>
    <div class="row align-items-center">
        <div class="col-lg-2 col-xl-2">
            <div class="form-group">
                <label for="exampleSelect1">Project
                    <span class="text-danger"></span></label>
                <select class="form-control"  v-model="task.project_id" @change="onProjectChange">
                    <option v-for="project in projects" :value="project.id"> {{ project.name }}</option>

                </select>
                <span v-if="errors[`tasks.${task_id}.project_id`]" class="text-danger" >this filed is required</span>

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
                    <input disabled   type="number"    v-model="task.percentage"   class="form-control"  placeholder="Percentage"/>
                </div>

            </div>
        </div>
        <div class="col-xl-1">
            <div class="form-group">

                <div class="form-group">
                    <label>Hours   <span class="text-danger"></span></label>
                    <input @input="updateHours" min="1"   type="number"  v-model="task.hours"   class="form-control"  placeholder="Hours"/>
                    <span v-if="errors[`tasks.${task_id}.hours`]" class="text-danger" >this filed is required</span>

                </div>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="form-group">

                <div class="form-group">
                    <label>date  <span class="text-danger">*</span></label>
                    <Calendar v-model="date" selectionMode="range" :manualInput="false"  dateFormat="mm/dd/yy" />

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
import Calendar from "primevue/calendar";
export default {
    name: "Task",
    components: {
        Form,
        Field,
        Calendar
    },
    props: {
        user: Object,
        projects: Array,
        task: Object,
        task_id: Number,
        errors: Object,
    },

    watch:{
        'task.project_id':function (val){
            this.task.company_id =this.projects.find(project => project.id == val).company.name;
        },
        "date": function () {
            this.task.date = this.date
        },
    },
    methods:{
        updateHours(){
         this.task.percentage = ((this.task.hours / this.$page.props.user.monthly_working_hours) * 100).toFixed(2);
         this.task.paid= ((this.task.percentage /100)*this.$page.props.user.salary).toFixed(2);
         this.$emit('updateHours');
        },
        deleteTask(){
            this.$emit('deleteTask',this.task_id);
        }
    },
    data() {
        return {
            date: [],
        }
    },
    created() {
        if(this.task.from_date){
            this.date[0] =new Date (this.task.from_date)
            this.date[1] = new Date (this.task.to_date)
        }
        this.task.date=this.date
    },


}
</script>

<style scoped>

</style>
