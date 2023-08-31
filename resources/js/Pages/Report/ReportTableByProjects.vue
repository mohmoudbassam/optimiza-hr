<template>
    <TreeTable :value="nodes" :lazy="true" :loading="loading" @nodeExpand="onExpand" class="p-treetable-lg">
        <Column field="project_name" header="project" :expander="true"></Column>
        <Column field="company_name" header="company" ></Column>
        <Column field="employee" header="employee" ></Column>
        <Column field="hours" header="hours" ></Column>

        <Column field="percentage" header="percentage"></Column>
        <Column field="paid" header="paid"></Column>
<!--        <Column header="paid" headerStyle="width: 20rem">-->
<!--            <template #body="slotProps">-->
<!--                <button @click="getUsers(slotProps.node)"   class="btn btn-primary mr-2">info</button>-->
<!--            </template>-->
<!--        </Column>-->
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

        }
    },
    mounted() {
        axios.get(route('reports.get_report_by_projects',{month:this.month,year: this.year })).then(response => {
            this.nodes = response.data;
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
