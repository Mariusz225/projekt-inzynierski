export default {
    async loadProducts(context, payload) {
        const response = await fetch(
            `/shopController/getProductsInShop/${payload.shopId}/${payload.categoryName}/${payload.numberOfPagination}`
        );

        const responseData = await response.json();

        if (!response.ok) {

        }

        if (responseData !== false) {
            const products = [];

            for (const key in responseData) {
                const product = {
                    id: responseData[key].id,
                    name: responseData[key].name,
                    price: responseData[key].price
                }
                products.push(product);
            }

            context.commit('setProducts', products)
        } else return(0);


    },
    async loadNumberOfProducts(context, payload) {
        const response = await fetch(
            `/shopController/getNumberOfProductsInShop/${payload.shopId}`
        );

        const responseData = await response.json();

        // console.log(responseData);

        context.commit('setNumberOfProducts', responseData)
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