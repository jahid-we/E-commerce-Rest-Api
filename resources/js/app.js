import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import NProgress from 'nprogress'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.css'
import 'nprogress/nprogress.css' // Default styles
import './assets/nprogress.css'  // Your custom styles

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el)
    },
})


// ✅ Correct way to track Inertia navigation events
// router.on('before', ({ detail }) => {
//     if (!confirm('Are you sure you want to navigate?')) {
//         detail.preventDefault()
//     }
// })

router.on('start', () => {
    NProgress.start()
})

router.on('finish', () => {
    NProgress.done()
})

// router.on('navigate', (event) => {
//     console.log(`Navigating to ${event.detail.page.url}`)
// })
// router.on('exception', (event) => {
//     console.log("An Unexpected error occurred During Inertia Visit")
//     console.log(event.detail.error)
// })

