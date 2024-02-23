<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestHotelPartialSeeder extends Seeder
{
    /**
     * Seed the database with a partially populated test property.
     */
    public function run(): void
    {
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Partial Testing User',
            'email' => 'testinghotel@example.com',
            'password' => Hash::make('testinghotelpass'),
        ]);
        $property_id = DB::table('properties')->insertGetId([
            'user_id' => $user_id,
            'property_name' => 'Testing Hotel',
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
        ]);
        DB::table('properties')->where('id', $property_id)->update([
            'property_logo' => 'images/' . $property_id . '/test_logo.png',
            'property_favicon' => 'images/' . $property_id . '/favicon.ico',
        ]);
        DB::table('websites')->insert([
            'property_id' => $property_id,
            'primary_colour' => '10b981',
            'secondary_colour' => 'b1cc16',
            'background_colour' => '010200',
            'text_colour' => 'fefffd',
            'divider_art' => 'images/' . $property_id . '/test_divider_art.png',
            'font_family' => 'Roboto Slab',
            'subdomain' => 'testinghotel',
            'preview_only' => false,
        ]);
        DB::table('home_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Welcome to Testing Hotel',
            'meta_page_description' => 'Experience luxury at its finest. Stylish accommodations, top-notch amenities, and personalized service in a prime location. Indulge in gourmet dining, spa retreats, and unparalleled hospitality. Book now for an unforgettable stay.',
            'cover_image_primary' => 'images/' . $property_id . '/test_cover_image_1.jpg',
            'cover_image_primary_description' => 'A front facing view of our main building.',
            'intro_section_header' => "Glasgow's finest",
            'intro_section_paragraph' => 'Discover luxury at its peak with stylish accommodations, top-notch amenities, and personalized service. Indulge in gourmet dining, spa retreats, and unparalleled hospitality. Book now for an unforgettable stay.',
            'intro_section_image' => 'images/' . $property_id . '/test_intro_image.jpg',
            'intro_section_image_description' => 'A photo of our gorgeous lounge area.',
            'welcome_section_header' => 'Welcome to Testing Hotel...',
            'welcome_section_paragraph' => 'Welcome to a world of unparalleled hospitality and comfort! We are delighted to have you as our guest. From the moment you step through our doors, expect an experience tailored to exceed your expectations. Our dedicated team is committed to ensuring your stay is nothing short of extraordinary. Whether you are here for business or leisure, we invite you to relax, indulge, and make yourself at home. Your journey with us begins now, and we are honored to be a part of it.',
            'welcome_section_image' => 'images/' . $property_id . '/test_welcome_image.jpg',
            'welcome_section_image_description' => 'A photo of one of our sleek modern hallways.',
        ]);
        DB::table('secondary_cover_images')->insert([
            'property_id' => $property_id,
            'secondary_cover_image' => 'images/' . $property_id . '/test_cover_image_2.jpg',
            'secondary_cover_image_description' => 'A photo of one of our fashionable lobby areas.',
        ]);
        DB::table('secondary_cover_images')->insert([
            'property_id' => $property_id,
            'secondary_cover_image' => 'images/' . $property_id . '/test_cover_image_3.jpg',
            'secondary_cover_image_description' => 'A photo of one of our beautiful waiting rooms.',
        ]);
        DB::table('rooms_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Rooms at Testing Hotel',
            'meta_page_description' => 'Experience pure comfort and style in our meticulously designed rooms. Whether you are here for business or leisure, indulge in modern amenities and elegant decor. Book now for a stay that redefines luxury.',
            'rooms_page_section_paragraph' => 'Step into a realm of luxury and tranquility with our meticulously designed rooms. Each space is a sanctuary of comfort, featuring modern amenities and elegant decor to elevate your stay. Whether you are seeking a restful retreat or a productive work environment, our rooms cater to your every need. Immerse yourself in the perfect blend of style and functionality. Book your room now for an exceptional experience that goes beyond accommodation – it is a celebration of comfort and sophistication.',
            'rooms_page_section_image' => 'images/' . $property_id . '/test_rooms_page.jpg',
            'rooms_page_section_image_description' => 'A photo of one of our gorgeous lounge areas.',
        ]);
        $room1_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Standard Double',
            'room_description' => 'Discover comfort for two in our spacious double room, thoughtfully designed for a relaxing stay. Enjoy modern amenities, a cozy atmosphere, and the perfect blend of style. Your retreat awaits – book now for an elevated experience.',
            'room_image_primary' => 'images/' . $property_id . '/test_room_1.jpg',
            'room_image_primary_description' => 'A photo of one of our standard double rooms.',
        ]);
        $room2_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Double Deluxe',
            'room_description' => 'Indulge in the epitome of luxury with our Double Deluxe Rooms, where sophistication meets unparalleled comfort. Elegantly designed to exceed expectations, these opulent retreats boast spacious interiors, lavish furnishings, and panoramic views that redefine the art of relaxation. Immerse yourself in a haven of tranquility, where every detail, from the sumptuous bedding to the carefully curated amenities, is crafted to elevate your stay. Whether you are seeking a romantic getaway or simply unwinding in style, our Double Deluxe Rooms provide an enchanting escape in the heart of luxury, ensuring an unforgettable experience for the discerning traveler.',
            'room_image_primary' => 'images/' . $property_id . '/test_room_2.jpg',
            'room_image_primary_description' => 'A photo of one of our double deluxe rooms.',
        ]);
        $room3_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Standard Twin',
            'room_description' => 'Experience refined comfort and chic sophistication in our luxurious Twin Rooms. Thoughtfully designed for the discerning traveler, these rooms offer a harmonious blend of style and functionality. Immerse yourself in the plush surroundings adorned with modern amenities, ensuring a seamless stay. Whether you are traveling with a companion or seeking a spacious haven for yourself, our Twin Rooms provide the perfect retreat. Revel in the opulence of our hotel, where every detail is curated to exceed your expectations, promising an unforgettable stay in the lap of luxury.',
            'room_image_primary' => 'images/' . $property_id . '/test_room_3.jpg',
            'room_image_primary_description' => 'A photo of one of our twin rooms.',
        ]);
        $room4_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Swan Suite',
            'room_description' => 'Indulge in the pinnacle of romance with our exquisite Swan Suite, a haven for love and luxury. This enchanting retreat is meticulously designed to captivate the senses, offering an intimate escape for couples seeking a romantic getaway. The Swan Suite features a blend of timeless elegance and modern opulence, creating an atmosphere of pure romance. Revel in the spacious interiors, adorned with tasteful décor and sumptuous furnishings. Immerse yourselves in the allure of the suites private amenities, from a lavish en-suite spa to a breathtaking view that sets the stage for unforgettable moments. Elevate your romantic experience with the Swan Suite, where every detail is crafted to ignite passion and create cherished memories in the lap of unparalleled luxury.',
            'room_image_primary' => 'images/' . $property_id . '/test_room_4.jpg',
            'room_image_primary_description' => 'A photo of our Swan Suite.',
        ]);
        DB::table('secondary_room_images')->insert([
            'room_id' => $room1_id,
            'secondary_room_image' => 'images/' . $property_id . '/test_room_1_1.jpg',
            'secondary_room_image_description' => 'A photo of one of our standard double rooms.',
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room2_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_2_1.jpg',
                'secondary_room_image_description' => 'A photo of one of our double deluxe rooms.',
            ],
            [
                'room_id' => $room2_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_2_2.jpg',
                'secondary_room_image_description' => 'A photo of one of our double deluxe rooms.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_3_1.jpg',
                'secondary_room_image_description' => 'A photo of one of our twin rooms.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_3_2.jpg',
                'secondary_room_image_description' => 'A photo of one of our twin rooms.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_3_3.jpg',
                'secondary_room_image_description' => 'A photo of one of our twin rooms.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_4_1.jpg',
                'secondary_room_image_description' => 'A photo of our Swan Suite.',
            ],
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_4_2.jpg',
                'secondary_room_image_description' => 'A photo of our Swan Suite.',
            ],
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/' . $property_id . '/test_room_4_3.jpg',
                'secondary_room_image_description' => 'A photo of our Swan Suite.',
            ],
        ]);
        DB::table('page_flags')->insert([
            'property_id' => $property_id,
            'has_home_page' => true,
            'has_rooms_page' => true,
            'has_reviews_page' => false,
            'has_about_page' => false,
            'has_explore_page' => false,
            'has_find_us_page' => false,
            'has_faq_page' => false,
        ]);
    }
}
