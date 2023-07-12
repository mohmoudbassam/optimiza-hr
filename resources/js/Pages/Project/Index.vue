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
                    <div class="alert-text">The Projects</div>
                </div>
                <!--end::Notice-->
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">Projects
                                <span class="text-muted pt-2 font-size-sm d-block"></span></h3>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Dropdown-->
                            <div class="dropdown dropdown-inline mr-2">
                                <!--                                                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                                <!--                            												<span class="svg-icon svg-icon-md">-->
                                <!--                            													&lt;!&ndash;begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg&ndash;&gt;-->
                                <!--                            													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">-->
                                <!--                            														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">-->
                                <!--                            															<rect x="0" y="0" width="24" height="24"></rect>-->
                                <!--                            															<path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"></path>-->
                                <!--                            															<path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"></path>-->
                                <!--                            														</g>-->
                                <!--                            													</svg>-->
                                <!--                                                                                &lt;!&ndash;end::Svg Icon&ndash;&gt;-->
                                <!--                            												</span>Export</button>-->
                                <!--begin::Dropdown Menu-->
                                <!--                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">-->
                                <!--                                                                &lt;!&ndash;begin::Navigation&ndash;&gt;-->
                                <!--                                                                <ul class="navi flex-column navi-hover py-2">-->
                                <!--                                                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>-->
                                <!--                                                                    <li class="navi-item">-->
                                <!--                                                                        <a href="#" class="navi-link">-->
                                <!--                            																<span class="navi-icon">-->
                                <!--                            																	<i class="la la-print"></i>-->
                                <!--                            																</span>-->
                                <!--                                                                            <span class="navi-text">Print</span>-->
                                <!--                                                                        </a>-->
                                <!--                                                                    </li>-->
                                <!--                                                                    <li class="navi-item">-->
                                <!--                                                                        <a href="#" class="navi-link">-->
                                <!--                            																<span class="navi-icon">-->
                                <!--                            																	<i class="la la-copy"></i>-->
                                <!--                            																</span>-->
                                <!--                                                                            <span class="navi-text">Copy</span>-->
                                <!--                                                                        </a>-->
                                <!--                                                                    </li>-->
                                <!--                                                                    <li class="navi-item">-->
                                <!--                                                                        <a href="#" class="navi-link">-->
                                <!--                            																<span class="navi-icon">-->
                                <!--                            																	<i class="la la-file-excel-o"></i>-->
                                <!--                            																</span>-->
                                <!--                                                                            <span class="navi-text">Excel</span>-->
                                <!--                                                                        </a>-->
                                <!--                                                                    </li>-->
                                <!--                                                                    <li class="navi-item">-->
                                <!--                                                                        <a href="#" class="navi-link">-->
                                <!--                            																<span class="navi-icon">-->
                                <!--                            																	<i class="la la-file-text-o"></i>-->
                                <!--                            																</span>-->
                                <!--                                                                            <span class="navi-text">CSV</span>-->
                                <!--                                                                        </a>-->
                                <!--                                                                    </li>-->
                                <!--                                                                    <li class="navi-item">-->
                                <!--                                                                        <a href="#" class="navi-link">-->
                                <!--                            																<span class="navi-icon">-->
                                <!--                            																	<i class="la la-file-pdf-o"></i>-->
                                <!--                            																</span>-->
                                <!--                                                                            <span class="navi-text">PDF</span>-->
                                <!--                                                                        </a>-->
                                <!--                                                                    </li>-->
                                <!--                                                                </ul>-->
                                <!--                                                                &lt;!&ndash;end::Navigation&ndash;&gt;-->
                                <!--                                                            </div>-->
                                <!--end::Dropdown Menu-->
                            </div>
                            <!--end::Dropdown-->
                            <!--begin::Button-->
                            <Link :href="route('projects.create')"  class="btn btn-primary font-weight-bolder">
                            											<span class="svg-icon svg-icon-md">

                            												<svg xmlns="http://www.w3.org/2000/svg"  width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            														<rect x="0" y="0" width="24" height="24"></rect>
                            														<circle fill="#000000" cx="9" cy="15" r="6"></circle>
                            														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
                            													</g>
                            												</svg>

                            											</span>New Project</Link>

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
                                                <input  v-model="search" type="text" class="form-control" placeholder="Search..."
                                                       id="kt_datatable_search_query">
                                                <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="d-flex align-items-center">
                                                <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                                <div class="dropdown bootstrap-select form-control"><select
                                                    class="form-control" id="kt_datatable_search_status"
                                                    tabindex="null">
                                                    <option value="">All</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Delivered</option>
                                                    <option value="3">Canceled</option>
                                                    <option value="4">Success</option>
                                                    <option value="5">Info</option>
                                                    <option value="6">Danger</option>
                                                </select>
                                                    <button type="button" tabindex="-1"
                                                            class="btn dropdown-toggle btn-light bs-placeholder"
                                                            data-toggle="dropdown" role="combobox"
                                                            aria-owns="bs-select-1" aria-haspopup="listbox"
                                                            aria-expanded="false" data-id="kt_datatable_search_status"
                                                            title="All">
                                                        <div class="filter-option">
                                                            <div class="filter-option-inner">
                                                                <div class="filter-option-inner-inner">All</div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <div class="dropdown-menu"
                                                         style="max-height: 787.2px; overflow: hidden; min-height: 127px;">
                                                        <div class="inner show" role="listbox" id="bs-select-1"
                                                             tabindex="-1" aria-activedescendant="bs-select-1-0"
                                                             style="max-height: 775.2px; overflow-y: auto; min-height: 115px;">
                                                            <ul class="dropdown-menu inner show" role="presentation"
                                                                style="margin-top: 0px; margin-bottom: 0px;">
                                                                <li class="selected active"><a role="option"
                                                                                               class="dropdown-item active selected"
                                                                                               id="bs-select-1-0"
                                                                                               tabindex="0"
                                                                                               aria-setsize="7"
                                                                                               aria-posinset="1"
                                                                                               aria-selected="true"><span
                                                                    class="text">All</span></a></li>
                                                                <li><a role="option" class="dropdown-item"
                                                                       id="bs-select-1-1" tabindex="0" aria-setsize="7"
                                                                       aria-posinset="2"><span
                                                                    class="text">Pending</span></a></li>
                                                                <li><a role="option" class="dropdown-item"
                                                                       id="bs-select-1-2" tabindex="0"><span
                                                                    class="text">Delivered</span></a></li>
                                                                <li><a role="option" class="dropdown-item"
                                                                       id="bs-select-1-3" tabindex="0"><span
                                                                    class="text">Canceled</span></a></li>
                                                                <li><a role="option" class="dropdown-item"
                                                                       id="bs-select-1-4" tabindex="0"><span
                                                                    class="text">Success</span></a></li>
                                                                <li><a role="option" class="dropdown-item"
                                                                       id="bs-select-1-5" tabindex="0"><span
                                                                    class="text">Info</span></a></li>
                                                                <li><a role="option" class="dropdown-item"
                                                                       id="bs-select-1-6" tabindex="0"><span
                                                                    class="text">Danger</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 my-2 my-md-0">
                                            <div class="d-flex align-items-center">
                                                <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                                <div class="dropdown bootstrap-select form-control"><select
                                                    class="form-control" id="kt_datatable_search_type">
                                                    <option value="">All</option>
                                                    <option value="1">Online</option>
                                                    <option value="2">Retail</option>
                                                    <option value="3">Direct</option>
                                                </select>
                                                    <button type="button" tabindex="-1"
                                                            class="btn dropdown-toggle btn-light bs-placeholder"
                                                            data-toggle="dropdown" role="combobox"
                                                            aria-owns="bs-select-2" aria-haspopup="listbox"
                                                            aria-expanded="false" data-id="kt_datatable_search_type"
                                                            title="All">
                                                        <div class="filter-option">
                                                            <div class="filter-option-inner">
                                                                <div class="filter-option-inner-inner">All</div>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <div class="dropdown-menu ">
                                                        <div class="inner show" role="listbox" id="bs-select-2"
                                                             tabindex="-1">
                                                            <ul class="dropdown-menu inner show"
                                                                role="presentation"></ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                    <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
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
                                    <th data-field="OrderID" class="datatable-cell datatable-cell-sort"><span
                                        style="width: 123px;">Name</span></th>
                                    <th data-field="Country" class="datatable-cell datatable-cell-sort"><span
                                        style="width: 123px;">Company</span></th>
                                    <th data-field="Country" class="datatable-cell datatable-cell-sort"><span
                                        style="width: 123px;">Actions</span></th>
                                </tr>
                                </thead>
                                <tbody style="" class="datatable-body">
                                <tr v-for="project in projects.data" class="datatable-row" style="left: 0px;">

                                    <td data-field="OrderID" aria-label="49288-0815" class="datatable-cell"><span
                                        style="width: 123px;">{{ project.name }}</span></td>
                                    <td data-field="Country" aria-label="Paraguay" class="datatable-cell"><span
                                        style="width: 123px;">{{ project.company_name }}</span></td>
                                    <td data-field="Country" aria-label="Paraguay" class="datatable-cell text-center"><a
                                        @click.prevent="editProject(project)"
                                        style="width: 123px;"> <i class="fas fa-edit"></i></a>
                                        <a
                                            @click.prevent="deleteProject(project)"
                                            style="width: 90px;" class="m-2"> <i class="fas fa-trash"></i></a>
                                    </td>

                                </tr>

                                </tbody>
                            </table>
                            <div class="datatable-pager datatable-paging-loaded">
                                <ul class="datatable-pager-nav my-2 mb-sm-0">

                                 <Pagination :links="projects.links" class="datatable-pager-link datatable-pager-link-number datatable-pager-link-active"></Pagination>

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
import Layout from "@/Shared/Layout.vue";
import {Link} from "@inertiajs/vue3";
import Pagination from "../../Shared/Pagination.vue";
export default {
    name: "index",
    components: {Pagination, Layout, Link},
    props:{
        projects:Object,
        filters:Object
    },
    data() {
        return {
            search: this.filters.search ?? '',
        }
    },
    methods: {
        editProject(project) {
            this.$inertia.visit(route('projects.edit',{'id':project.id}))
        },
        deleteProject(user) {
            this.$inertia.visit(`/users/${user.id}/delete`)
        },
    },
    watch:{
        search(){
            this.$inertia.get(route('projects.index'), {search: this.search}, {
                preserveState: true,
                preserveScroll: true,
            })
        }
    },
}
</script>

<style scoped>

</style>
