<script setup>
const props = defineProps({
    art: {
        type: String,
        required: false,
    },
});
</script>

<template>
    <div class="gs-divider before:flex-1 after:flex-1">
        <img
            v-if="art"
            :src="art"
            alt="Divider"
            class="h-10 px-4"
        />
    </div>
</template>

<style scoped>

</style>
