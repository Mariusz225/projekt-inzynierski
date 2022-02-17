export default {
    getOrders(state) {
        return state.orders
    },
    isImportant(_, getters, _2, rootGetters) {
        const orders = getters.getOrders;
        // console.log(orders)
        const userId = rootGetters.userId;
        return orders.some(coach => coach.id === userId);
    },
    getOrderItems(state) {
        return state.orderItems
    }
};