<template>
    <div class="d-flex justify-space-around">
        <v-menu>
            <template v-slot:activator="{ props }">
                <v-btn
                    color="primary"
                    v-bind="props"
                >
                    Actions
                </v-btn>
            </template>
            <v-list>
                <v-list-item
                    v-for="(item, index) in items"
                    :key="index"
                    :value="index"
                    @click="visit(item.url,item.bill)"
                    :bill="item.bill"
                >
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>
<script>

import 'vuetify/styles'
import {Link} from "@inertiajs/vue3";

export default {
    props: {
        items: Array,
    },
    components: {Link},
    methods: {
        visit(url,bill) {
            if (url.includes('change_bill_status')) {
                this.openClose(bill);
                return false;
            }
            this.$inertia.visit(url);
        },
        openClose(bill) {
            this.$emit('openClose',bill);
        },
    }
}
</script>
