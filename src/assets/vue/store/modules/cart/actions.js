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
            price: payload.price
        }

        const response = await fetch(`/cartController/updateCart`,{
            method: 'POST',
            body: JSON.stringify(newRequest)
        })

        const responseData = await response.json();


        if (!response.ok) {
            throw new Error(responseData.message || 'Failed to send request.');
        }


        // console.log(String(responseData.error))

        if (String(responseData.message) === 'badViewedShop') {
            // console.log('sss')
            context.commit('badViewedShop', true)
        } else if (String(responseData.message) === 'cartIsEmpty') {
            // context.commit('badViewedShop', null)

            console.log('s')
            context.commit('updateCart', localRequest)

            context.commit('removeCart');
            // context.commit('badViewedShop', null)


        } else {
            context.commit('badViewedShop', false)
            context.commit('updateCart', localRequest)
        }

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
        let shopId = responseData[0].oneOrder.shop.id;


        for (const key in responseData) {
            const cartItem = {
                productId: responseData[key].productShop.id,
                // orderItemId: responseData[key].productShop.id,
                product: responseData[key].productShop.products,
                quantity: responseData[key].quantity,
                price: responseData[key].productShop.price,
                // xd: responseData[key].oneOrder,
            }
            cartItems.push(cartItem)
        }

        // console.log(shopId)

        context.commit('setCartItems', cartItems)
        context.commit('setViewedShopId', shopId)
    },

    async removeCart(context, payload) {
        const response = await fetch(
            `/cartController/removeShopFromCart`
        );

        const responseData = await response.json();
        // responseData[key].productShop = undefined;

        // console.log(responseData)

        if (!response.ok) {

        }

        // console.log(shopId)

        // context.commit('setCartItems', cartItems)
        context.commit('setViewedShopId', null)
    },
}