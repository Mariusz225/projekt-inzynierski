import {createRouter, createWebHistory} from "vue-router";

import ShopsList from './pages/shop/ShopsList';
import LandingPage from './pages/landingPage/LandingPage';
// import ProductsList from './pages/shop/ProductsList';
import ProductsList from "./pages/products/ProductsList";
import StoreLocator from './pages/shop/StoreLocator';
import Cart from './pages/order/Cart';
import Checkout from './pages/order/Checkout';
import BaseShop from './pages/shop/BaseShop'
import Test from './tests/Test'
import LogIn from "./pages/auth/LogIn";
import Register from "./pages/auth/Register";
import Owner from "./pages/shopService/Owner";
import Shopkeeper from "./pages/shopService/Shopkeeper";
import Driver from "./pages/shopService/Driver";
import CompletingTheOrder from "./pages/shopService/CompletingTheOrder";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        // {path: '/', redirect: to => 'shop'},
        {path: '/', component: LandingPage,},
        {
            path: '/shop/:shopId',
            component: ProductsList,
            name:'shop',
            props: true
        },
        // {path: '/storeLocator', component: StoreLocator},
        {path: '/cart', component: Cart, name:'cart'},
        {path: '/checkout', component: Checkout, name:'checkout'},
        {path: '/shopsList', component: ShopsList},
        {path: '/login', component: LogIn},
        {path: '/register', component: Register},
        {
            path: '/service/:shopId/owner',
            component: Owner,
            name:'owner',
            props: true
        },
        {
            path: '/service/:shopId/shopkeeper',
            component: Shopkeeper,
            name:'shopkeeper',
            props: true,
        },
        {
            path: '/service/:shopId/driver',
            component: Driver,
            name:'driver',
            props: true,
        },
        {
            path: '/service/:shopId/completingTheOrder/:orderId',
            component: CompletingTheOrder,
            name: 'completingTheOrder',
            props: true
        },

        // {path: '/products', component: ProductsList}
        {path: '/test', component: Test},
    ]
});

export default router;
