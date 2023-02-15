<template>
    <component
        :is="link.url ? 'Link':'span'"
        :href="link.url"

        v-for="link in links"
        v-html="link.label"
        class="page"
        :class="{ 'active': link.active }"
    />
</template>

<script>
import {Link} from "@inertiajs/vue3";
export default {
    name: "Pagination",
    components: {
        Link
    },
    props: {
        links: Array
    }
}
</script>

<style scoped>
.page{
    cursor: pointer;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    height: 2.25rem;
    min-width: 2.25rem;
    padding: 0.5rem;

    position: relative;
    font-size: .9rem;
    line-height: 1rem;
    font-weight: 500;
    border-radius: 0.42rem;
    color: #7e8299;
}
.active{
    background-color: #3699ff;
    color: #fff;
}

</style>
