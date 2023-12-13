<script>
export default {
    name: "GeneratedSiteLogo",
    props: {
        propertyName: String,
        routes: Object,
    },
}
</script>

<template>
    <a
        class="gs-logo"
        :href="routes.home"
    >
        {{ propertyName }}
    </a>
</template>

<style scoped>

</style>
