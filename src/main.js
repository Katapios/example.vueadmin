import { createApp } from 'vue';
import App from './App.vue';
import './style.css'; // <- обязательно, чтобы CSS стал отдельным бандлом
createApp(App).mount('#vueapp');