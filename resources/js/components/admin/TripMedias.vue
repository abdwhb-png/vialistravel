<template>
    <div class="row g-4 mb-4">
        <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h5 class="mb-0">Trip Medias</h5>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <p>Gallery photos</p>
                            <media-uploader
                                :route="routes.upload_media"
                                :multiple="true"
                                :form-data="medias.photos.form_data"
                            ></media-uploader>
                            <hr class="horizontal dark my-sm-2" />
                            <Galleria
                                :value="images"
                                :numVisible="5"
                                :responsiveOptions="responsiveOptions()"
                                :circular="true"
                                containerStyle="max-width: 640px"
                            >
                                <template #item="slotProps">
                                    <v-lazy-image
                                        :src="slotProps.item.src"
                                        src-placeholder="/images/loading.gif"
                                        :alt="slotProps.item.alt"
                                        style="width: 100%; display: block"
                                    />
                                </template>
                                <template #thumbnail="slotProps">
                                    <v-lazy-image
                                        :src="slotProps.item.thumbnailImageSrc"
                                        src-placeholder="/images/loading.gif"
                                        :alt="slotProps.item.alt"
                                        style="width: 100%; display: block"
                                    />
                                </template>
                                <template #caption="slotProps">
                                    <div class="text-center">
                                        <Button
                                            type="button"
                                            label="Delete"
                                            :loading="requestState.loading"
                                            unstyled
                                            class="btn btn-danger"
                                            @click="
                                                deletePhoto(
                                                    slotProps.item.delete_route,
                                                    slotProps.item.media
                                                )
                                            "
                                        />
                                    </div>
                                </template>
                            </Galleria>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                            <media-card
                                card-title="Trip main pic"
                                btn-text="New Pic"
                                :imgSrc="medias.pic.src"
                                :imgAlt="medias.pic.alt"
                                :route="routes.upload_media"
                                :form-data="medias.pic.form_data"
                            ></media-card>
                            <hr class="horizontal dark my-sm-2" />
                            <media-card
                                card-title="Trip hero image"
                                btn-text="New Hero"
                                modal-tile=""
                                :imgSrc="medias.hero.src"
                                :imgAlt="medias.hero.alt"
                                :route="routes.upload_media"
                                :form-data="medias.hero.form_data"
                            ></media-card>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <toast-status :res="requestState.result"></toast-status>
    </div>
</template>

<script>
import { ref } from "vue";
import { useRequestUtilities } from "@/utils/useRequestUtilities";
import { useGalleryUtilities } from "@/utils/useGalleryUtilities";

export default {
    props: {
        medias: { type: Object },
        theItem: { type: Object },
        routes: { type: Object },
    },

    setup(props) {
        const { responsiveOptions, parseImages } = useGalleryUtilities();
        const images = ref([]);
        // Appeler parseImages de manière asynchrone
        const loadImages = async () => {
            images.value = await parseImages(props.medias.photos.files);
        };

        // Charger les images au montage du composant
        loadImages();

        const myRequest = useRequestUtilities();
        const requestState = myRequest.state.value;

        return {
            images,
            responsiveOptions,
            myRequest,
            requestState,
        };
    },

    data(props) {
        return {
            form: props.theItem,
            usableImages: this.images,
        };
    },

    methods: {
        async submit() {
            await this.myRequest.send(
                "POST",
                this.routes.save_basics,
                this.form
            );
        },
        async deletePhoto(route, media) {
            await this.myRequest.send("POST", route, media);
            if (this.myRequest.isOk()) {
                this.images = this.images.filter((d) => {
                    return d.media.id !== media.id;
                });
            }
        },
    },
};
</script>
