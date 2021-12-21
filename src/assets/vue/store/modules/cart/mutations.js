export default {
    updateCart(state, payload) {
        if (state.cartItems.some(e => e.productId === payload.productId)) {
            let objIndex = state.cartItems.findIndex((obj => obj.productId === payload.productId));

            if (payload.quantity <= 0) {
                state.cartItems.splice(objIndex, 1);

            } else {
                state.cartItems[objIndex].quantity = payload.quantity;
            }
        } else {
            state.cartItems.push(payload)
        }
    },

    setCartItems(state, payload) {
        // console.log(payload.product)
        state.cartItems = payload;
    }
}