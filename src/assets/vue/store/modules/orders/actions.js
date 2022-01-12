export default {

    async getOrdersFromTheStore(context, payload) {
        const response = await fetch(`/employeeController/getOrdersFromTheStore/${payload.shopId}`, {
            method: 'GET',
        });

        const responseData = await response.json();

        if (!response.ok) {
            console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }

        // console.log(responseData);

        const orders = [];

        for (const key in responseData) {
            const order = {
                id: responseData[key].id,
                date: responseData[key].date,
            }
            orders.push(order);
        }

        context.commit('setOrders', orders);
    },
    async fetchOrderInfo(context, payload) {
        const response = await fetch(`/employeeController/getOrderInfo/${payload.orderId}`, {
            method: 'GET',
        });

        const responseData = await response.json();


        if (!response.ok) {
            console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }



        // console.log(responseData)
        //
        // const orderItems = [];
        //
        // for (const key in responseData) {
        //     console.log(responseData[key])
        //     const orderItem = {
        //         id: responseData[key].id,
        //         date: responseData[key].date,
        //     }
        //     orderItems.push(orderItem);
        // }

        context.commit('setOrderItems', responseData);
        // context.commit('setOrderItems', {
        //     ...responseData,
        //     // id: payload.orderId
        // });
    }
};