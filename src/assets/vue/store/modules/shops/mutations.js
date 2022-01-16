export default {
    setDates(state, payload) {
        state.shopDatesAvailabilities = payload;
    },
    setShops(state, payload) {
        state.shops = payload
    }
};