import products from "../products";

export default {
    async updateCart(context, payload) {
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

        const responseData = await response;



        if (!response.ok) {
            throw new Error(responseData.message || 'Failed to send request.');
        }

        context.commit('updateCart', localRequest)
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

        const cartItems = [];

        for (const key in responseData) {

            const cartItem = {
                productId: responseData[key].productShop.id,
                // orderItemId: responseData[key].productShop.id,
                product: responseData[key].productShop.products,
                quantity: responseData[key].quantity,
                price: responseData[key].productShop.price,
            }

            cartItems.push(cartItem)
        }

        // context.commit('setCartItems', cartItems)
        context.commit('setCartItems', cartItems)
    },

    setViewedShop(context, payload) {
        const shopId = payload.shopId;
        context.commit('setViewedShop', shopId)
    }
}