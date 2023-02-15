<template>
    <div class="d-none d-lg-flex align-items-center mr-3">
        <!--begin::Logo-->
        <a href="index.html" class="mr-20">
<!--            <img alt="Logo" src="assets/media/logos/logo-letter-9.png" class="max-h-35px" />-->
        </a>
        <!--end::Logo-->
        <!--begin::Tab Navs(for desktop mode)-->
        <ul class="header-tabs nav align-self-end font-size-lg" role="tablist">
            <!--begin::Item-->
            <li class="nav-item">
                <Link href="/Dashboard" :class="{'active':$page.component=='Dashboard'}" class="nav-link py-4 px-6" data-toggle="tab" role="tab">Home</Link>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mr-3">
                <Link href="/Projects" :class="{'active':$page.component=='Project/Index'||$page.component=='Project/Create'||$page.component=='Project/Edit'}"  class="nav-link py-4 px-6 " data-toggle="tab" role="tab">Projects</Link>
            </li>
            <li class="nav-item mr-3">
                <Link :href="route('users.index')" :class="{'active':$page.component=='User/Index'||$page.component=='User/Create'||$page.component=='User/Edit'}"  class="nav-link py-4 px-6 " data-toggle="tab" role="tab">Users</Link>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mr-3">
                <Link :href="route('companies.index')" :class="{'active':$page.component=='Company/Index'||$page.component=='Company/Edit'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Companies</Link>
            </li>
            <li class="nav-item mr-3">
                <Link :href="route('bills.index')" :class="{'active':$page.component=='Bills/Index'||$page.component=='Bills/Create'||$page.component=='Bills/AddUserToBill'||$page.component=='Bills/AddExpensesToBill'||$page.component=='Bills/ShowBillTasks'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Bills</Link>
            </li>

            <li class="nav-item mr-3">
                <Link href="/logout" class="nav-link py-4 px-6" method="post" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Logout</link>
            </li>
            <!--end::Item-->
        </ul>
        <!--begin::Tab Navs-->
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {

    name: "Nav",
    components: {
        Link
    },
    props: {
        user: Object
    }
}
</script>

<style scoped>

</style>
