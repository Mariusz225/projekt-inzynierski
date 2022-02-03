export default {
    async loadProducts(context, payload) {
        console.log(payload.category)
        const response = await fetch(
            `/shopController/getProductsInShop/${payload.shopId}/${payload.category}/${payload.numberOfPagination}`
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
    },

    async loadCategories(context, payload) {
        const response = await fetch(
            `/shopController/getCategoriesInShop/${payload.shopId}`
        );

        const responseData = await response.json();

        if (!response.ok) {

        }

        const categories = [];

        for (const key in responseData) {
            const category = {
                id: responseData[key].id,
                name: responseData[key].name,
                parentCategory: responseData[key].parentCategory
            }
            categories.push(category);
        }

        // console.log(categories);

        context.commit('setCategories', categories)
    },
}