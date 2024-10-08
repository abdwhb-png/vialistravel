import { ref } from "vue";

export function useGalleryUtilities() {
    const createThumbnail = (imageUrl) => {
        let width = 100,
            height = 100;
        return new Promise((resolve, reject) => {
            // Creating an offscreen canvas to resize the image
            const img = new Image();
            img.crossOrigin = "Anonymous"; // Ensure CORS is handled correctly
            img.src = imageUrl;

            img.onload = () => {
                const canvas = document.createElement("canvas");
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext("2d");

                // Draw the image onto the canvas with the specified size
                ctx.drawImage(img, 0, 0, width, height);

                // Convert the canvas to a data URL for the thumbnail
                const url = canvas.toDataURL("image/jpeg");

                // Resolve the promise with the URL
                resolve(url);
            };

            img.onerror = (error) => {
                reject(new Error("Failed to load image : " + imageUrl));
            };
        });
    };

    const parseImages = async (datas) => {
        const images = [];

        // Préparez les promesses pour la création de vignettes
        const promises = Object.keys(datas).map(async (key) => {
            let item = datas[key];
            try {
                const thumbnailUrl = await createThumbnail(item.src);
                item.thumbnailImageSrc = thumbnailUrl;
            } catch (error) {
                item.thumbnailImageSrc = ""; // Ou mettez une image par défaut en cas d'erreur
                console.error(error);
            }
            item.itemImageSrc = item.src;
            images.push(item);
        });

        // Attendez que toutes les promesses soient résolues
        await Promise.all(promises);

        return images;
    };

    const responsiveOptions = () => {
        return [
            {
                breakpoint: "1300px",
                numVisible: 4,
            },
            {
                breakpoint: "575px",
                numVisible: 1,
            },
        ];
    };
    return {
        createThumbnail,
        parseImages,
        responsiveOptions,
    };
}
