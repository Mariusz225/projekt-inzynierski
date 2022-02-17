export default {
    getEmployeeInfo(state) {
        return state.employeeInfo;
    },
    getStartedOrder(state) {
        return state.employeeStartedOrderId;
    },
    checkIfDriverHasStartedOrder(state) {
        return state.driverHasStartedOrder;
    }
};