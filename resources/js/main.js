import "./bootstrap";

import { createApp } from "vue";
import PrimeVue from "primevue/config";
import Lara from "@primevue/themes/lara";

const app = createApp({});

import VLazyImage from "v-lazy-image";
app.component("VLazyImage", VLazyImage);

import Galleria from "primevue/galleria";
app.component("Galleria", Galleria);

import MyGallery from "./components/MyGallery.vue";
app.component("MyGallery", MyGallery);

app.use(PrimeVue, {
    // Default theme configuration
    theme: {
        preset: Lara,
    },
});

app.mount("#app");
