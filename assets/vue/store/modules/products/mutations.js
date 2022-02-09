export default {
    setProducts(state, payload) {
        state.products = payload;
    },

    setNumberOfProducts(state, payload) {
        state.numberOfProducts = payload;
    },

    setCategories(state, payload) {
        state.categories = payload;
    }
}