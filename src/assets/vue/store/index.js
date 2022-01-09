import { createStore } from 'vuex';

import shopsModule from './modules/shops/index.js'
import productsModule from './modules/products/index.js'
import cartModule from './modules/cart/index.js'
import Auth from "./modules/auth";

const store = createStore({
    modules: {
        auth: Auth,
        shops: shopsModule,
        products: productsModule,
        cart: cartModule
    },
    // state() {
    //     return {
    //         userId: '1'
    //     }
    // },
    // getters: {
    //     userId(state) {
    //         return state.userId;
    //     }
    // }
})

export default store;