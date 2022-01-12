import mutations from './mutations.js';
import actions from './actions.js';
import getters from './getters.js';

export default {
    namespaced: true,
    state() {
        return {
            // orders: [
            //     {
            //         orderId: '',
            //         orderItems: []
            //     }
            // ],
            // orders: [],
            orders: [],
            orderItems: []
        };
    },
    mutations,
    actions,
    getters
};