<script>
import GeneratedSiteLogo from "../Icons/GeneratedSiteLogo.vue";
import FacebookIcon from "../Icons/FacebookIcon.vue";
import TwitterIcon from "../Icons/TwitterIcon.vue";
import InstagramIcon from "../Icons/InstagramIcon.vue";
import YouTubeIcon from "../Icons/YouTubeIcon.vue";
import LinkedInIcon from "../Icons/LinkedInIcon.vue";
import TripAdvisorIcon from "../Icons/TripAdvisorIcon.vue";
import MapIcon from "../Icons/MapIcon.vue";
import PhoneIcon from "../Icons/PhoneIcon.vue";
import EmailIcon from "../Icons/EmailIcon.vue";
import HeaderButton from "../Interactive/HeaderButton.vue";
import HeaderIcon from "../Icons/HeaderIcon.vue";
import BookingButton from "../Interactive/BookingButton.vue";
import Divider from "../Structural/Divider.vue";

export default {
    name: "GeneratedSiteLayout",
    props: {
        property: Object,
        routes: Object,
        page_flags: Object,
    },
    components: {
        TripAdvisorIcon,
        LinkedInIcon,
        YouTubeIcon,
        BookingButton,
        HeaderIcon,
        HeaderButton,
        EmailIcon,
        PhoneIcon,
        MapIcon,
        InstagramIcon,
        TwitterIcon,
        FacebookIcon,
        GeneratedSiteLogo,
        Divider,
    },
}
</script>

<template>
    <div>
        <header class="flex flex-wrap xl:justify-start xl:flex-nowrap z-50 w-full gs-bg-alt text-sm py-4">
            <nav
                class="relative w-full mx-auto px-4 xl:flex xl:items-center xl:justify-between xl:px-8"
                aria-label="Global"
            >
                <div class="flex items-center justify-between">
                    <GeneratedSiteLogo
                        class="mx-6"
                        :routes="routes"
                        :property="property"
                    />
                    <div class="xl:hidden">
                        <button
                            type="button"
                            class="hs-collapse-toggle w-9 h-9 flex justify-center items-center text-sm font-semibold rounded-lg"
                            data-hs-collapse="#navbar-collapse-with-animation"
                            aria-controls="navbar-collapse-with-animation"
                            aria-label="Toggle navigation"
                        >
                            <HeaderIcon class="gs-title"/>
                        </button>
                    </div>
                </div>
                <div
                    id="navbar-collapse-with-animation"
                    class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow xl:block"
                >
                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-4 mt-5 xl:flex xl:flex-row xl:items-center xl:justify-end xl:gap-y-0 xl:gap-x-2 xl:mt-0 xl:ps-7">
                        <HeaderButton
                            v-if="page_flags.has_home_page"
                            text="Home"
                            :href="routes.home"
                        />
                        <HeaderButton
                            v-if="page_flags.has_rooms_page"
                            text="Rooms"
                            :href="routes.rooms"
                        />
                        <HeaderButton
                            v-if="page_flags.has_reviews_page"
                            text="Reviews"
                            :href="routes.reviews"
                        />
                        <HeaderButton
                            v-if="page_flags.has_about_page"
                            text="About"
                            :href="routes.about"
                        />
                        <HeaderButton
                            v-if="page_flags.has_explore_page"
                            text="Explore"
                            :href="routes.explore"
                        />
                        <HeaderButton
                            v-if="page_flags.has_find_us_page"
                            text="Find Us"
                            :href="routes.findus"
                        />
                        <HeaderButton
                            v-if="page_flags.has_faq_page"
                            text="FAQ"
                            :href="routes.faq"
                        />
                        <BookingButton
                            text="Book Now"
                            :bookingLink="property.property_booking_link"
                            class="xl:ml-4"
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
                    <p>{{ property.property_telephone }}</p>
                </div>
                <div class="gs-footer-item items-center max-md:justify-center">
                    <EmailIcon/>
                    <p>{{ property.property_email }}</p>
                </div>
            </div>
            <div class="flex flex-col space-y-2 md:w-1/3 justify-center items-center max-md:order-first">
                <GeneratedSiteLogo
                    :routes="routes"
                    :property="property"
                />
                <div class="flex flex-row justify-center gap-4">
                    <a
                        class="gs-text-link"
                        v-if="property.property_facebook_link"
                        :href="property.property_facebook_link"
                    >
                        <FacebookIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property.property_twitter_link"
                        :href="property.property_twitter_link"
                    >
                        <TwitterIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property.property_instagram_link"
                        :href="property.property_instagram_link"
                    >
                        <InstagramIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property.property_tripadvisor_link"
                        :href="property.property_tripadvisor_link"
                    >
                        <TripAdvisorIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property.property_linkedin_link"
                        :href="property.property_linkedin_link"
                    >
                        <LinkedInIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property.property_youtube_link"
                        :href="property.property_youtube_link"
                    >
                        <YouTubeIcon />
                    </a>
                </div>
            </div>
            <div class="gs-footer-item md:w-1/3 justify-end">
                <MapIcon/>
                <div class="text-left leading-5">
                    <p>{{ property.property_address_line_1 }}</p>
                    <p>{{ property.property_address_line_2 }}</p>
                    <p>{{ property.property_address_area }}</p>
                    <p>{{ property.property_address_country }}</p>
                    <p>{{ property.property_address_postcode }}</p>
                </div>
            </div>
        </footer>
        <div class="h-20">
            <br />
        </div>
        <footer class="flex justify-center items-center gs-bg-alt fixed bottom-0 left-0 right-0 py-4 h-20">
            <Divider class="w-full gap-8">
                <GeneratedSiteLogo
                    class="max-sm:hidden"
                    :routes="routes"
                    :property="property"
                />
                <BookingButton
                    text="Book Now"
                    :bookingLink="property.property_booking_link"
                />
            </Divider>
        </footer>
    </div>
</template>

<style scoped>

</style>
