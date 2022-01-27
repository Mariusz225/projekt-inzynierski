import {createRouter, createWebHistory} from "vue-router";

import LandingPage from './pages/landingPage/LandingPage';
import Shop from "./pages/shop/Shop";
import Cart from './pages/order/Cart';
import Checkout from './pages/order/Checkout';
import Test from './tests/Test'
import LogIn from "./pages/auth/LogIn";
import Register from "./pages/auth/Register";
import Owner from "./pages/shopService/Owner";
import Shopkeeper from "./pages/shopService/Shopkeeper";
import Driver from "./pages/shopService/Driver";
import CompletingTheOrder from "./pages/shopService/CompletingTheOrder";
import DeliveryOfTheOrder from "./pages/shopService/DeliveryOfTheOrder";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', component: LandingPage,},
        {
            path: '/:shopId',
            component: Shop,
            name:'shop',
            props: true
        },
        {path: '/cart', component: Cart, name:'cart'},
        {path: '/checkout', component: Checkout, name:'checkout'},
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
        {
            path: '/service/:shopId/deliveryOfTheOrder/',
            component: DeliveryOfTheOrder,
            name: 'deliveryOfTheOrder',
            props: true
        },

        {path: '/test', component: Test},
    ]
});

export default router;
