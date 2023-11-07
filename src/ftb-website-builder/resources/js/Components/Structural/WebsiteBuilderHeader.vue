<template>
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full wb-bg text-sm py-4">
        <nav
            aria-label="Global"
            class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between"
        >
            <div class="flex items-center justify-between">
                <ApplicationLogo class ="mx-2" />
                <div class="sm:hidden">
                    <button
                        aria-controls="navbar-collapse-with-animation"
                        aria-label="Toggle navigation"
                        class="hs-collapse-toggle p-2 inline-flex justify-center items-center gap-2 rounded-md border font-medium wb-bg text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm"
                        data-hs-collapse="#navbar-collapse-with-animation"
                        type="button"
                    >
                        <svg
                            class="hs-collapse-open:hidden w-4 h-4"
                            fill="currentColor"
                            height="16"
                            viewBox="0 0 16 16"
                            width="16"
                        >
                            <path
                                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"
                                fill-rule="evenodd"
                            />
                        </svg>
                        <svg
                            class="hs-collapse-open:block hidden w-4 h-4"
                            fill="currentColor"
                            height="16"
                            viewBox="0 0 16 16"
                            width="16"
                        >
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div
                id="navbar-collapse-with-animation"
                class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block"
            >
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:pl-5">
                    <SignInOutButton />
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import SignInOutButton from "@/Components/Buttons/SignInOutButton.vue";
import ApplicationLogo from "@/Components/Icons/ApplicationLogo.vue";

export default {
    name: "WebsiteBuilderHeader",
    components: {ApplicationLogo, SignInOutButton}
}
</script>

<style scoped>

</style>
