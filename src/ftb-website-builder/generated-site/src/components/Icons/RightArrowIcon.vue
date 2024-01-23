<script setup>

</script>

<template>
    <svg
        class="w-4 h-4 text-2xl"
        xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        fill="currentColor"
        viewBox="0 0 16 16"
    >
        <defs>
            <path
                id="arrowRight"
                fill-rule="evenodd"
                d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"
            />
        </defs>
        <g>
            <use
                xlink:href="#arrowRight"
                stroke="var(--gs-colour-background)"
                stroke-width="3"
            />
            <use
                xlink:href="#arrowRight"
                stroke="currentColor"
                stroke-width="2"
            />
        </g>
    </svg>
</template>

<style scoped>

</style>
