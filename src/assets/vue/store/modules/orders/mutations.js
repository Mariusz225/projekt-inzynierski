export default {
    setOrders(state, payload) {
        state.orders = payload;
    },
    setOrderItems(state, payload) {
        // console.log(payload)
        state.orderItems = payload;
        // state.orderItems.push(payload)
        // state.orderItems[payload.id] = payload


    },
    setOrderInfo(state, payload) {
        // state.orderInfo = payload;
        console.log(payload)
    }
};