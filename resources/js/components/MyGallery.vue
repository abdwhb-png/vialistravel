<template>
    <Galleria
        :value="images"
        :responsiveOptions="responsiveOptions()"
        :numVisible="5"
        :circular="true"
        :showItemNavigators="true"
        containerStyle="max-width: 100%"
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
    </Galleria>
</template>

<script>
import { ref } from "vue";
import { useGalleryUtilities } from "@/utils/useGalleryUtilities";

export default {
    props: {
        datas: Object,
    },

    setup(props) {
        const { responsiveOptions, parseImages } = useGalleryUtilities();
        const images = ref([]);
        // Appeler parseImages de manière asynchrone
        const loadImages = async () => {
            images.value = await parseImages(props.datas);
        };

        // Charger les images au montage du composant
        loadImages();

        return {
            images,
            responsiveOptions,
        };
    },

    methods: {},
};
</script>
