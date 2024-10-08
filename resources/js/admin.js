import "./bootstrap";

import { createApp } from "vue";

import { createPinia } from "pinia";

import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import ToastService from "primevue/toastservice";
import ConfirmationService from "primevue/confirmationservice";

const app = createApp({});
const pinia = createPinia();

import StatusComp from "./components/admin/StatusComp.vue";
app.component("StatusComp", StatusComp);

import ToastStatus from "./components/admin/ToastStatus.vue";
app.component("ToastStatus", ToastStatus);

import LegalPage from "./components/admin/LegalPage.vue";
app.component("LegalPage", LegalPage);

import EditSitePage from "./components/admin/EditSitePage.vue";
app.component("EditSitePage", EditSitePage);
import NewSitePage from "./components/admin/NewSitePage.vue";
app.component("NewSitePage", NewSitePage);

import RegionBasics from "./components/admin/RegionBasics.vue";
app.component("RegionBasics", RegionBasics);
import RegionAdvanced from "./components/admin/RegionAdvanced.vue";
app.component("RegionAdvanced", RegionAdvanced);

import TripBasics from "./components/admin/TripBasics.vue";
app.component("TripBasics", TripBasics);
// Overview, Itinary
import TripOverview from "./components/admin/TripOverview.vue";
app.component("TripOverview", TripOverview);
// Highlights, Dates & FAQ
import TripHighlDateFaq from "./components/admin/TripHighlDateFaq.vue";
app.component("TripHighlDateFaq", TripHighlDateFaq);
// More details & Reviews
import TripMoreReviews from "./components/admin/TripMoreReviews.vue";
app.component("TripMoreReviews", TripMoreReviews);
// Hero, Pic & Photos
import TripMedias from "./components/admin/TripMedias.vue";
app.component("TripMedias", TripMedias);

import ReviewsList from "./components/admin/ReviewsList.vue";
app.component("ReviewsList", ReviewsList);

import DeleteMultipleData from "./components/admin/DeleteMultipleData.vue";
app.component("DeleteMultipleData", DeleteMultipleData);

import MediaUploader from "./components/MediaUploader.vue";
app.component("MediaUploader", MediaUploader);

import MyGallery from "./components/MyGallery.vue";
app.component("MyGallery", MyGallery);

import NoResults from "./components/NoResults.vue";
app.component("NoResults", NoResults);

import MediaCard from "./components/MediaCard.vue";
app.component("MediaCard", MediaCard);

import MyPickList from "./components/MyPickList.vue";
app.component("MyPickList", MyPickList);

import MyPanel from "./components/MyPanel.vue";
app.component("MyPanel", MyPanel);

import MyUniSelect from "./components/MyUniSelect.vue";
app.component("MyUniSelect", MyUniSelect);

import MyMultiSelect from "./components/MyMultiSelect.vue";
app.component("MyMultiSelect", MyMultiSelect);

import SimpleDataTable from "./components/SimpleDataTable.vue";
app.component("SimpleDataTable", SimpleDataTable);

import VLazyImage from "v-lazy-image";
app.component("VLazyImage", VLazyImage);

app.use(pinia)
    .use(PrimeVue, {
        theme: {
            preset: Aura,
        },
    })
    .use(ToastService)
    .use(ConfirmationService);
app.mount("#app");
