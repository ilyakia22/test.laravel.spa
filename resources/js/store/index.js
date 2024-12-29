import Vue from "vue";
import Vuex from "vuex";
import Lead from "./modules/lead";
import Log from "./modules/log";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Lead,
        Log,
    },
});
