<template>
    <TreeTable :value="nodes" :lazy="true" :loading="loading" @nodeExpand="onExpand" class="p-treetable-lg">
        <Column field="company_name" header="company" :expander="true"></Column>
        <Column field="project_name" header="project" >
            <template #footer> Total: </template>
        </Column>
        <Column field="hours" header="hours" >
            <template #footer> {{total_hours}} </template>
        </Column>
        <Column field="paid" header="paid">
            <template #footer> {{totalSalary}} </template>
        </Column>
        <Column field="fees" header="fees">
            <template #footer> {{total_fees}} </template>
        </Column>
        <Column field="total" header="total">
            <template #footer> {{total_salary_with_fees}} </template>
        </Column>
        <Column header="paid" headerStyle="width: 20rem">
            <template #body="slotProps">
                <button @click="getUsers(slotProps.node)"   class="btn btn-primary mr-2">info</button>
            </template>
        </Column>
    </TreeTable>
</template>

<script>
import TreeTable from 'primevue/treetable';
import Column from 'primevue/column';
import axios from "axios";

export default {
    name: "SummaryTableByCompany.vue",
    components: {TreeTable, Column},
    props: {
        bill: Object,
    },
    mounted() {
        axios.get(route('tasks.get_company_summary',{bill:this.bill.id })).then(res => {
            this.nodes = res.data;
            this.nodes = res.data.data;
            this.totalSalary = res.data.total_salary
            this.total_fees = res.data.total_fees
            this.total_salary_with_fees = res.data.total_salary_with_fees
            this.total_hours = res.data.total_hours
        });
    },
    data() {
        return {
            nodes: [],
            loading: false,
            totalSalary:0,
            total_fees:0,
            total_salary_with_fees:0,
            total_hours:0,
        }
    },
    methods:{
        onExpand(node) {

            axios.get(route('tasks.get_children_for_company',{bill:this.bill.id,company:node.key })).then(response => {

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
            if(nodeId.data.company_id){
                this.$emit('getUsersForCompany',nodeId.data.company_id);
            }else{
                this.$emit('getUsersForProject',nodeId.data.project_id);
            }

        }
    }
}

</script>

<style scoped>

</style>
