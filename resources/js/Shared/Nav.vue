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
            <li class="nav-item" v-if="$page.props.user.is_admin">
                <Link href="/Dashboard" :class="{'active':$page.component=='Dashboard'}" class="nav-link py-4 px-6" data-toggle="tab" role="tab">Home</Link>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mr-3" v-if="$page.props.user.is_admin">
                <Link href="/Projects" :class="{'active':$page.component=='Project/Index'||$page.component=='Project/Create'||$page.component=='Project/Edit'}"  class="nav-link py-4 px-6 " data-toggle="tab" role="tab">Projects</Link>
            </li>
            <li class="nav-item mr-3" v-if="$page.props.user.is_admin">
                <Link :href="route('users.index')" :class="{'active':$page.component=='User/Index'||$page.component=='User/Create'||$page.component=='User/Edit'}"  class="nav-link py-4 px-6 " data-toggle="tab" role="tab">Users</Link>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="nav-item mr-3" v-if="$page.props.user.is_admin">
                <Link :href="route('companies.index')" :class="{'active':$page.component=='Company/Index'||$page.component=='Company/Edit'||$page.component=='Company/Create'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Companies</Link>
            </li>
            <li class="nav-item mr-3" v-if="$page.props.user.is_admin">
                <Link :href="route('bills.index')" :class="{'active':$page.component=='Bills/Index'||$page.component=='Bills/Create'||$page.component=='Bills/AddUserToBill'||$page.component=='Bills/AddExpensesToBill'||$page.component=='Bills/ShowBillTasks'||$page.component=='Bills/Summary'||$page.component=='Bills/showBillTasks'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Bills</Link>
            </li>

            <li class="nav-item mr-3" v-if="$page.props.user.is_admin==0">
                <Link :href="route('tasks.months')" :class="{'active':$page.component=='Team/Months' || $page.component=='Team/MyTasks'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">My Tasks</Link>
            </li>
            <li class="nav-item mr-3" v-if="$page.props.user.is_admin==1">
                <Link :href="route('main_expenses.index')" :class="{'active':$page.component=='Team/Months' || $page.component=='Team/MyTasks'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Expenses
                </Link>
            </li>
            <li class="nav-item mr-3" v-if="$page.props.user.is_admin==1">
                <Link :href="route('reports.index')" :class="{'active':$page.component=='Report' || $page.component=='Report'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Report
                </Link>
            </li>
<!--            <li class="nav-item mr-3" v-if="$page.props.user.is_admin==1">-->
<!--                <Link :href="route('teams.index')" :class="{'active':$page.component=='Teams/Index'}" class="nav-link py-4 px-6" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">Teams-->
<!--                </Link>-->
<!--            </li>-->
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
    },
    mounted() {
        console.log(this.$page.props.user)
    }


}
</script>

<style scoped>

</style>
