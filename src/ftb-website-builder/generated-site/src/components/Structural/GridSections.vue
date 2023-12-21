<script setup>
const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="flex flex-col xl:grid grid-cols-2 gap-20 px-16 sm:px-20 xl:px-28 text-left">
        <div
            class="space-y-6"
            v-for="item in items"
        >
            <h1 class="gs-subtitle">
                {{ item.header }}
            </h1>
            <p class="gs-text">
                {{ item.paragraph }}
            </p>
        </div>
    </div>
</template>

<style scoped>

</style>
