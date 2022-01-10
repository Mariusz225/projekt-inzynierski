export default {

    async getOrdersFromTheStore(context, payload) {
        const response = await fetch(`/employeeController/getOrdersFromTheStore/${payload.shopId}`, {
            method: 'GET',
        });

        const responseData = await response.json();

        if (!response.ok) {
            console.log(responseData);
            const error = new Error(responseData.message || 'Failed to authenticate. Check your login data.');
            throw error;
        }

        console.log(responseData);
        context.commit('setOrders', {
            token: responseData.idToken,
            userId: responseData.localId,
            tokenExpiration: responseData.expiresIn
        });
    },
};