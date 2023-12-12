<script>
import '../../generatedSite.css'

import GeneratedSiteLogo from "../Icons/GeneratedSiteLogo.vue";
import Footer from "@/Components/Structural/WebsiteBuilderFooter.vue";
import FacebookIcon from "@/Pages/GeneratedSite/Components/Icons/FacebookIcon.vue";
import TwitterIcon from "@/Pages/GeneratedSite/Components/Icons/TwitterIcon.vue";
import InstagramIcon from "@/Pages/GeneratedSite/Components/Icons/InstagramIcon.vue";
import MapIcon from "@/Pages/GeneratedSite/Components/Icons/MapIcon.vue";
import PhoneIcon from "@/Pages/GeneratedSite/Components/Icons/PhoneIcon.vue";
import EmailIcon from "@/Pages/GeneratedSite/Components/Icons/EmailIcon.vue";
import HeaderButton from "@/Pages/GeneratedSite/Components/Interactive/HeaderButton.vue";
import HeaderIcon from "@/Pages/GeneratedSite/Components/Icons/HeaderIcon.vue";
import BookingButton from "@/Pages/GeneratedSite/Components/Interactive/BookingButton.vue";

export default {
    name: "GeneratedSiteLayout",
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
        Footer,
        GeneratedSiteLogo
    },
    data() {
        return {
            property_name: 'Test Hotel',
            property_address_line_1: '100 Berkeley Street',
            property_address_line_2: "2nd Floor",
            property_address_area: 'Glasgow',
            property_address_country: 'Scotland',
            property_address_postcode: 'G3 7HU',
            property_telephone: '+44 7123 456789',
            property_email: 'example.property@email.com',
            property_twitter_link: 'https://twitter.com/freetobook',
            property_youtube_link: 'https://www.youtube.com/user/freetobook',
            property_linkedin_link: 'https://www.linkedin.com/company/freetobook/',
            property_facebook_link: 'https://www.facebook.com/freetobook',
            property_instagram_link: 'https://www.instagram.com/freetobook/',
            property_tripadvisor_link: null,
        }
    }
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
                    <GeneratedSiteLogo class="mx-6" />
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
                            :href="route('preview')"
                        />
                        <HeaderButton text="Rooms" href="/" />
                        <HeaderButton text="Reviews" href="/" />
                        <HeaderButton
                            text="About"
                            :href="route('preview.about')"
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
                    <p>{{ property_telephone }}</p>
                </div>
                <div class="gs-footer-item items-center max-md:justify-center">
                    <EmailIcon/>
                    <p>{{ property_email }}</p>
                </div>
            </div>
            <div class="flex flex-col space-y-2 md:w-1/3 justify-center max-md:order-first">
                <GeneratedSiteLogo/>
                <div class="flex flex-row justify-center gap-4">
                    <a
                        class="gs-text-link"
                        v-if="property_facebook_link"
                        :href="property_facebook_link"
                    >
                        <FacebookIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property_twitter_link"
                        :href="property_twitter_link"
                    >
                        <TwitterIcon />
                    </a>
                    <a
                        class="gs-text-link"
                        v-if="property_instagram_link"
                        :href="property_instagram_link"
                    >
                        <InstagramIcon />
                    </a>
                </div>
            </div>
            <div class="gs-footer-item md:w-1/3 justify-end">
                <MapIcon/>
                <div class="text-left leading-5">
                    <p>{{ property_address_line_1 }}</p>
                    <p>{{ property_address_line_2 }}</p>
                    <p>{{ property_address_area }}</p>
                    <p>{{ property_address_country }}</p>
                    <p>{{ property_address_postcode }}</p>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>

</style>
