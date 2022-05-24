import {createRouter, createWebHistory} from "vue-router";
import ServiceModule from "./pages/Service";
import ShopkeeperModule from "./pages/shopkeeper/Shopkeeper";
import DriverModule from "./pages/driver/Driver";
import CompletingTheOrderShopkeeper from "./pages/shopkeeper/CompletingTheOrder";
import CompletingTheOrderDriver from "./pages/driver/CompletingTheOrder";
import DriverDelivery from "./pages/driver/DriverDelivery";
import LogIn from "./pages/auth/LogIn";


const router = createRouter({
    history: createWebHistory(),
    routes: [

        {
            path: '/service',
            name: 'main',
            component: ServiceModule
        },
        // {
        //     path: '/service/login',
        //     name: 'login',
        //     component: LogIn
        // },
        // {
        //     path: '/service/service',
        //     redirect: '/service'
        //     // component: ServiceModule
        // },
        {
            path: '/service/shopkeeper',
            name: 'shopkeeper',
            component: ShopkeeperModule
        },
        {
            path: '/service/shopkeeper/completingTheOrder/:orderId',
            component: CompletingTheOrderShopkeeper,
            name: 'completingTheOrder',
            props: true
        },
        {
            path: '/service/driver',
            name: 'driver',
            component: DriverModule
        },

        {
            path: '/service/driver/delivery',
            name: 'driverDelivery',
            component: DriverDelivery
        },

        {
            path: '/service/driver/completingTheOrder',
            name: 'completingTheOrderDriver',
            component: CompletingTheOrderDriver
        },
    ]
});

export default router;
