export default {
    async fetchAvailabilityOrderDate (context, payload) {
        const response = await fetch(`/shopController/getShopDatesAvailabilities`, {
            method: 'GET',
        });

        const responseData = await response.json();

        if (!response.ok) {
            console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }
        const dates = [];

        console.log(responseData)

        for (const key in responseData) {
            const date = {
                id: responseData[key].id,
                date: responseData[key].date,
            }
            dates.push(date);
        }

        context.commit('setDates', dates);
    },

    async fetchShops (context, payload) {
        const response = await fetch(`/shopController/getShops`, {
            method: 'GET',
        });

        const responseData = await response.json();

        if (!response.ok) {
            console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }
        const shops = [];


        for (const key in responseData) {
            const shop = {
                id: responseData[key].coordinates,
                date: responseData[key].address,
            }
            shops.push(shop);
        }

        context.commit('setShops', shops);
    },
}