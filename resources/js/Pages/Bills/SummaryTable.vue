<template>
    <TreeTable :value="nodes" :lazy="true" :loading="loading" @nodeExpand="onExpand" class="p-treetable-lg">
        <Column field="user" header="user" :expander="true"></Column>
        <Column field="hours" header="hours" ></Column>
        <Column field="percentage" header="percentage"></Column>
        <Column field="project" header="project"></Column>
        <Column field="paid" header="Salary"></Column>
        <Column field="fees" header="fess"></Column>
        <Column field="total" header="total"></Column>
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
        axios.get(route('tasks.get_users_summary',{bill:this.bill.id })).then(response => {
            this.nodes = response.data;
        });
    },
    data() {
        return {
            nodes: [
                        ],
            loading: false,

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
