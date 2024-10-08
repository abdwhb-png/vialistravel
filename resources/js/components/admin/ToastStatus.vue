<template>
    <!-- <Toast position="bottom-center" :group="group" @close="onClose" /> -->
    <Toast position="bottom-center" :group="group" @close="onClose">
        <template #message="slotProps">
            <div class="flex flex-col items-start flex-auto">
                <div class="flex items-center gap-2">
                    <span class="font-bold"
                        >Action status :
                        <span class="text-uppercase">{{
                            slotProps.message.severity
                        }}</span>
                    </span>
                </div>
                <div
                    class="font-medium text-lg my-4"
                    v-html="slotProps.message.summary"
                ></div>
                <ul class="mb-0" v-if="result && result.list">
                    <li v-for="(item, i) in result.list" :key="i">
                        {{ item }}
                    </li>
                </ul>
            </div>
        </template>
    </Toast>
</template>

<script setup>
import { useToast } from "primevue/usetoast";
import { ref, watch, toRefs } from "vue";

const props = defineProps({
    res: {
        type: Object,
        required: false,
    },
    visible: {
        type: Boolean,
        default: true,
    },
});

const { res, visible } = toRefs(props); // Rendre les props réactives
const toast = useToast();

const result = ref(res.value);

const randGroup = () => {
    let random_id = Math.ceil(Math.random() * 1000000);
    return "toastGP_" + random_id;
};
const group = randGroup(); // Fonction pour générer un ID de groupe

const showToast = () => {
    if (!visible.value) return;

    toast.add({
        severity: result.value.type ?? "warn",
        summary: result.value.msg,
        detail:
            result.value.list && result.value.list.length
                ? " - " + result.value.list.join("\n- ")
                : "",
        group: group,
    });
};

const onClose = () => {
    toast.removeAllGroups();
};

// Un seul watcher pour les deux propriétés
watch(
    () => [res.value, visible.value], // Observer les deux propriétés
    ([newRes, newVisible]) => {
        toast.removeGroup(group);

        result.value = newRes; // Mettez à jour le résultat avec la nouvelle valeur

        if (newRes && newVisible) {
            showToast();
        }
    },
    { immediate: true } // Exécutez immédiatement pour obtenir la première valeur
);
</script>
