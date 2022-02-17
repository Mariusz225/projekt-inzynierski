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


        for (const key in responseData) {

            // var formatDate = new Date(responseData[key].date);
            const formatDate = new Intl.DateTimeFormat('pl-PL').format(new Date(responseData[key].date));

            // sqlDate.split("-");

            // console.log(sqlDate[0])

            const date = {
                id: responseData[key].id,
                date: formatDate,
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
            // console.log(responseData);
            throw new Error(responseData.message || 'Failed to authenticate. Check your login data.');
        }
        const shops = [];


        for (const key in responseData) {
            // console.log(responseData[key])
            const shop = {
                id: responseData[key].id,
                coordinates: [responseData[key].longitude, responseData[key].latitude],
                address: responseData[key].address,
            }
            shops.push(shop);
        }

        context.commit('setShops', shops);
    },

}