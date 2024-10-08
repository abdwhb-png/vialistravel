<style scoped>
.no-data {
    width: 50%;
    height: auto;
}
.no-text {
    color: rgb(184, 184, 184);
}
</style>
<template>
    <div class="text-center">
        <img
            src="/images/no-results.png"
            class="no-data"
            alt="no results image"
        />
    </div>
</template>

<script>
export default {
    props: {
        sizes: { type: Object, default: { width: "50%", height: "auto" } },
    },
};
</script>
