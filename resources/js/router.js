import Vue from "vue";
import VueRouter from "vue-router";
import LeadComponent from "./components/LeadComponent.vue";
import ContactFormComponent from "./components/ContactFormComponent.vue";
import LogComponent from "./components/LogComponent.vue";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        {
            name: "main",
            path: "/",
            component: LeadComponent,
        },
        {
            name: "logs",
            path: "/logs",
            component: LogComponent,
        },
        {
            name: "contact.add.lead",
            path: "/contact/add/:lead_id",
            component: ContactFormComponent,
        },
    ],
});
