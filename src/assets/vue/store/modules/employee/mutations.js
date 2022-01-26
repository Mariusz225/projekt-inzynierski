export default {
    setEmployee(state, payload) {
        state.token = payload.token;
        state.userId = payload.userId;
        state.tokenExpiration = payload.tokenExpiration;
    },
    setEmployeeHasStartedOrder(state, payload) {
        state.employeeStartedOrderId = payload;
    }
};