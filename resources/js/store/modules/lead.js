const state = {
    leads: null,
};

const getters = {
    leads: (state) => {
        return state.leads;
    },
};

const actions = {
    getLeads({ state, commit, dispatch }) {
        axios.get("/api/lead").then((res) => {
            commit("setLeads", res.data.data);
        });
    },
};

const mutations = {
    setLeads(state, leads) {
        state.leads = leads;
    },
};

export default {
    state,
    mutations,
    getters,
    actions,
};
