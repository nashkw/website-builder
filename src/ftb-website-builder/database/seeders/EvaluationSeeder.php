<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EvaluationSeeder extends Seeder
{
    /**
     * Seed the database with the property used for the evaluation.
     */
    public function run(): void
    {
        $user_id = DB::table('users')->insertGetId([
            'name' => 'Mount Edgcombe Guest House',
            'email' => 'evaluation@email.com',
            'password' => Hash::make('evaluationpass'),
        ]);
        $property_id = DB::table('properties')->insertGetId([
            'user_id' => $user_id,
            'property_name' => 'Mount Edgcombe',
            'property_address_line_1' => '23 Avenue Road',
            'property_address_line_2' => 'Torquay',
            'property_address_area' => 'Devon',
            'property_address_country' => 'England',
            'property_address_postcode' => 'TQ2 5LB',
            'property_telephone' => '+441803292310',
            'property_email' => 'info@mountedgcombe.co.uk',
            'property_youtube_link' => 'https://www.youtube.com/watch?v=KasiifzQjRE&ab_channel=TravelLover',
            'property_facebook_link' => 'https://www.facebook.com/MountEdgcombe/',
            'property_tripadvisor_link' => 'https://www.tripadvisor.co.uk/Hotel_Review-g186259-d483479-Reviews-Mount_Edgcombe_Guest_House-Torquay_English_Riviera_Devon_England.html',
            'property_booking_link' => 'https://www.mountedgcombe.co.uk/en-GB/rooms',
        ]);
        DB::table('properties')->where('id', $property_id)->update([
            'property_logo' => 'images/' . $property_id . '/logo.png',
            'property_favicon' => 'images/' . $property_id . '/favicon.ico',
        ]);
        DB::table('websites')->insert([
            'property_id' => $property_id,
            'primary_colour' => 'af6520',
            'secondary_colour' => 'f59930',
            'background_colour' => 'f7f0e9',
            'text_colour' => '361b01',
            'divider_art' => 'images/' . $property_id . '/divider_art.png',
            'font_family' => 'Raleway',
            'subdomain' => 'mountedgcombe',
            'preview_only' => false,
        ]);
        DB::table('home_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Welcome to Mount Edgcombe Guest House',
            'meta_page_description' => "'It is our pleasure to have you stay' we would like to welcome you to Mount Edgcombe Guest House, Torquay. Our elegant 9 bed Victorian Villa guest house located on a leafy avenue in Torquay on the beautiful English Riviera.",
            'cover_image_primary' => 'images/' . $property_id . '/cover_image_primary.jpg',
            'cover_image_primary_description' => 'A front facing view of our main building.',
            'intro_section_header' => "It is our pleasure to have you stay",
            'intro_section_paragraph' => 'We would like to welcome you to Mount Edgcombe, our elegant 9 bed Victorian Villa guest house. Torquay is the perfect base to explore the beautiful English Riviera, offering easy transport links for a relaxing break.',
            'intro_section_image' => 'images/' . $property_id . '/intro.jpg',
            'intro_section_image_description' => 'A photo of our reception desk.',
            'welcome_section_header' => 'Welcome to Mount Edgcombe...',
            'welcome_section_paragraph' => "We offer Bed and Breakfast packages and also an optional delicious 4 course home cooked menu on certain dates (excluding most of July and August). Please contact us to check availability as these can only be booked directly and have to be pre ordered. We use only quality produce and can cater for any specific dietary requirements.\nFor breakfast choose from a hearty full English breakfast, to set you up for the day, or if you prefer a lighter option, we offer fresh fruits, yoghurt, cereals, croissant, porridge, toast and preserves. Our dining room is light and airy and located on the ground floor, over looking a small courtyard.\nIn 2024 we will be welcoming doggy guests along with their well behaved owners! We have a limited number of dog friendly rooms on our ground floor - please contact us directly to discuss your requirements.\nWhether you are staying for your annual holiday or a short break, we aim to make your stay with us relaxing and memorable, and we look forward to meeting you. We are happy to arrange bespoke special treats for any occasion. To be guaranteed the best rates book direct.",
            'welcome_section_image' => 'images/' . $property_id . '/welcome.jpg',
            'welcome_section_image_description' => 'A photo our reception area and hallways.',
        ]);
        DB::table('secondary_cover_images')->insert([
            'property_id' => $property_id,
            'secondary_cover_image' => 'images/' . $property_id . '/cover_image_secondary_1.jpg',
            'secondary_cover_image_description' => 'A photo of our dining area.',
        ]);
        DB::table('secondary_cover_images')->insert([
            'property_id' => $property_id,
            'secondary_cover_image' => 'images/' . $property_id . '/cover_image_secondary_2.jpg',
            'secondary_cover_image_description' => 'A photo of our bar area.',
        ]);
        DB::table('rooms_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Rooms at Mount Edgcombe Guest House',
            'meta_page_description' => 'We offer a range of rooms, all en-suite with quality furnishings and free wifi. There is a large comfortable lounge and well stocked bar (hours are subject to change and availability) a perfect place to relax and unwind at the end of the day.',
            'rooms_page_section_paragraph' => "We offer a range of rooms from our smaller twin room to ‘The Edgcombe Room’ with a king size bed and luxury bathroom boasting a spa bath for 2 and a double walk in shower, perfect for a romantic getaway. Also, our Torre Suite with a king size bedroom and a separate lounge offering a 48 inch smart TV. All rooms are en-suite with quality furnishings and free wifi. There is a large comfortable lounge and well stocked bar (hours are subject to change and availability) a perfect place to relax and unwind at the end of the day.",
            'rooms_page_section_image' => 'images/' . $property_id . '/test_rooms_page.jpg',
            'rooms_page_section_image_description' => 'A photo of one of our lounge areas.',
        ]);
        $room1_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Superior (Double/Twin Ensuite)',
            'room_description' => "Our Superior rooms are large, light and located on the ground floor, boasting large elegant bay windows with black out curtains for a great night's sleep. These can be either as a twin room with two single beds or as one huge super king size, ideal for longer stays or if you have mobility issues.\nThese rooms feature crisp white bed linen, a modern wardrobe, a side table, a dressing table with a stool, a 32 inch flat screen TV, free Wi-Fi, a 44 litre fridge with an ice box, a tea tray (which is replenished daily), and an ensuite bathroom which includes a shower, a lit vanity mirror, luxury toiletries, and soft fluffy towels.",
            'room_image_primary' => 'images/' . $property_id . '/room_1_primary.jpg',
            'room_image_primary_description' => 'A photo of the room',
        ]);
        $room2_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Comfort (Double Ensuite)',
            'room_description' => "Our comfort double room offers a good size double room with the main difference being that the wash hand basin and lit vanity mirror are in the bedroom, with a small an en-suite shower and WC, suitable for couples on a short term breaks and ideal for single travellers. This comfortable double is on the first floor, at the rear of the property for a quieter stay.\nThis room features crisp white bed linen, a double wardrobe and storage, a 26 inch flat screen TV, free Wi-Fi, a tea tray (which is replenished daily), bottled water and glasses, an an ensuite bathroom which includes a shower, a WC, and soft fluffy towels.",
            'room_image_primary' => 'images/' . $property_id . '/room_2_primary.jpg',
            'room_image_primary_description' => 'A photo of the room',
        ]);
        $room3_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Executive (Double Ensuite)',
            'room_description' => "Our fabulous Executive Rooms rooms are large and elegant, both overlook the side of the property offering a serene and peaceful stay, one on the ground floor and one on the first floor, with super king size beds guaranteed to aid a perfect nights sleep.\nThese rooms feature crisp white bed linen, ample storage space, a comfortable sofa, a 40 inch flat screen TV, free Wi-Fi, a Nespresso coffee machine, a 44 litre fridge, a tea tray (which is replenished daily), bottled water and glasses, and an ensuite bathroom which includes a shower, a hand basin, a WC, a lit vanity mirror, and luxury toiletries.",
            'room_image_primary' => 'images/' . $property_id . '/room_3_primary.jpg',
            'room_image_primary_description' => 'A photo of the room',
        ]);
        $room4_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Standard (Double Ensuite)',
            'room_description' => "Our standard double rooms are ideal for couples or singles wanting a bit more space. One is located at the front of the property on the first floor with large bay windows, the other at the rear of the property offering a quieter stay. They contain one standard double bed and have plenty of room for two.\nThis room features crisp white bed linen, a double wardrobe, side tables, a 32 inch flat screen TV, free Wi-Fi, a tea tray (which is replenished daily), and an ensuite bathroom which includes a shower, a lit vanity mirror, luxury toiletries, and soft fluffy towels.",
            'room_image_primary' => 'images/' . $property_id . '/room_4_primary.jpg',
            'room_image_primary_description' => 'A photo of the room',
        ]);
        $room5_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'The Edgcombe Room (King Ensuite)',
            'room_description' => "The Edgcombe Room consists of a lovely King Size bed and elegant grey 'Chester' furniture . However, the 'WOW' factor is the large luxurious bathroom with a spacious walk in 'rain dance' shower big enough for two, and a fantastic two person whirlpool bath, perfect for a romantic getaway. The bath also features colour changing lights, radio and can reheat the water for when you really don't want to get out! The room is located in a quiet and secluded area of the house.\nThis room features a king size bed with crisp white bed linen, a 40 inch flat screen TV, free Wi-Fi, a tea tray (which is replenished daily), a Nespresso coffee machine with pods, a fridge, and an ensuite bathroom which includes luxury toiletries, soft fluffy towels, dressing gowns, and slippers.",
            'room_image_primary' => 'images/' . $property_id . '/room_5_primary.jpg',
            'room_image_primary_description' => 'A photo of the room',
        ]);
        $room6_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Executive (King Ensuite)',
            'room_description' => "Modern suite with King Size bed, ensuite shower room & separate lounge 32 inch flat screen TV in the bedroom and the lounge has a 42 inch smart TV. The lounge area has a sofa with cushions and a cosy throw. Also has two chairs and a table in the window, perfect for watching the world go by whilst drinking your coffee!\nThis room features crisp white bed linen, large bay windows, a large freestanding fan, a fridge, a Nespresso coffee machine with pods, a tea tray (which is replenished daily), and an ensuite bathroom which includes a shower, comfortable white slippers and dressing gowns, luxury toiletries, and soft fluffy towels.",
            'room_image_primary' => 'images/' . $property_id . '/room_6_primary.jpg',
            'room_image_primary_description' => 'A photo of the room',
        ]);
        $room7_id = DB::table('rooms')->insertGetId([
            'property_id' => $property_id,
            'room_name' => 'Standard (Twin Ensuite)',
            'room_description' => "Our single / twin room offers a cosy experience, with two single beds. The room is lovely and bright and has ensuite facilities with a shower, wash hand basin and separate WC, perfect for a comfortable stay. The room is ideal for single travellers who prefer not to climb the stairs.\nThis room features crisp white bed linen, a wardrobe, a flat screen TV, free Wi-Fi, a tea tray (which is replenished daily), and an ensuite bathroom which includes a shower, a hand basin, a WC, and soft fluffy towels.",
            'room_image_primary' => 'images/' . $property_id . '/room_7_primary.jpg',
            'room_image_primary_description' => 'A photo of the room',
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room1_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_1_secondary_1.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room1_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_1_secondary_2.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room1_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_1_secondary_3.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room1_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_1_secondary_4.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room1_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_1_secondary_5.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room1_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_1_secondary_6.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room2_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_2_secondary_1.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room2_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_2_secondary_2.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_3_secondary_1.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_3_secondary_2.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_3_secondary_3.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_3_secondary_4.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_3_secondary_5.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room3_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_3_secondary_6.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_4_secondary_1.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room4_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_4_secondary_2.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room5_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_5_secondary_1.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room5_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_5_secondary_2.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room5_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_5_secondary_3.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room5_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_5_secondary_4.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room6_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_6_secondary_1.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room6_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_6_secondary_2.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room6_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_6_secondary_3.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room6_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_6_secondary_4.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room6_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_6_secondary_5.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
        ]);
        DB::table('secondary_room_images')->insert([
            [
                'room_id' => $room7_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_7_secondary_1.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
            ],
            [
                'room_id' => $room7_id,
                'secondary_room_image' => 'images/' . $property_id . '/room_7_secondary_2.jpg',
                'secondary_room_image_description' => 'A photo of the room.',
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
