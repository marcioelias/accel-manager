import Vue from 'vue';
import Vuex from 'vuex';
import Axios from 'axios';
import { VALID_MUTATIONS } from '../constants';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        sessions: [],
        columns: [],
        sortBy: 'ifname',
        sortType: 'text',
        sortAsc: true,
        filterBy: 'username',
        filterValue: '',
        graph: false,
        loading: false
    },
    getters: {
        getSessionByUsername: state => username =>  {
            return state.sessions.find(session => session.username === username);
        },
        getSessionByIp: state => ip => {
            return state.sessions.find(session => session.ip === ip);
        },
        getSessionIndex: state => session => {
            return state.sessions.indexOf(session);
        },
        getVisibleColumns: state => {
            return state.columns.filter(column => column.visible == true);
        },
        getColumnByName: state => name => {
            return state.columns.find(column => column.column == name);
        },
        filteredSessions: state => {
            if (state.filterValue.length > 1) {
                return state.sessions.filter(q => {
                    return q[state.filterBy].toLowerCase().includes(state.filterValue.toLowerCase());
                });
            } else {
                return state.sessions;
            } 
        },
        sortedSessions: (state, getters)  => {
            let compareIPv4 = (a, b) => {
                const num1 = Number(a.split(".").map((num) => (`000${num}`).slice(-3) ).join(""));
                const num2 = Number(b.split(".").map((num) => (`000${num}`).slice(-3) ).join(""));
                return num1-num2;
            }
            let compareText = (a, b) => {
                return (''+a).localeCompare(b);
            }
            let compareNumber = (a, b) => {
                return a - b;
            }
            let sortData = (a, b) => {
                switch (state.sortType) {
                    case "text":
                        return compareText(a[state.sortBy], b[state.sortBy]);
                        break;
                    case "number":
                        return compareNumber(a[state.sortBy], b[state.sortBy]);
                        break;
                    case "ipv4":
                        return compareIPv4(a[state.sortBy], b[state.sortBy])
                        break;
                }
            }
            if (state.sortAsc) {
                return getters.filteredSessions.sort((a, b) => {
                    return sortData(a, b);
                });
            } else {
                return getters.filteredSessions.reverse((a, b) => {
                    return sortData(a, b);
                })
            }
        },
    },
    actions: {
        apiGetSessions({commit}) {
            commit(VALID_MUTATIONS.LOADING, true);
            Axios.get('/sessions/json')
                .then(async r => {
                    commit(VALID_MUTATIONS.SET_SESSIONS, r.data);
                    commit(VALID_MUTATIONS.LOADING, false);
                })
                .catch(r => {
                    commit(VALID_MUTATIONS.LOADING, false);
                    console.log(r);
                });
        },
        apiGetColumns({commit}) {
            Axios.get('/sessions/columns')
                .then(async r => {
                    commit(VALID_MUTATIONS.SET_SESSIONS_COLUMNS, r.data);
                })
                .catch(r => {
                    console.log(r);
                });
        },
        getInterfaceStats({commit}, ifname) {
            Axios.get('/interface/'+ifname+'/json')
                .then(async r => {
                    commit(VALID_MUTATIONS.SET_SESSIONS_COLUMNS, r.data);
                })
                .catch(r => {
                    console.log(r);
                });
        },
        apiDropSession({commit}, session) {
            Axios.post('/session/drop', {ifname: session.ifname})
                .then(r => {
                    if (r.data) {
                        commit(VALID_MUTATIONS.DELETE_SESSION, session);
                    }
                })
                .catch(r => {
                    console.log(r);
                })
        },
        apiChangeQueue({}, queue) {
            Axios.post('/session/queue', queue)
                .then(r => {
                    if (r.data) {
                        return r.data;
                    }
                })
                .catch(r => {
                    console.log(r);
                })
        },
        apiResetQueue({}, queue) {
            Axios.post('/session/queue/reset', queue)
                .then(r => {
                    if (r.data) {
                        return r.data;
                    }
                })
                .catch(r => {
                    console.log(r);
                })
        },
        sortIPv4Address(a, b) {
            const num1 = Number(a.split(".").map((num) => (`000${num}`).slice(-3) ).join(""));
            const num2 = Number(b.split(".").map((num) => (`000${num}`).slice(-3) ).join(""));
            return num1-num2;
        },
    },
    mutations: {
        [VALID_MUTATIONS.SET_SESSIONS](state, sessions) {
            state.sessions = sessions;
        },
        [VALID_MUTATIONS.SET_SESSIONS_COLUMNS](state, columns) {
            state.columns = columns;
        },
        [VALID_MUTATIONS.SET_SESSIONS_SORT_BY](state, sortBy) {
            state.sortBy = sortBy;
        },
        [VALID_MUTATIONS.SET_SESSIONS_SORT_ASC](state, sortAsc) {
            state.sortAsc = sortAsc;
        },
        [VALID_MUTATIONS.SET_SESSIONS_SORT_TYPE](state, sortType) {
            state.sortType = sortType;
        },
        [VALID_MUTATIONS.SET_SESSIONS_FILTER_BY](state, filterBy) {
            state.filterBy = filterBy;
        },
        [VALID_MUTATIONS.SET_SESSIONS_FILTER_VALUE](state, filterValue) {
            state.filterValue = filterValue;
        },
        [VALID_MUTATIONS.SET_GRAPH](state, graph) {
            state.graph = graph;
        },
        [VALID_MUTATIONS.DELETE_SESSION](state, session) {
            let idx = state.sessions.findIndex(s => s.ifname == session.ifname);
            state.sessions.splice(idx, 1);
        },
        [VALID_MUTATIONS.LOADING](state, loading) {
            state.loading = loading;
        }
    }
});