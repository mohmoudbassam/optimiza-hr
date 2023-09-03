<template>
    <TreeTable :value="nodes" :lazy="true" :loading="loading" @nodeExpand="onExpand" class="p-treetable-lg">
        <Column field="project_name" header="project" :expander="true"></Column>
        <Column field="company_name" header="company" ></Column>
        <Column field="employee" header="employee" ></Column>

        <Column field="percentage" header="percentage"></Column>
        <Column field="hours" header="hours" >
            <template #footer> {{total_hours}}</template>
        </Column>

        <Column field="paid" header="paid">
            <template #footer> {{totalSalary}}</template>
        </Column>
        <Column field="fess" header="fess">
            <template #footer> {{total_fees}}</template>
        </Column>
        <Column field="total" header="total">
            <template #footer> {{total_salary_with_fees}} </template>
        </Column>
    </TreeTable>
</template>

<script>
import TreeTable from 'primevue/treetable';
import Column from 'primevue/column';
import axios from "axios";

export default {
    name: "ReportTableByProject.vue",
    components: {
        TreeTable,
        Column
    },
    props: {
        month: {
            type: [String, Number, undefined],
            required: true
        },
        year: {
            type: [String, Number, undefined],
            required: true
        }
    },
    data() {
        return {
            nodes: [],
            loading: false,
            totalSalary: 0,
            total_fees: 0,
            total_salary_with_fees: 0,
            total_hours: 0,
        }
    },
    mounted() {
        axios.get(route('reports.get_report_by_projects',{month:this.month,year: this.year })).then(res => {
            this.nodes = res.data.data;
            this.totalSalary = res.data.total_salary
            this.total_fees = res.data.total_fees
            this.total_salary_with_fees = res.data.total_salary_with_fees
            this.total_hours = res.data.total_hours
        });
    },
    methods:{
        onExpand(node) {

            axios.get(route('reports.get_children_for_project',{month:this.month,year: this.year,project:node.key })).then(response => {

                this.loading = true;

                setTimeout(() => {
                    let lazyNode = {...node};
                    console.log(lazyNode);
                    lazyNode.children = response.data;
                    let nodes = this.nodes.map(n => {
                        if (n.key === node.key) {
                            n = lazyNode;
                        }

                        return n;
                    });

                    this.loading = false;
                    this.nodes = nodes;
                }, 250);


            });

        },
        getUsers(nodeId){
            this.$emit('getUsersForCompany',nodeId.data.company_id);
        }
    }
}

</script>

<style scoped>

</style>
