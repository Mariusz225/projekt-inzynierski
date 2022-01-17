export default {
    shops(state) {
        return state.shops;
    },
    areShopsFetched(state) {
        return state.shops && state.shops.length > 0
    },
    getShopDatesAvailabilities(state) {
        return state.shopDatesAvailabilities
    }
}