<template>

    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header flex-column header-fixed">
                    <!--begin::Top-->
                    <div class="header-top">
                        <!--begin::Container-->
                        <div class="container">
                           <Nav></Nav>
                            <div class="topbar bg-primary">

                                <div class="topbar-item">
                                    <div class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                        <div class="d-flex flex-column text-right pr-sm-3">
                                            <span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">{{ user.name }}</span>
                                            <span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">{{user.email}}</span>
                                        </div>
                                        <span class="symbol symbol-35">
												<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30"></span>
											</span>
                                    </div>
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Topbar-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Top-->
                    <!--begin::Bottom-->
                    <div class="header-bottom">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Header Menu Wrapper-->

                            <!--end::Header Menu Wrapper-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Bottom-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                          <slot></slot>
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->

                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>

    </div>
</template>

<script>
import MobileNav from "./MobileNav.vue";
import Nav from "./Nav.vue";
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
export default {
    name: "Layout",
    components: {
        Nav,
        MobileNav
    },
    setup() {
        const { props } = usePage()
        const user = computed(() => props.user)
        return {
            user
        }
    }
}
</script>

<style scoped>

</style>
