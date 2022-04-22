import products from "../products";

export default {
    async updateCart(context, payload) {
        // console.log(payload.productId)
        const newRequest = {
            productId: payload.productId,
            quantity: payload.quantity,
        };

        const localRequest = {
            productId: payload.productId,
            quantity: payload.quantity,
            product: payload.product,
            price: payload.product.price
        }

        const response = await fetch(`/cartController/updateCart`,{
            method: 'POST',
            body: JSON.stringify(newRequest)
        })

        const responseData = await response.json();


        if (!response.ok) {
            throw new Error(responseData.message || 'Failed to send request.');
        }

        context.commit('updateCart', localRequest)
        context.commit('setShopId', payload.shopId)


    },

    async downloadCart(context, payload) {
        const response = await fetch(
            `/cartController/downloadCart`
        );

        const responseData = await response.json();
        // responseData[key].productShop = undefined;

        // console.log(responseData)

        if (!response.ok) {

        }

        // console.log(responseData)

        const cartItems = [];
        let shopId = responseData[0].oneOrder.shop.id;


        for (const key in responseData) {

            console.log(responseData[key])
            const cartItem = {
                productId: responseData[key].product.id,
                // orderItemId: responseData[key].productShop.id,
                product: responseData[key].product,
                quantity: responseData[key].quantity,
                price: responseData[key].price,
                // xd: responseData[key].oneOrder,
            }
            cartItems.push(cartItem)
        }

        context.commit('setCartItems', cartItems)
        context.commit('setShopId', shopId)
    },

    async removeCart(context, payload) {
        const response = await fetch(
            `/cartController/removeShopFromCart`
        );

        const responseData = await response.json();

        if (!response.ok) {

        }

        context.commit('setShopId', null)
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

        context.commit('setShopId', null)

    }
}