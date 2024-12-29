const state = {
    logs: null,
};

const getters = {
    logs: (state) => {
        return state.logs;
    },
};

const actions = {
    getLogs({ commit }) {
        axios.get("/api/log").then((res) => {
            commit("setLogs", res.data.data);
        });
    },
};

const mutations = {
    setLogs(state, logs) {
        state.logs = logs;
    },
};

export default {
    state,
    mutations,
    getters,
    actions,
};
