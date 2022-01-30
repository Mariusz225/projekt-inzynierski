export default {
    getStartedOrder(state) {
        return state.employeeStartedOrderId;
    },
    checkIfDriverHasStartedOrder(state) {
        return state.driverHasStartedOrder;
    }
};