<template>
    <Layout>
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Notice-->
                <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                    <div class="alert-icon">
										<span class="svg-icon svg-icon-primary svg-icon-xl">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Tools/Compass.svg-->
											<svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"></rect>
													<path
                                                        d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z"
                                                        fill="#000000" opacity="0.3"></path>
													<path
                                                        d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z"
                                                        fill="#000000" fill-rule="nonzero"></path>
												</g>
											</svg>
                                            <!--end::Svg Icon-->
										</span>
                    </div>
                    <div class="alert-text">The Users</div>
                </div>
                <!--end::Notice-->
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Users
                                <span class="text-muted pt-2 font-size-sm d-block"></span></h3>
                        </div>
                        <div class="card-toolbar">
                                                        <!--begin::Dropdown-->
                                                        <div class="dropdown dropdown-inline mr-2">

                                                        </div>
                                                        <!--end::Dropdown-->
                                                        <!--begin::Button-->
                                                        <Link :href="route('teams.create')"  class="btn btn-primary font-weight-bolder">
                            											<span class="svg-icon svg-icon-md">

                            												<svg xmlns="http://www.w3.org/2000/svg"  width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            														<rect x="0" y="0" width="24" height="24"></rect>
                            														<circle fill="#000000" cx="9" cy="15" r="6"></circle>
                            														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
                            													</g>
                            												</svg>

                            											</span>New Team</Link>

                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Search Form-->
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <div class="row align-items-center">
                                <div class="col-lg-9 col-xl-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="input-icon">
                                                <input v-model="search" type="text" class="form-control" placeholder="Search..."
                                                       >
                                                <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Search Form-->
                        <!--end: Search Form-->
                        <!--begin: Datatable-->
                        <div
                            class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded"
                            id="kt_datatable" style="">
                            <table class="datatable-table" style="display: block;">
                                <thead class="datatable-head">
                                <tr class="datatable-row" style="left: 0px;">


                                    <th data-field="OrderID" class="datatable-cell datatable-cell-sort text-center"><span
                                        style="width: 123px;">Name</span></th>
                                    <th data-field="Country" class="datatable-cell datatable-cell-sort text-center"><span
                                        style="width: 123px;">Manger</span></th>
                                    <th data-field="Country" class="datatable-cell datatable-cell-sort text-right"><span
                                        style="width: 90px;">Actions</span></th>


                                </tr>
                                </thead>
                                <tbody style="" class="datatable-body">
                                <tr v-for="user in users.data" class="datatable-row" style="left: 0px;">

                                    <td data-field="OrderID" aria-label="49288-0815" class="datatable-cell text-center"><span
                                        style="width: 123px;">{{ user.name }}</span></td>
                                    <td data-field="Country" aria-label="Paraguay" class="datatable-cell text-center"><span
                                        style="width: 123px;">{{ user.manager_name }}</span></td>
                                    <td data-field="Country" aria-label="Paraguay" class="datatable-cell text-center"><a
                                        @click.prevent="editUser(user)"
                                        style="width: 123px;"> <i class="fas fa-edit cursor-pointer"></i></a>
                                        <a
                                            @click.prevent="deleteUser(user)"
                                            style="width: 90px;" class="m-2"> <i class="fas fa-trash cursor-pointer"></i></a>
                                    </td>

                                </tr>

                                </tbody>
                            </table>
                            <div class="datatable-pager datatable-paging-loaded">
                                <ul class="datatable-pager-nav my-2 mb-sm-0">
                                    <Pagination :links="users.links" class="datatable-pager-link datatable-pager-link-number datatable-pager-link-active"></Pagination>
                                </ul>

                            </div>
                        </div>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
    </Layout>
</template>

<script>

import {Link} from "@inertiajs/vue3";

import Pagination from "../../Shared/Pagination.vue";
import Layout from "../../Shared/Layout.vue";
import sweetalert2 from "sweetalert2";
export default {
    name: "TeamsIndex",
    components: {Pagination, Layout, Link,sweetalert2},
    props:{
        users:Object,
        filters:Object
    },
    data() {
        return {
            search: this.filters.search || '',
        }
    },

    methods:{
        editUser(user){
            this.$inertia.visit(route('teams.edit',{'id':user.id}))
        },
        deleteUser(user){
            Swal.fire({
                title: 'Do you want to delete This Team?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Save',
                denyButtonText: `Don't save`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    this.$inertia.post(route('teams.destroy',{'id':user.id}));
                    Swal.fire(
                        'User deleted Successfully!',

                        'success'
                    )
                }
            })

        }
    },

    watch:{
        search(){
            this.$inertia.get('/Teams', {search: this.search}, {
                preserveState: true,
                preserveScroll: true,
            })
        }
    },


}
</script>

<style scoped>

</style>
