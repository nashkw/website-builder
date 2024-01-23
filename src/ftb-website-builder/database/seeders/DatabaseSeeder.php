<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Testing User',
            'email' => 'nash@freetobook.co.uk',
            'password' => Hash::make('nashtest'),
        ]);
        $property_id = DB::table('properties')->insertGetId([
            'user_id' => $user_id,
            'property_name' => 'Test Hotel',
            'property_address_line_1' => '100 Berkeley Street',
            'property_address_line_2' => '2nd Floor',
            'property_address_area' => 'Glasgow',
            'property_address_country' => 'Scotland',
            'property_address_postcode' => 'G3 7HU',
            'property_telephone' => '0141 270 2173',
            'property_email' => 'info@freetobook.com',
            'property_twitter_link' => 'https://twitter.com/freetobook',
            'property_youtube_link' => 'https://www.youtube.com/user/freetobook',
            'property_linkedin_link' => 'https://www.linkedin.com/company/freetobook/',
            'property_facebook_link' => 'https://www.facebook.com/freetobook',
            'property_instagram_link' => 'https://www.instagram.com/freetobook/',
            'property_booking_link' => 'https://en.freetobook.com/',
            'property_logo' => 'images/propertyLogo/test_logo.png',
        ]);
        DB::table('websites')->insert([
            'property_id' => $property_id,
            'primary_colour' => '10b981',
            'secondary_colour' => 'b1cc16',
            'background_colour' => '010200',
            'text_colour' => 'fefffd',
            'divider_art' => 'images/dividerArt/test_divider_art.png',
            'font_family' => 'Roboto Slab',
            'subdomain' => 'testhotel',
            'preview_only' => false,
        ]);
        DB::table('home_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Welcome to Test Hotel',
            'meta_page_description' => 'Experience luxury at its finest. Stylish accommodations, top-notch amenities, and personalized service in a prime location. Indulge in gourmet dining, spa retreats, and unparalleled hospitality. Book now for an unforgettable stay.',
            'cover_image_primary' => 'images/coverImagePrimary/test_cover_image_1.jpg',
            'cover_image_primary_description' => 'A front facing view of our main building.',
            'intro_section_header' => "Glasgow's finest",
            'intro_section_paragraph' => 'Discover luxury at its peak with stylish accommodations, top-notch amenities, and personalized service. Indulge in gourmet dining, spa retreats, and unparalleled hospitality. Book now for an unforgettable stay.',
            'intro_section_image' => 'images/sectionImages/homeIntro/test_intro_image.jpg',
            'intro_section_image_description' => 'A photo of our gorgeous lounge area.',
            'welcome_section_header' => 'Welcome to Test Hotel...',
            'welcome_section_paragraph' => 'Welcome to a world of unparalleled hospitality and comfort! We are delighted to have you as our guest. From the moment you step through our doors, expect an experience tailored to exceed your expectations. Our dedicated team is committed to ensuring your stay is nothing short of extraordinary. Whether you are here for business or leisure, we invite you to relax, indulge, and make yourself at home. Your journey with us begins now, and we are honored to be a part of it.',
            'welcome_section_image' => 'images/sectionImages/homeWelcome/test_welcome_image.jpg',
            'welcome_section_image_description' => 'A photo of one of our sleek modern hallways.',
        ]);
        DB::table('secondary_cover_images')->insert([
            'property_id' => $property_id,
            'secondary_cover_image' => 'images/coverImageSecondary/test_cover_image_2.jpg',
            'secondary_cover_image_description' => 'A photo of one of our fashionable lobby areas.',
        ]);
        DB::table('secondary_cover_images')->insert([
            'property_id' => $property_id,
            'secondary_cover_image' => 'images/coverImageSecondary/test_cover_image_3.jpg',
            'secondary_cover_image_description' => 'A photo of one of our beautiful waiting rooms.',
        ]);
        DB::table('rooms_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Rooms at Test Hotel',
            'meta_page_description' => 'Experience pure comfort and style in our meticulously designed rooms. Whether you are here for business or leisure, indulge in modern amenities and elegant decor. Book now for a stay that redefines luxury.',
            'rooms_page_section_paragraph' => 'Step into a realm of luxury and tranquility with our meticulously designed rooms. Each space is a sanctuary of comfort, featuring modern amenities and elegant decor to elevate your stay. Whether you are seeking a restful retreat or a productive work environment, our rooms cater to your every need. Immerse yourself in the perfect blend of style and functionality. Book your room now for an exceptional experience that goes beyond accommodation – it is a celebration of comfort and sophistication.',
            'rooms_page_section_image' => 'images/sectionImages/roomsPrimary/test_rooms_page.jpg',
            'rooms_page_section_image_description' => 'A photo of one of our gorgeous lounge areas.',
        ]);
        $room1_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Standard Double',
            'room_description' => 'Discover comfort for two in our spacious double room, thoughtfully designed for a relaxing stay. Enjoy modern amenities, a cozy atmosphere, and the perfect blend of style. Your retreat awaits – book now for an elevated experience.',
            'room_image_primary' => 'images/roomListingPrimary/test_room_1.jpg',
            'room_image_primary_description' => 'A photo of one of our standard double rooms.',
        ]);
        $room2_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Double Deluxe',
            'room_description' => 'Indulge in the epitome of luxury with our Double Deluxe Rooms, where sophistication meets unparalleled comfort. Elegantly designed to exceed expectations, these opulent retreats boast spacious interiors, lavish furnishings, and panoramic views that redefine the art of relaxation. Immerse yourself in a haven of tranquility, where every detail, from the sumptuous bedding to the carefully curated amenities, is crafted to elevate your stay. Whether you are seeking a romantic getaway or simply unwinding in style, our Double Deluxe Rooms provide an enchanting escape in the heart of luxury, ensuring an unforgettable experience for the discerning traveler.',
            'room_image_primary' => 'images/roomListingPrimary/test_room_2.jpg',
            'room_image_primary_description' => 'A photo of one of our double deluxe rooms.',
        ]);
        $room3_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Standard Twin',
            'room_description' => 'Experience refined comfort and chic sophistication in our luxurious Twin Rooms. Thoughtfully designed for the discerning traveler, these rooms offer a harmonious blend of style and functionality. Immerse yourself in the plush surroundings adorned with modern amenities, ensuring a seamless stay. Whether you are traveling with a companion or seeking a spacious haven for yourself, our Twin Rooms provide the perfect retreat. Revel in the opulence of our hotel, where every detail is curated to exceed your expectations, promising an unforgettable stay in the lap of luxury.',
            'room_image_primary' => 'images/roomListingPrimary/test_room_3.jpg',
            'room_image_primary_description' => 'A photo of one of our twin rooms.',
        ]);
        $room4_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Swan Suite',
            'room_description' => 'Indulge in the pinnacle of romance with our exquisite Swan Suite, a haven for love and luxury. This enchanting retreat is meticulously designed to captivate the senses, offering an intimate escape for couples seeking a romantic getaway. The Swan Suite features a blend of timeless elegance and modern opulence, creating an atmosphere of pure romance. Revel in the spacious interiors, adorned with tasteful décor and sumptuous furnishings. Immerse yourselves in the allure of the suites private amenities, from a lavish en-suite spa to a breathtaking view that sets the stage for unforgettable moments. Elevate your romantic experience with the Swan Suite, where every detail is crafted to ignite passion and create cherished memories in the lap of unparalleled luxury.',
            'room_image_primary' => 'images/roomListingPrimary/test_room_4.jpg',
            'room_image_primary_description' => 'A photo of our Swan Suite.',
        ]);
        DB::table('secondary_room_images')->insert([
            'room_id' => $room1_id,
            'secondary_room_image' => 'images/roomListingSecondary/test_room_1_1.jpg',
            'secondary_room_image_description' => 'A photo of one of our standard double rooms.',
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room2_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_2_1.jpg',
                'secondary_room_image_description' => 'A photo of one of our double deluxe rooms.',
            ],
            [
                'room_id' => $room2_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_2_2.jpg',
                'secondary_room_image_description' => 'A photo of one of our double deluxe rooms.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_3_1.jpg',
                'secondary_room_image_description' => 'A photo of one of our twin rooms.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_3_2.jpg',
                'secondary_room_image_description' => 'A photo of one of our twin rooms.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_3_3.jpg',
                'secondary_room_image_description' => 'A photo of one of our twin rooms.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_4_1.jpg',
                'secondary_room_image_description' => 'A photo of our Swan Suite.',
            ],
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_4_2.jpg',
                'secondary_room_image_description' => 'A photo of our Swan Suite.',
            ],
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/roomListingSecondary/test_room_4_3.jpg',
                'secondary_room_image_description' => 'A photo of one of our Swan Suite.',
            ],
        ]);
        DB::table('reviews_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Hear from our guests',
            'meta_page_description' => 'Discover delighted guest stories of exceptional hospitality and stylish comfort. Join them in experiencing our unparalleled service.',
            'reviews_page_section_paragraph' => 'Explore the genuine experiences of our guests through heartfelt reviews that capture the essence of our exceptional hospitality. From glowing testimonials about our attentive staff to raving comments on the stylish and comfortable accommodations, each review reflects the dedication we pour into creating memorable stays. We take pride in the positive stories shared by those who have made our hotel their home away from home. Join the chorus of satisfied guests and discover firsthand why our hotel is a beacon of comfort and unparalleled service.',
        ]);
        DB::table('reviews')->insert([
            [
                'property_id' => $property_id,
                'review_quote' => 'An absolute gem! From the attentive staff to the stylish and comfortable accommodations, this hotel exceeded all expectations. A perfect blend of luxury and warmth. Highly recommended for a truly exceptional experience.',
                'reviewer_name' => 'René Descartes',
                'star_rating' => 9,
                'review_date' => date_create_from_format('F Y', 'October 2022'),
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'Exceptional stay! The personalized service made for a perfect getaway. Comfortable rooms, attentive staff, and a prime location — an ideal choice for a relaxing experience. Cannot wait to return!',
                'reviewer_name' => 'Friedrich Nietzsche',
                'star_rating' => 10,
                'review_date' => date_create_from_format('F Y', 'January 2023'),
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'Wow, this place is a dream! Our room was like stepping into a luxury magazine — stylish and cozy. The staff made us feel like VIPs. Cannot wait for round two!',
                'reviewer_name' => 'Ludwig Wittgenstein',
                'star_rating' => 10,
                'review_date' => date_create_from_format('F Y', 'July 2018'),
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'High-end heaven! From the lobby to the bed, everything was on point. Shoutout to the staff for being the real MVPs of our stay. Five stars all the way!',
                'reviewer_name' => 'Simone de Beauvoir',
                'star_rating' => 10,
                'review_date' => date_create_from_format('F Y', 'November 2020'),
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'Lovely romantic getaway. The Swan Suite is beautiful, we could not get enough of it. Super comfy and very Instagram-worthy. Hope to return next year!',
                'reviewer_name' => 'Immanuel Kant',
                'star_rating' => 8,
                'review_date' => date_create_from_format('F Y', 'February 2022'),
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'Amazing stay! The suite was swanky, the food was divine, and the vibe was perfect. Kudos to the friendly staff for making us feel right at home.',
                'reviewer_name' => 'David Hume',
                'star_rating' => 10,
                'review_date' => date_create_from_format('F Y', 'April 2023'),
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'The Swan Suite was pure perfection! Immaculate interiors and an enchanting view made our getaway unforgettable. The staff were very attentive. Highly recommended for those seeking a high end experience.',
                'reviewer_name' => 'Thomas Hobbes',
                'star_rating' => 9,
                'review_date' => date_create_from_format('F Y', 'September 2021'),
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'Our stay was a sensory delight - plush accommodations, gourmet dining, and attentive staff had us feeling like royalty. This hotel surpassed all expectations, already planning our next trip.',
                'reviewer_name' => 'Michel Foucault',
                'star_rating' => 10,
                'review_date' => date_create_from_format('F Y', 'May 2022'),
            ],
        ]);
        DB::table('about_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'All about Test Hotel',
            'meta_page_description' => 'At our core, we are a story of passion and dedication, weaving modern luxury and genuine hospitality into every experience. Join us in creating unforgettable moments at our welcoming haven.',
            'about_page_section_paragraph' => 'In the heart of the city, our hotel began as a vision—a dream to create a space where luxury and hospitality seamlessly intertwined. Guided by this passion, we embarked on a journey of meticulous planning and thoughtful design. From the initial sketches to the final touches, every detail was crafted to evoke a sense of comfort and sophistication, setting the stage for an exceptional stay.',
            'about_page_section_image' => 'images/sectionImages/aboutPrimary/test_about_image_1.jpg',
            'about_page_section_image_description' => 'A photo of one of the outside of one of our buildings.',
        ]);
        DB::table('secondary_about_sections')->insert([
            'property_id' => $property_id,
            'secondary_about_section_paragraph' => "As the doors opened, our story began to unfold through the unique experiences of our cherished guests. They quickly discovered the genuine warmth radiating from our attentive staff, experienced the stylish allure embedded in every corner of our accommodations, and marveled at the seamless fusion of modern amenities with timeless charm.\nThe resounding positivity echoed in the reviews served as a testament to the success of our endeavor, further solidifying our commitment to delivering an unparalleled escape for each and every visitor. These testimonials not only inspire us but also motivate our dedicated team to continually raise the bar, ensuring that every guest enjoys a truly exceptional and memorable stay.",
            'secondary_about_section_image' => 'images/sectionImages/aboutSecondary/test_about_image_2.jpg',
            'secondary_about_section_image_description' => 'A photo of one of one of our welcoming reception rooms.',
        ]);
        DB::table('secondary_about_sections')->insert([
            'property_id' => $property_id,
            'secondary_about_section_header' => 'Where we are today',
            'secondary_about_section_paragraph' => "Today, our hotel stands as a testament to the dedication that brought it into existence. It serves as a living story, with every check-in marking the addition of a new chapter. Whether our guests are here for business or leisure, the narrative of our establishment continues to evolve, weaving a legacy of cherished moments and leaving behind a trail of satisfied smiles.\nOur story is an ongoing journey, and we extend a warm invitation for you to become a part of it. Your chapter awaits at our doors, where each guest contributes to the vibrant tapestry of experiences that define our hotel. Join us in creating and sharing moments that make our story truly extraordinary.",
            'secondary_about_section_image' => 'images/sectionImages/aboutSecondary/test_about_image_3.jpg',
            'secondary_about_section_image_description' => 'A photo of one of one of our elegant pool areas.',
        ]);
        DB::table('explore_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Things to do near Test Hotel',
            'meta_page_description' => 'Unlock a world of experiences with our curated list of things to do near Test Hotel. From cultural gems to outdoor adventures, enrich your stay with memorable activities that complement your visit.',
            'explore_page_section_paragraph' => 'Embark on a journey of exploration and enrichment with our curated list of things to do in and around Glasgow. Whether you are an art enthusiast, history buff, or nature lover, our prime location opens the door to a myriad of experiences. Discover local attractions, cultural gems, and outdoor adventures that complement your stay, ensuring that every moment with us is filled with excitement and discovery. Immerse yourself in the vibrant tapestry of our surroundings, creating lasting memories to cherish.',
            'explore_page_section_image' => 'images/sectionImages/explorePrimary/test_explore_page.jpg',
            'explore_page_section_image_description' => 'A photo of our luxurious pool area.',
        ]);
        DB::table('attractions')->insert([
            [
                'property_id' => $property_id,
                'attraction_header' => 'Camusport Beach',
                'attraction_paragraph' => 'Discover the epitome of coastal elegance at Camusport Beach, an idyllic retreat nestled alongside Test Hotel. With its pristine golden sands and crystal-clear waters, this beachfront haven offers an exclusive escape for our discerning guests. Whether you are seeking a leisurely stroll along the shoreline, a rejuvenating dip in the ocean, or simply basking in the suns warm embrace, Camusport Beach promises a seamless blend of relaxation and luxury. Immerse yourself in the natural beauty of this coastal paradise, complemented by our hotels unparalleled amenities and personalized service, creating a harmonious synergy between opulent accommodations and the serenity of the sea.',
                'attraction_image' => 'images/attractionListing/test_attraction_1.jpg',
                'attraction_image_description' => 'A photo of Camusport Beach.',
            ],
            [
                'property_id' => $property_id,
                'attraction_header' => 'Millside Trail',
                'attraction_paragraph' => 'Embark on a journey of discovery along The Millside Trail, an enchanting hiking experience conveniently located to the East of Test Hotel. This scenic trail beckons adventurers to explore lush landscapes, meandering through picturesque woodlands and offering breathtaking views at every turn. Whether you are an avid hiker or seeking a leisurely stroll in nature, The Millside Trail caters to all levels of outdoor enthusiasts. After an invigorating day on the trail, return to the comfort of our luxury hotel, where indulgent amenities and personalized service await.',
                'attraction_image' => 'images/attractionListing/test_attraction_2.jpg',
                'attraction_image_description' => 'A photo of The Millside Trail.',
            ],
            [
                'property_id' => $property_id,
                'attraction_header' => 'The Russell Collection',
                'attraction_paragraph' => 'Step into the cultural tapestry of The Russell Collection, a captivating museum located in close proximity to Test Hotel. This cultural gem beckons enthusiasts to explore a curated array of art and artifacts, showcasing the rich history and creativity of the region. Whether you are an art aficionado or simply seeking a dose of inspiration, this museum offers a captivating journey through time and artistic expression.',
                'attraction_image' => 'images/attractionListing/test_attraction_3.jpg',
                'attraction_image_description' => 'A photo of The Russell Collection.',
            ],
            [
                'property_id' => $property_id,
                'attraction_header' => 'Central Square Market',
                'attraction_paragraph' => 'Experience the vibrant pulse of the city at Central Square Market, a local treasure conveniently situated just streets away from Test Hotel. This bustling market invites you to immerse yourself in a sensory journey, where the aromas of freshly prepared delicacies, the vibrant colors of artisan crafts, and the lively atmosphere create an unforgettable tapestry of local culture. From farm-fresh produce to unique handmade goods, Central Square Market offers a feast for the senses.',
                'attraction_image' => 'images/attractionListing/test_attraction_4.jpg',
                'attraction_image_description' => 'A photo of Central Square Market.',
            ],
            [
                'property_id' => $property_id,
                'attraction_header' => 'Epicurus Scuba Diving',
                'attraction_paragraph' => "Dive into the exhilarating world beneath the waves with Epicurus Scuba Diving, a thrilling adventure located just steps away from Test Hotel, nestled around the scenic Camusport Beach. Explore the mesmerizing underwater landscapes and vibrant marine life under the expert guidance of the experienced Epicurus instructors.\nWhether you are a seasoned diver or a first-timer, Epicurus Scuba Diving caters to all skill levels, promising an unforgettable subaquatic experience.",
                'attraction_image' => 'images/attractionListing/test_attraction_5.jpg',
                'attraction_image_description' => 'A photo of Epicurus Scuba Diving.',
            ],
            [
                'property_id' => $property_id,
                'attraction_header' => 'WLL Nordic Style Saunas',
                'attraction_paragraph' => 'Indulge in the epitome of relaxation with WLL Nordic Style Saunas, an oasis of tranquility located only a short walk away from Test Hotel. Immerse yourself in the soothing ambiance of authentic Nordic-style saunas, meticulously designed to provide a rejuvenating escape from the everyday. The blend of traditional craftsmanship and modern luxury ensures a unique and revitalizing experience.',
                'attraction_image' => 'images/attractionListing/test_attraction_6.jpg',
                'attraction_image_description' => 'A photo of one of the WLL Nordic Style Saunas.',
            ],
        ]);
        DB::table('find_us_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Come and find Test Hotel',
            'meta_page_description' => 'Discover us at the heart of the city, offering unparalleled convenience. For precise directions, explore the map below or contact our concierge for assistance.',
            'find_us_page_section_paragraph' => 'Locating us is as easy as the decision to stay with us. Nestled in the heart of the city, our hotel is conveniently situated for your accessibility and enjoyment. Use the map below to pinpoint our exact location, and feel free to reach out to our concierge for personalized directions. We look forward to welcoming you to our doorstep, where comfort meets convenience.',
            'find_us_page_section_image' => 'images/sectionImages/findUsPrimary/test_find_us_page.jpg',
            'find_us_page_section_image_description' => 'A photo of the front of our hotel.',
        ]);
        DB::table('directions')->insert([
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the Airport',
                'directions_paragraph' => 'Upon leaving the airport, head southeast on Airport Road. Merge onto the expressway and continue for approximately 5 miles. Take the exit toward Camusport and merge onto Main Street. Follow Main Street for 2 miles, and you will find our hotel conveniently located on the right.',
            ],
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the City Center',
                'directions_paragraph' => 'Depart the city center on Central Street, heading North. Continue straight for 4 miles until you reach the intersection with Main Street. Turn left onto Main Street and follow it for 3 miles. Our hotel will be situated on the left, easily recognizable by Camusport Beach.',
            ],
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the Train Station',
                'directions_paragraph' => 'Exiting the train station, head west on Railroad Avenue. Merge onto Expressway 123 and continue for 3 miles. Take the exit toward Camusport and follow signs to Main Street. Travel 2 miles on Main Street, and you will find our hotel on the right.',
            ],
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the Bus Terminal',
                'directions_paragraph' => 'Leaving the bus terminal, head south on Motorhill Road. Merge onto City Bypass and continue for 4 miles. Take the exit toward Camusport and follow signs to Main Street. Drive 1.5 miles on Main Street, and our hotel will be on your right.',
            ],
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the Highway',
                'directions_paragraph' => 'If you are approaching from the highway, take Exit 42 toward Camusport. Merge onto Highway 456 and continue for 6 miles. Turn left onto Main Street and proceed for 2 miles. Our hotel will be on your left, easily recognizable by the scenic views of Camusport Beach.',
            ],
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the Shopping District',
                'directions_paragraph' => 'Navigating from the shopping district, head East on Shoppers Lane. Turn right onto Main Street and continue for 1 mile. Our hotel will be on your left, offering a seamless transition from shopping delights to the luxurious ambiance of our accommodations.',
            ]
        ]);
        DB::table('faq_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Your questions about Test Hotel',
            'meta_page_description' => 'Explore our FAQ page for quick answers to common queries about our hotel, amenities, and more. If you need further assistance, our dedicated team is here to help—your seamless stay starts here.',
            'faq_page_section_paragraph' => 'Welcome to our FAQ page, your go-to resource for answers to common queries and helpful information about our hotel. Whether you are curious about our amenities, reservation process, or local attractions, we have compiled a comprehensive list to ensure your stay is seamless and enjoyable. If you do not find what you are looking for, our dedicated team is always ready to assist you. Explore the FAQs below and embark on a journey of clarity and convenience with us.',
            'faq_page_section_image' => 'images/sectionImages/faqPrimary/test_faq_page.jpg',
            'faq_page_section_image_description' => 'A photo of the mirror in one of our rooms.',
        ]);
        DB::table('questions_and_answers')->insert([
            [
                'property_id' => $property_id,
                'question_label' => 'How can I make a reservation at your hotel?',
                'answer_paragraph' => 'Making a reservation is easy! Simply visit our website and use the user-friendly booking interface. Alternatively, you can call our reservation team at 0141 270 2173 for personalized assistance.',
            ],
            [
                'property_id' => $property_id,
                'question_label' => 'What amenities are included in the room rate?',
                'answer_paragraph' => 'Your room rate covers a range of amenities, including complimentary Wi-Fi, access to our fitness center, and daily housekeeping. Additionally, we offer extra pillows to ensure your stay is as comfortable and enjoyable as possible.',
            ],
            [
                'property_id' => $property_id,
                'question_label' => 'Is there parking available at the hotel?',
                'answer_paragraph' => 'Yes, we provide secure and convenient parking facilities for our guests. Please inquire about parking options and fees when making your reservation.',
            ],
            [
                'property_id' => $property_id,
                'question_label' => 'Are there dining options within the hotel?',
                'answer_paragraph' => 'Absolutely! Our hotel boasts three dining options, ranging from fine dining to casual lounges, offering a diverse culinary experience for every palate.',
            ],
            [
                'property_id' => $property_id,
                'question_label' => 'What recreational activities are available near the hotel?',
                'answer_paragraph' => 'The hotel is surrounded by various recreational opportunities, including Camusport Beach and The Millside Trail. Our concierge will be delighted to assist you in planning memorable excursions during your stay.',
            ],
            [
                'property_id' => $property_id,
                'question_label' => 'Are pets allowed in the hotel?',
                'answer_paragraph' => 'While we love pets, we maintain a pet-free environment to ensure a comfortable and allergy-free experience for all our guests.',
            ],
        ]);
    }
}
