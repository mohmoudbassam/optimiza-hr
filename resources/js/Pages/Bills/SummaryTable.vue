<template>
    <TreeTable :value="nodes" :lazy="true" :loading="loading" @nodeExpand="onExpand" class="p-treetable-lg">
        <Column field="user" header="user" :expander="true"></Column>

        <Column field="percentage" header="percentage"></Column>
        <Column field="project" header="project"></Column>
        <Column field="hours" header="hours" >
            <template #footer> {{total_hours}} </template>
        </Column>
        <Column field="paid" header="Salary">
            <template #footer> {{totalSalary}} </template>
        </Column>
        <Column field="fees" header="fees">
            <template #footer> {{total_fees}} </template>
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
    components: {TreeTable, Column},
    props: {
        bill: Object,
    },
    mounted() {
        axios.get(route('tasks.get_users_summary',{bill:this.bill.id })).then(res => {
            this.nodes = res.data.data;
            this.totalSalary = res.data.total_salary
            this.total_fees = res.data.total_fees
            this.total_salary_with_fees = res.data.total_salary_with_fees
            this.total_hours = res.data.total_hours
        });
    },
    data() {
        return {
            nodes: [
                        ],
            loading: false,
            totalSalary:0,
            total_fees:0,
            total_salary_with_fees:0,
            total_hours:0,

        }
    },
    methods:{
        onExpand(node) {

            axios.get(route('tasks.get_children',{bill:this.bill.id,user:node.key })).then(response => {

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
    }

}
</script>
