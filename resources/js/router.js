import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/login",
        name: "login",
        component: () => import("./Pages/Auth/Login.vue"),
        meta: { guestOnly: true }
    },
    {
        path: "/register",
        name: "register",
        component: () => import("./Pages/Auth/Register.vue"),
        meta: { guestOnly: true }
    },
    {
        path: "/forgot-password",
        name: "forgot-password",
        component: () => import("./Pages/Auth/ForgotPassword.vue"),
        meta: { guestOnly: true }
    },
    {
        path: "/reset-password/:token",
        name: "reset-password",
        component: () => import("./Pages/Auth/ResetPassword.vue"),
        meta: { guestOnly: true }
    },
    {
        path: "/email/verify",
        name: "verify-email",
        component: () => import("./Pages/Auth/VerifyEmail.vue"),
    },
    {
        path: "/email/verify/:id/:hash",
        name: "email-verified",
        component: () => import("./Pages/Auth/EmailVerified.vue")
    },
    {
        path: "/",
        name: "home",
        component: () => import("./Pages/Home.vue"),
        meta: { requiresAuth: true }
    },
    {
        path: "/:pathMatch(.*)*",
        redirect: "/"
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
