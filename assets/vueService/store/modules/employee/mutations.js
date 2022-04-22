export default {
    setEmployeeInfo(state, payload) {
        state.employeeInfo = payload;
        // state.tokenExpiration = payload.tokenExpiration;
    },
    setEmployeeHasStartedOrder(state, payload) {
        state.employeeStartedOrderId = payload;
    },
    setDriverHasStartedDelivery(state, payload) {
        state.driverHasStartedOrder = payload;
    },
    logout(state) {
        Object.assign(state, null)
    }
};