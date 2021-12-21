import axios from "axios";

export default {
    async loadProducts(context, payload) {
        const response = await fetch(
            `/shopController/getProductsInShop/${payload.shopId}`
        );

        const responseData = await response.json();

        if (!response.ok) {

        }

        const products = [];

        for (const key in responseData) {
            const product = {
                id: responseData[key].id,
                name: responseData[key].products.name,
                price: responseData[key].price
            }
            products.push(product);
        }

        context.commit('setProducts', products)
    }
}