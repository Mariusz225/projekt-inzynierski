export default {

    async getEmployeeInfo(context, payload) {
        const response = await fetch('/employeeController/getEmployeeInfo', {
            method: 'GET',
        });

        const responseData = await response.json();

        if (!response.ok) {
            console.log(responseData);
            throw new Error(responseData.message || 'error');
        }

        console.log(responseData);
        context.commit('setEmployeeInfo', responseData);
    },

    async checkIfShopkeeperHasStartedOrder(context, payload) {
        const response = await fetch(`/employeeController/checkIfShopkeeperHasStartedOrder`, {
            method: 'GET',
        });

        const responseData = await response.json();

        console.log(responseData);

        if (!response.ok) {
            // console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }

        context.commit('setEmployeeHasStartedOrder', responseData);
    },

    async checkIfDriverHasStartedDelivery(context, payload) {
        const response = await fetch(`/employeeController/checkIfDriverHasStartedDelivery`, {
            method: 'GET',
        });

        const responseData = await response.json();

        console.log(responseData);

        if (!response.ok) {
            // console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }

        context.commit('setDriverHasStartedDelivery', responseData);
    },
};