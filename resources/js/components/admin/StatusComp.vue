<template>
    <section>
        <button
            type="button"
            class="d-none"
            data-bs-toggle="modal"
            data-bs-target="#statusModal"
            ref="showbtn"
        >
            ...
        </button>
        <div
            class="modal fade"
            id="statusModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="statusModalLabel"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            :class="
                                type == 'fail' ? 'text-danger' : 'text-success'
                            "
                            id="statusModalLabel"
                        >
                            {{ title }}
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
                    <div class="modal-body" v-if="msg || list?.length">
                        <h6 class="" v-show="msg" v-html="msg"></h6>
                        <ul v-show="list?.length">
                            <li
                                :class="type == 'fail' ? 'text-danger' : ''"
                                v-for="(i, item) in list"
                                v-bind:key="i"
                            >
                                {{ i + " : " + item }}
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn bg-gradient-secondary"
                            data-bs-dismiss="modal"
                        >
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import { ref } from "vue";
export default {
    props: {
        status: {
            type: Object,
        },
        type: {
            type: String,
        },
    },
    setup(props) {
        const title = props.status.title;
        const msg = props.status.msg;
        const list = props.status.list;
        return { title, msg, list };
    },
    mounted() {
        this.$refs.showbtn.click();
    },
};
</script>
