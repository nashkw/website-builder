<script>
import GeneratedSiteLogo from "../Icons/GeneratedSiteLogo.vue";
import FacebookIcon from "../Icons/FacebookIcon.vue";
import TwitterIcon from "../Icons/TwitterIcon.vue";
import InstagramIcon from "../Icons/InstagramIcon.vue";
import MapIcon from "../Icons/MapIcon.vue";
import PhoneIcon from "../Icons/PhoneIcon.vue";
import EmailIcon from "../Icons/EmailIcon.vue";
import HeaderButton from "../Interactive/HeaderButton.vue";
import HeaderIcon from "../Icons/HeaderIcon.vue";
import BookingButton from "../Interactive/BookingButton.vue";

export default {
    name: "GeneratedSiteLayout",
    props: {
        property: Object,
        routes: Object,
    },
    components: {
        BookingButton,
        HeaderIcon,
        HeaderButton,
        EmailIcon,
        PhoneIcon,
        MapIcon,
        InstagramIcon,
        TwitterIcon,
        FacebookIcon,
        GeneratedSiteLogo
    },
}
</script>

<template>
    <div>
        <header class="flex flex-wrap lg:justify-start lg:flex-nowrap z-50 w-full gs-bg-alt text-sm py-4">
            <nav
                class="relative w-full mx-auto px-4 lg:flex lg:items-center lg:justify-between lg:px-8"
                aria-label="Global"
            >
                <div class="flex items-center justify-between">
                    <GeneratedSiteLogo
                        class="mx-6"
                        :routes="routes"
                        :propertyName="property.propertyName"
                    />
                    <div class="lg:hidden">
                        <button
                            type="button"
                            class="hs-collapse-toggle w-9 h-9 flex justify-center items-center text-sm font-semibold rounded-lg"
                            data-hs-collapse="#navbar-collapse-with-animation"
                            aria-controls="navbar-collapse-with-animation"
                            aria-label="Toggle navigation"
                        >
                            <HeaderIcon/>
                        </button>
                    </div>
                </div>
                <div
                    id="navbar-collapse-with-animation"
                    class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow lg:block"
                >
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-4 mt-5 lg:flex lg:flex-row lg:items-center lg:justify-end lg:gap-y-0 lg:gap-x-2 lg:mt-0 lg:ps-7">
                        <HeaderButton
                            text="Home"
                            :href="routes.home"
                        />
                        <HeaderButton text="Rooms" href="/" />
                        <HeaderButton text="Reviews" href="/" />
                        <HeaderButton
                            text="About"
                            :href="routes.about"
                        />
                        <HeaderButton text="Explore" href="/" />
                        <HeaderButton text="Find Us" href="/" />
                        <HeaderButton text="FAQ" href="/" />
                        <BookingButton
                            text="Book Now"
                            booking-link=""
                            class="lg:ml-4"
                        />
                    </div>
                </div>
            </nav>
        </header>

        <div class="space-y-16 gs-gradient-bg pb-8">
            <slot />
        </div>

        <footer class="w-full py-10 px-4 md:px-8 lg:px-10 mx-auto gs-bg flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex flex-col md:w-1/3 space-y-2 justify-center">
                <div class="gs-footer-item items-center max-md:justify-center">
                    <PhoneIcon/>
                    <p>{{ property.propertyTelephone }}</p>
                </div>
                <div class="gs-footer-item items-center max-md:justify-center">
                    <EmailIcon/>
                    <p>{{ property.propertyEmail }}</p>
                </div>
            </div>
            <div class="flex flex-col space-y-2 md:w-1/3 justify-center max-md:order-first">
                <GeneratedSiteLogo
                    :routes="routes"
                    :propertyName="property.propertyName"
                />
                <div class="flex flex-row justify-center gap-4">
                    <a
                        class="gs-text-link"
                        v-if="property.propertyFacebookLink"
                        :href="property.propertyFacebookLink"
                    >
                        <FacebookIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property.propertyTwitterLink"
                        :href="property.propertyTwitterLink"
                    >
                        <TwitterIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property.propertyInstagramLink"
                        :href="property.propertyInstagramLink"
                    >
                        <InstagramIcon />
                    </a>
                </div>
            </div>
            <div class="gs-footer-item md:w-1/3 justify-end">
                <MapIcon/>
                <div class="text-left leading-5">
                    <p>{{ property.propertyAddressLine1 }}</p>
                    <p>{{ property.propertyAddressLine2 }}</p>
                    <p>{{ property.propertyAddressArea }}</p>
                    <p>{{ property.propertyAddressCountry }}</p>
                    <p>{{ property.propertyAddressPostcode }}</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>

</style>
