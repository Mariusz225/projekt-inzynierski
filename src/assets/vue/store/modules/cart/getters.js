export default {
    getShopId(state) {
        return state.shopId
    },
    isCart(state) {
        return state.cartItems && state.cartItems.length > 0
    },
    cartItems(state) {
        return state.cartItems
    },
    getCartItemById: (state) => (id) => {
        return state.cartItems.find(cartItem => cartItem.productId === id)
    },
    cartTotal(state, getters) {
        // let total = 0;
        // getters.cartItems.forEach(product => {
        //     total += product.price * product.quantity
        // })
        // return total;
        return getters.cartItems.reduce((total, product) => total + product.price * product.quantity, 0)
    },
    badViewedShop(state) {
        return state.badViewedShop
    }
}