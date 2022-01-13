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

        console.log(responseData);

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
    async getDriverOrdersInShop (context, payload) {
        const response = await fetch(`/employeeController/getDriverOrdersInShop/${payload.shopId}`, {
            method: 'GET',
        });

        const responseData = await response.json();

        if (!response.ok) {
            console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }
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
    async fetchOrderProductsInfo(context, payload) {
        const response = await fetch(`/employeeController/getOrderProductsInfo/${payload.orderId}`, {
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
    },

    async fetchOrderInfo(context, payload) {
        const response = await fetch(`/employeeController/setCompletingEmployee/${payload.orderId}`, {
            method: 'GET',
        });

        const responseData = await response.json();


        if (!response.ok) {
            console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }

        context.commit('setOrderInfo', responseData);

    },

    async setOrderAsWaitingForDelivery(context, payload) {
        const response = await fetch(`/employeeController/setOrderAsWaitingForDelivery/${payload.orderId}`, {
            method: 'PUT',
        });

        if (!response.ok) {
            // error ...
        }
    },

    async submitOrder(context, payload) {

        const newRequest = {
            shippingAddressInputs: payload[0],
            deliveryDateId: payload[1]
        };

        const response = await fetch(`cartController/submitOrder`, {
            method: 'POST',
            body: JSON.stringify(newRequest)
        });

        const responseData = await response.json();

        if (!response.ok) {
            throw new Error(responseData.message || 'Failed to send request.');
        }


        // context.commit('submitOrder', responseData);
    }
};