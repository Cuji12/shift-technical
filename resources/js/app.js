import './bootstrap';
import { createApp } from "vue";

import App from "./App.vue";
import router from "./router.js";


router.beforeEach(async (to, from, next) => {
    const requiresAuth = to.meta.requiresAuth
    const guestOnly = to.meta.guestOnly

    let user = null

    try {
        const res = await axios.get('/api/user')
        console.log(res.data)
        user = res.data
    } catch {
        user = null
    }

    if (requiresAuth && !user) {
        return next({ name: 'login' })
    }

    if (guestOnly && user) {
        return next({ name: 'home' })
    }

    return next()
})

createApp(App).use(router).mount("#app");
