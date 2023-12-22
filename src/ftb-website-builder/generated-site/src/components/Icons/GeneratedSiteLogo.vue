<script setup>
const props = defineProps({
    property: {
        type: Object,
        required: true,
    },
    routes: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <a
        class="flex justify-center items-center w-max gap-2"
        :href="routes.home"
    >
        <img
            v-if="property.property_logo"
            :src="property.property_logo"
            :alt="'The ' + property.property_name + ' logo'"
            class="flex object-cover h-8"
        />
        <h1 class="gs-logo">
            {{ property.property_name }}
        </h1>
    </a>
</template>

<style scoped>

</style>
