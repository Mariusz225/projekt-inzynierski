import {createRouter, createWebHistory} from "vue-router";

import ShopsList from './pages/shop/ShopsList';
// import ProductsList from './pages/shop/ProductsList';
import ProductsList from "./pages/products/ProductsList";
import StoreLocator from './pages/shop/StoreLocator';
import Cart from './pages/order/Cart';
import Checkout from './pages/order/Checkout';
import BaseShop from './pages/shop/BaseShop'
import Test from './tests/Test'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', redirect: to => 'shop'},
        {
            path: '/shop/:shopId',
            component: ProductsList,
            name:'shop',
            props: true
        },
        {path: '/storeLocator', component: StoreLocator},
        {path: '/cart', component: Cart, name:'cart'},
        {path: '/checkout', component: Checkout, name:'checkout'},
        {path: '/shopsList', component: ShopsList},
        // {path: '/products', component: ProductsList}
        {path: '/test', component: Test},
    ]
});

export default router;
