<template>
    <div class="row align-items-center">

        <div class="col-xl-5">
            <div class="form-group">

                <div class="form-group">
                    <label>Description  <span class="text-danger">*</span></label>
                    <input type="text" v-model="expense.description"   class="form-control"  placeholder="Description"/>
                    <span v-if="errors[`expenses.${expense_id}.description`]" class="text-danger" >{{errors[`expenses.${expense_id}.description`]}}</span>

                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">

                <div class="form-group">
                    <label>Amount   <span class="text-danger">*</span></label>
                    <input   type="number"    v-model="expense.amount"   class="form-control"  placeholder="Amount"/>
                    <span v-if="errors[`expenses.${expense_id}.amount`]" class="text-danger" >{{errors[`expenses.${expense_id}.amount`]}}</span>

                </div>
            </div>
        </div>

        <div class="col-lg-1 col-xl-1">
            <span @click="deleteExpense(expense_id)"><i class="fa fa-trash" style='color: red ;cursor: pointer' ></i></span>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    name: "Expense",
    props:{
       expense:{
           type:Object,
           required:true
       },
        errors:Object,
        expense_id:Number
    },
    methods:{
        deleteExpense(expense_id){
            this.$emit('deleteExpense',expense_id)
        }
    }

}
</script>

<style scoped>

</style>
