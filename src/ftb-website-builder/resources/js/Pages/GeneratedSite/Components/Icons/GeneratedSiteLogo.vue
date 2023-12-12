<script>
export default {
    name: "GeneratedSiteLogo",
    data() {
        return {
            property_name: 'Test Hotel',
        }
    }
}
</script>

<template>
    <a
        class="gs-logo"
        :href="route('preview')"
    >
        {{ property_name }}
    </a>
</template>

<style scoped>

</style>
