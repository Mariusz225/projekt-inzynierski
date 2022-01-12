import {createApp} from "vue";

import router from './router';
import store from "./store";
import App from './App';
import AppService from './AppService';
import BaseCard from './components/ui/BaseCard';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret, faExclamation, faArrowCircleRight, faCheckCircle as fasCheckCircle } from '@fortawesome/free-solid-svg-icons'
import { faCheckCircle as farCheckCircle } from '@fortawesome/free-regular-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
// import { faTwitter, faFacebook, faStackOverflow, faGithub } from '@fortawesome/free-brands-svg-icons'




const app = createApp(App);

app.use(router);
app.use(store);

app.component('base-card', BaseCard);

app.mount('#app');



library.add(faUserSecret, faExclamation, faArrowCircleRight, farCheckCircle, fasCheckCircle)

const appService = createApp(AppService);
appService.use(router);
appService.use(store);

appService.component('font-awesome-icon', FontAwesomeIcon);

appService.mount('#service');