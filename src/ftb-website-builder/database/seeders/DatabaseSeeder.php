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
        ]);
        DB::table('websites')->insert([
            'property_id' => $property_id,
            'primary_colour' => '00A980',
            'secondary_colour' => '60BD35',
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
        ]);
        DB::table('rooms')->insert([
            [
                'property_id' => $property_id,
                'room_name' => 'Single Room',
                'room_description' => 'Discover comfort for two in our spacious double room, thoughtfully designed for a relaxing stay. Enjoy modern amenities, a cozy atmosphere, and the perfect blend of style. Your retreat awaits – book now for an elevated experience.',
                'room_image_primary' => '',
            ],
            [
                'property_id' => $property_id,
                'room_name' => 'Double Room',
                'room_description' => 'Experience solo comfort in our inviting single room, tailored for a restful stay. Enjoy modern amenities and a cozy atmosphere designed just for you. Book now for a tranquil retreat.',
                'room_image_primary' => '',
            ],
        ]);
        DB::table('reviews_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Reviews of Test Hotel',
            'meta_page_description' => 'Discover delighted guest stories of exceptional hospitality and stylish comfort. Join them in experiencing our unparalleled service.',
            'reviews_page_section_paragraph' => 'Explore the genuine experiences of our guests through heartfelt reviews that capture the essence of our exceptional hospitality. From glowing testimonials about our attentive staff to raving comments on the stylish and comfortable accommodations, each review reflects the dedication we pour into creating memorable stays. We take pride in the positive stories shared by those who have made our hotel their home away from home. Join the chorus of satisfied guests and discover firsthand why our hotel is a beacon of comfort and unparalleled service.',
        ]);
        DB::table('reviews')->insert([
            [
                'property_id' => $property_id,
                'review_quote' => 'An absolute gem! From the attentive staff to the stylish and comfortable accommodations, this hotel exceeded all expectations. A perfect blend of luxury and warmth, creating an unforgettable stay. Highly recommended for a truly exceptional experience.',
                'reviewer_name' => 'Nash Waugh',
            ],
            [
                'property_id' => $property_id,
                'review_quote' => 'Exceptional stay! The modern amenities and personalized service made for a perfect getaway. Comfortable rooms, attentive staff, and a prime location — an ideal choice for a memorable and relaxing experience. Cannot wait to return!',
                'reviewer_name' => 'Nathan Douglas',
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
            'secondary_about_section_paragraph' => 'As the doors opened, our story began to unfold through the unique experiences of our cherished guests. They quickly discovered the genuine warmth radiating from our attentive staff, experienced the stylish allure embedded in every corner of our accommodations, and marveled at the seamless fusion of modern amenities with timeless charm.\nThe resounding positivity echoed in the reviews served as a testament to the success of our endeavor, further solidifying our commitment to delivering an unparalleled escape for each and every visitor. These testimonials not only inspire us but also motivate our dedicated team to continually raise the bar, ensuring that every guest enjoys a truly exceptional and memorable stay.',
            'secondary_about_section_image' => 'images/sectionImages/aboutSecondary/test_about_image_2.jpg',
            'secondary_about_section_image_description' => 'A photo of one of one of our welcoming reception rooms.',
        ]);
        DB::table('secondary_about_sections')->insert([
            'property_id' => $property_id,
            'secondary_about_section_header' => 'Where we are today',
            'secondary_about_section_paragraph' => 'Today, our hotel stands as a testament to the dedication that brought it into existence. It serves as a living story, with every check-in marking the addition of a new chapter. Whether our guests are here for business or leisure, the narrative of our establishment continues to evolve, weaving a legacy of cherished moments and leaving behind a trail of satisfied smiles.\nOur story is an ongoing journey, and we extend a warm invitation for you to become a part of it. Your chapter awaits at our doors, where each guest contributes to the vibrant tapestry of experiences that define our hotel. Join us in creating and sharing moments that make our story truly extraordinary.',
            'secondary_about_section_image' => 'images/sectionImages/aboutSecondary/test_about_image_3.jpg',
            'secondary_about_section_image_description' => 'A photo of one of one of our elegant pool areas.',
        ]);
        DB::table('explore_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Things to do near Test Hotel',
            'meta_page_description' => 'Unlock a world of experiences with our curated list of things to do in and around Glasgow. From cultural gems to outdoor adventures, enrich your stay with memorable activities that complement your visit.',
            'explore_page_section_paragraph' => 'Embark on a journey of exploration and enrichment with our curated list of things to do in and around Glasgow. Whether you are an art enthusiast, history buff, or nature lover, our prime location opens the door to a myriad of experiences. Discover local attractions, cultural gems, and outdoor adventures that complement your stay, ensuring that every moment with us is filled with excitement and discovery. Immerse yourself in the vibrant tapestry of our surroundings, creating lasting memories to cherish.',
        ]);
        DB::table('attractions')->insert([
            [
                'property_id' => $property_id,
                'attraction_header' => 'Glasgow Cathedral',
                'attraction_paragraph' => 'Explore the awe-inspiring Glasgow Cathedral, a masterpiece of medieval architecture that dates back to the 12th century. Immerse yourself in the rich history and intricate design of this iconic landmark, featuring stunning stained glass windows, a Gothic nave, and the atmospheric crypt. As you wander through its hallowed halls, you will discover centuries of Scottish history and culture, making it a must-visit destination for history enthusiasts and architecture admirers alike.',
            ],
            [
                'property_id' => $property_id,
                'attraction_header' => 'Kelvingrove Art Gallery and Museum',
                'attraction_paragraph' => 'Indulge your cultural curiosity at the Kelvingrove Art Gallery and Museum, a captivating institution nestled in the heart of Glasgow. Home to a diverse collection of art, artifacts, and exhibits, this world-class venue showcases everything from European paintings to ancient Egyptian relics. Wander through themed galleries, marvel at the Salvador Dalí masterpiece, and experience the immersive displays that bring history and art to life. With free admission, it is a perfect destination for art lovers, families, and anyone seeking a vibrant cultural experience in Glasgow.',
            ],
        ]);
        DB::table('find_us_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Come and find Test Hotel',
            'meta_page_description' => 'Discover us at the heart of Glasgow, offering unparalleled convenience. For precise directions, explore the map below or contact our concierge for assistance.',
            'find_us_page_section_paragraph' => 'Locating us is as easy as the decision to stay with us. Nestled in the heart of Glasgow, our hotel is conveniently situated for your accessibility and enjoyment. Use the map below to pinpoint our exact location, and feel free to reach out to our concierge for personalized directions. We look forward to welcoming you to our doorstep, where comfort meets convenience.',
        ]);
        DB::table('directions')->insert([
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the Airport',
                'directions_paragraph' => 'Upon leaving the airport, head southeast on Airport Road. Merge onto the expressway and continue for approximately 5 miles. Take the exit toward Finneston and merge onto Sauchiehall Street. Follow Sauchiehall Street for 2 miles, and you will find our hotel conveniently located on the right.',
            ],
            [
                'property_id' => $property_id,
                'directions_label' => 'Directions from the City Center',
                'directions_paragraph' => 'Depart the city center on Bath Street, heading North. Continue straight for 4 miles until you reach the intersection with Sauchiehall Street. Turn left onto Sauchiehall Street and follow it for 3 miles. Our hotel will be situated on the left, easily recognizable by Kelvingrove Park.',
            ],
        ]);
        DB::table('faq_pages')->insert([
            'property_id' => $property_id,
            'meta_page_title' => 'Your questions about Test Hotel',
            'meta_page_description' => 'Explore our FAQ page for quick answers to common queries about our hotel, amenities, and more. If you need further assistance, our dedicated team is here to help—your seamless stay starts here.',
            'faq_page_section_paragraph' => 'Welcome to our FAQ page, your go-to resource for answers to common queries and helpful information about our hotel. Whether you are curious about our amenities, reservation process, or local attractions, we have compiled a comprehensive list to ensure your stay is seamless and enjoyable. If you do not find what you are looking for, our dedicated team is always ready to assist you. Explore the FAQs below and embark on a journey of clarity and convenience with us.',
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
        ]);
    }
}
