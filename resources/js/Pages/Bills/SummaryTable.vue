<template>
    <TreeTable :value="nodes" :lazy="true" :loading="loading" @nodeExpand="onExpand" class="p-treetable-lg">
        <Column field="user" header="user" :expander="true"></Column>
        <Column field="hours" header="hours" ></Column>
        <Column field="percentage" header="percentage"></Column>
        <Column field="project" header="project"></Column>
        <Column field="paid" header="paid"></Column>
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
                            //
                            // {
                            //     "key": "1",
                            //     "data":{
                            //         "name":"Cloud",
                            //         "size":"20kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "1-0",
                            //             "data":{
                            //                 "name":"backup-1.zip",
                            //                 "size":"10kb",
                            //                 "type":"Zip"
                            //             }
                            //         },
                            //         {
                            //             "key": "1-1",
                            //             "data":{
                            //                 "name":"backup-2.zip",
                            //                 "size":"10kb",
                            //                 "type":"Zip"
                            //             }
                            //         }
                            //     ]
                            // },
                            // {
                            //     "key": "2",
                            //     "data": {
                            //         "name":"Desktop",
                            //         "size":"150kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "2-0",
                            //             "data":{
                            //                 "name":"note-meeting.txt",
                            //                 "size":"50kb",
                            //                 "type":"Text"
                            //             }
                            //         },
                            //         {
                            //             "key": "2-1",
                            //             "data":{
                            //                 "name":"note-todo.txt",
                            //                 "size":"100kb",
                            //                 "type":"Text"
                            //             }
                            //         }
                            //     ]
                            // },
                            // {
                            //     "key": "3",
                            //     "data":{
                            //         "name":"Documents",
                            //         "size":"75kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "3-0",
                            //             "data":{
                            //                 "name":"Work",
                            //                 "size":"55kb",
                            //                 "type":"Folder"
                            //             },
                            //             "children":[
                            //                 {
                            //                     "key": "3-0-0",
                            //                     "data":{
                            //                         "name":"Expenses.doc",
                            //                         "size":"30kb",
                            //                         "type":"Document"
                            //                     }
                            //                 },
                            //                 {
                            //                     "key": "3-0-1",
                            //                     "data":{
                            //                         "name":"Resume.doc",
                            //                         "size":"25kb",
                            //                         "type":"Resume"
                            //                     }
                            //                 }
                            //             ]
                            //         },
                            //         {
                            //             "key": "3-1",
                            //             "data":{
                            //                 "name":"Home",
                            //                 "size":"20kb",
                            //                 "type":"Folder"
                            //             },
                            //             "children":[
                            //                 {
                            //                     "key": "3-1-0",
                            //                     "data":{
                            //                         "name":"Invoices",
                            //                         "size":"20kb",
                            //                         "type":"Text"
                            //                     }
                            //                 }
                            //             ]
                            //         }
                            //     ]
                            // },
                            // {
                            //     "key": "4",
                            //     "data": {
                            //         "name":"Downloads",
                            //         "size":"25kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "4-0",
                            //             "data": {
                            //                 "name":"Spanish",
                            //                 "size":"10kb",
                            //                 "type":"Folder"
                            //             },
                            //             "children":[
                            //                 {
                            //                     "key": "4-0-0",
                            //                     "data":{
                            //                         "name":"tutorial-a1.txt",
                            //                         "size":"5kb",
                            //                         "type":"Text"
                            //                     }
                            //                 },
                            //                 {
                            //                     "key": "4-0-1",
                            //                     "data":{
                            //                         "name":"tutorial-a2.txt",
                            //                         "size":"5kb",
                            //                         "type":"Text"
                            //                     }
                            //                 }
                            //             ]
                            //         },
                            //         {
                            //             "key": "4-1",
                            //             "data":{
                            //                 "name":"Travel",
                            //                 "size":"15kb",
                            //                 "type":"Text"
                            //             },
                            //             "children":[
                            //                 {
                            //                     "key": "4-1-0",
                            //                     "data":{
                            //                         "name":"Hotel.pdf",
                            //                         "size":"10kb",
                            //                         "type":"PDF"
                            //                     }
                            //                 },
                            //                 {
                            //                     "key": "4-1-1",
                            //                     "data":{
                            //                         "name":"Flight.pdf",
                            //                         "size":"5kb",
                            //                         "type":"PDF"
                            //                     }
                            //                 }
                            //             ]
                            //         }
                            //     ]
                            // },
                            // {
                            //     "key": "5",
                            //     "data": {
                            //         "name":"Main",
                            //         "size":"50kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "5-0",
                            //             "data":{
                            //                 "name":"bin",
                            //                 "size":"50kb",
                            //                 "type":"Link"
                            //             }
                            //         },
                            //         {
                            //             "key": "5-1",
                            //             "data":{
                            //                 "name":"etc",
                            //                 "size":"100kb",
                            //                 "type":"Link"
                            //             }
                            //         },
                            //         {
                            //             "key": "5-2",
                            //             "data":{
                            //                 "name":"var",
                            //                 "size":"100kb",
                            //                 "type":"Link"
                            //             }
                            //         }
                            //     ]
                            // },
                            // {
                            //     "key": "6",
                            //     "data":{
                            //         "name":"Other",
                            //         "size":"5kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "6-0",
                            //             "data":{
                            //                 "name":"todo.txt",
                            //                 "size":"3kb",
                            //                 "type":"Text"
                            //             }
                            //         },
                            //         {
                            //             "key": "6-1",
                            //             "data":{
                            //                 "name":"logo.png",
                            //                 "size":"2kb",
                            //                 "type":"Picture"
                            //             }
                            //         }
                            //     ]
                            // },
                            // {
                            //     "key": "7",
                            //     "data":{
                            //         "name":"Pictures",
                            //         "size":"150kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "7-0",
                            //             "data":{
                            //                 "name":"barcelona.jpg",
                            //                 "size":"90kb",
                            //                 "type":"Picture"
                            //             }
                            //         },
                            //         {
                            //             "key": "7-1",
                            //             "data":{
                            //                 "name":"primevue.png",
                            //                 "size":"30kb",
                            //                 "type":"Picture"
                            //             }
                            //         },
                            //         {
                            //             "key": "7-2",
                            //             "data":{
                            //                 "name":"prime.jpg",
                            //                 "size":"30kb",
                            //                 "type":"Picture"
                            //             }
                            //         }
                            //     ]
                            // },
                            // {
                            //     "key": "8",
                            //     "data":{
                            //         "name":"Videos",
                            //         "size":"1500kb",
                            //         "type":"Folder"
                            //     },
                            //     "children":[
                            //         {
                            //             "key": "8-0",
                            //             "data":{
                            //                 "name":"primefaces.mkv",
                            //                 "size":"1000kb",
                            //                 "type":"Video"
                            //             }
                            //         },
                            //         {
                            //             "key": "8-1",
                            //             "data":{
                            //                 "name":"intro.avi",
                            //                 "size":"500kb",
                            //                 "type":"Video"
                            //             }
                            //         }
                            //     ]
                            // }
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
