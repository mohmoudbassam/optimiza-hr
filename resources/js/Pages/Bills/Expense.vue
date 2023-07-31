<template>
    <div class="row align-items-center">


        <div class="col-lg-3 col-xl-3">
            <div class="form-group">
                <label for="exampleSelect1">Expenses Type
                    <span class="text-danger"></span></label>
                <select class="form-control" v-model="expense.main_expenses_id">
                    <option v-for="mainExpense in MainExpenses" :value="mainExpense.id"
                            :selected="{'true':expense.main_expenses_id == mainExpense.id}"
                    > {{ mainExpense.name }}</option>
                </select>
                <span v-if="errors[`expenses.${expense_id}.main_expenses_id`]"
                      class="text-danger">this filed is required </span>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="form-group">

                <div class="form-group">
                    <label>Amount <span class="text-danger">*</span></label>
                    <input type="number" v-model="expense.amount" class="form-control" placeholder="Amount"/>
                    <span v-if="errors[`expenses.${expense_id}.amount`]"
                          class="text-danger">this filed is required </span>
                </div>
            </div>
        </div>

        <div class="col-lg-1 col-xl-1">
            <span @click="deleteExpense(expense_id)"><i class="fa fa-trash"
                                                        style='color: red ;cursor: pointer'></i></span>
        </div>
        <hr>
    </div>
</template>

<script>
export default {
    name: "Expense",
    props: {
        expense: {
            type: Object,
            required: true
        },
        errors: Object,
        expense_id: Number,
        MainExpenses: Array
    },
    methods: {
        deleteExpense(expense_id) {
            this.$emit('deleteExpense', expense_id)
        }
    }
}
</script>

<style scoped>

</style>
