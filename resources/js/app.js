import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import layout from "./Shared/Layout.vue";
import { router } from '@inertiajs/vue3'
import NProgress from 'nprogress'
createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
       if(pages.loyout === undefined){
            pages.layout = layout
        }



        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el)
    },
    progress: {
        delay: 250,
        color: '#29d',
        includeCSS: true,
        showSpinner: true,
    },
})


