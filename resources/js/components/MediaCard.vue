<template>
    <div class="card card-blog card-plain">
        <h6 class="d-flex align-items-center justify-content-between">
            {{ cardTitle }}

            <button
                type="button"
                class="btn btn-outline-primary btn-sm mb-0"
                data-bs-toggle="modal"
                :data-bs-target="'#' + formData.data_media + 'Modal'"
            >
                {{ btnText }}
            </button>
        </h6>
        <div class="position-relative">
            <a class="d-block blur-shadow-image">
                <img
                    :src="imgSrc"
                    :alt="imgAlt"
                    class="img-fluid shadow border-radius-lg"
                />
            </a>
        </div>
        <div class="card-body px-0 pt-4">
            <!-- Modal -->
            <div
                class="modal fade"
                :id="formData.data_media + 'Modal'"
                tabindex="-1"
                role="dialog"
                :aria-labelledby="formData.data_media + 'ModalLabel'"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5
                                class="modal-title"
                                :id="formData.data_media + 'ModalLabel'"
                            >
                                {{ modalTitle ?? cardTitle }}
                            </h5>
                            <button
                                type="button"
                                class="btn-close text-dark"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <media-uploader
                                :route="route"
                                :form-data="formData"
                            ></media-uploader>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        cardTitle: String,
        modalTitle: String,
        btnText: {
            type: String,
            default: "New Image",
        },
        imgSrc: String,
        imgAlt: {
            type: String,
            default: "image",
        },
        route: String,
        formData: Object,
    },
    setup() {},
};
</script>
