import {createRouter, createWebHistory} from "vue-router";
import ServiceModule from "./pages/Service";
import ShopkeeperModule from "./pages/shopkeeper/Shopkeeper";
import CompletingTheOrder from "./pages/shopkeeper/CompletingTheOrder";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/service', component: ServiceModule},
        {path: '/service/shopkeeper', component: ShopkeeperModule},
        {
            path: '/service/shopkeeper/completingTheOrder/:orderId',
            component: CompletingTheOrder,
            name: 'completingTheOrder',
            props: true
        },
    ]
});

export default router;
