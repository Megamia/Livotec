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
      component: () => import("../views/LoginPage.vue"),
    },
    {
      path: "/register",
      name: "register",
      component: () => import("../views/RegisterPage.vue"),
    },
    {
      path: "/product/:slug",
      name: "productdetail",
      component: () => import("../views/ProductDetail.vue"),
    },
    {
      path: "/test",
      name: "test",
      component: () => import("../views/TestPage.vue"),
    },
    {
      path: "/nav",
      name: "nav",
      component: () => import("../components/NavProduct.vue"),
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
      path: "/so-sanh-san-pham",
      name: "CompareProducts",
      component: () => import("../views/CompareProducts.vue"),
    },
  ],
});

export default router;
