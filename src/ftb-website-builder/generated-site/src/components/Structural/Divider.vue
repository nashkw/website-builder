<script setup>
const props = defineProps({
    art: {
        type: String,
        required: false,
    },
});
</script>

<template>
    <div class="flex flex-col md:flex-row w-full justify-center items-center">
        <div
            v-if="art"
            class="flex h-10 w-full bg-center bg-contain bg-repeat-x"
            :style="'background-image: url(' + art + ')'"
        />
    </div>
</template>

<style scoped>

</style>
