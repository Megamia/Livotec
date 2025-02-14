import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: () => import("../views/HomePage.vue"),
    },
    {
      path: "/login",
      name: "login",
      component: () => import("../views/LoginSignupPage.vue"),
    },
    {
      path: "/product/:slug",
      name: "productdetail",
      component: () => import("../views/ProductDetail.vue"),
    },
    {
      path: "/category/:slug",
      name: "category",
      component: () => import("../views/CategoryPage.vue"),
    },
    {
      path: "/test",
      name: "test",
      component: () => import("../views/TestPage.vue"),
    },
    {
      path: "/nav",
      name: "nav",
      component: () => import("../components/NavProductComponent.vue"),
    },
    {
      path: "/menu",
      name: "menu",
      component: () => import("../components/MenuComponent.vue"),
    },
    {
      path: "/slide",
      name: "slide",
      component: () => import("../components/HomeHeroSlideComponent.vue"),
    },
    {
      path: "/compareProducts",
      name: "compareProducts",
      component: () => import("../views/CompareProducts.vue"),
    },
    {
      path: "/payment",
      name: "payment",
      component: () => import("../views/PaymentPage.vue"),
    },
    {
      path: "/cart",
      name: "cart",
      component: () => import("../views/CartPage.vue"),
    },
    {
      path: "/guaranteeHome",
      name: "guaranteeHome",
      component: () => import("../views/GuaranteeHomePage.vue"),
    },
  ],
  scrollBehavior(to, from, savedPosition) {
    return { top: 0, behavior: "smooth" }; 
  },
});

export default router;
