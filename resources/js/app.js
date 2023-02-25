import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import layout from "./Shared/Layout.vue";

import 'vuetify/styles'

import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/bootstrap4-light-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';

const vuetify = createVuetify({
    components,
    directives,
    ssr: true,
})
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
            .use(vuetify)
            .use(PrimeVue)
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


