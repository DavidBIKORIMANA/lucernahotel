<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        // ── Home Sections ──
        $sections = [
            ['section_key' => 'hero', 'eyebrow' => '★★★  ·  Kabgayi, Rwanda', 'title' => 'The Most <em>Welcoming</em><br>Sanctuary in Rwanda', 'description' => 'Rooted in Catholic hospitality. Elevated by world-class luxury.', 'button_text' => 'Book Now', 'button_url' => '#booking'],
            ['section_key' => 'about', 'eyebrow' => 'Welcome to Lucerna Kabgayi', 'title' => 'A Sanctuary of <em>Hospitality</em> & Grace', 'description' => 'Established with deep-rooted Catholic values, Lucerna Kabgayi Hotel stands as one of Rwanda\'s most distinguished retreats — where every guest is welcomed not merely as a visitor, but as a cherished soul deserving of exceptional care.', 'image' => 'frontend/assets/img/about-img.jpg', 'badge_value' => '3★', 'badge_label' => 'Hotel', 'button_text' => 'Plan Your Stay', 'button_url' => '#contact'],
            ['section_key' => 'rooms', 'eyebrow' => 'Our Rooms', 'title' => 'Comfort & <em>Elegance</em> in Every Room', 'description' => 'Each room is a carefully composed haven — blending Rwandan warmth with world-class luxury.', 'button_text' => 'View All Rooms', 'button_url' => '/rooms'],
            ['section_key' => 'halls', 'eyebrow' => 'Events & Conferences', 'title' => 'Where Great <em>Moments</em> Unfold', 'description' => 'World-class halls for conferences, weddings, and landmark celebrations.'],
            ['section_key' => 'amenities', 'eyebrow' => 'Our Offerings', 'title' => 'World-Class <em>Experiences</em> Await'],
            ['section_key' => 'dining', 'eyebrow' => 'Gastronomy', 'title' => 'A Table Set<br>with <em>Passion</em>', 'description' => 'Our culinary team crafts every meal as an act of hospitality — drawing from Rwandan heritage and global traditions.', 'image' => 'frontend/assets/img/resto_bar/resto.jpg'],
            ['section_key' => 'events', 'eyebrow' => 'Events & Conferences', 'title' => 'Where Great <em>Decisions</em> Are Made', 'description' => 'Rwanda\'s finest conference and events facilities — purpose-built for productivity, inspiring in design, impeccable in service.', 'description_2' => 'From boardroom sessions to grand celebrations, our events team orchestrates every detail with precision.', 'image' => 'frontend/assets/img/DSC_0319.jpg', 'badge_value' => '300', 'badge_label' => 'Guest Capacity', 'button_text' => 'Enquire About Events', 'button_url' => '#contact'],
            ['section_key' => 'testimonials', 'eyebrow' => 'Guest Voices', 'title' => 'Words That <em>Honour</em> Us'],
            ['section_key' => 'contact', 'eyebrow' => 'Get In Touch', 'title' => 'Begin Your <em>Journey</em>', 'description' => 'Our concierge team is ready to curate a bespoke experience for you — personal retreat, family stay, or grand corporate event.'],
            ['section_key' => 'mission', 'eyebrow' => 'Our Mission', 'title' => 'Our Mission', 'description' => 'To radiate warmth and exceptional customer-centred service while embracing the beautiful diversity of our guests with open hearts, rooted in Catholic hospitality.'],
            ['section_key' => 'vision', 'eyebrow' => 'Our Vision', 'title' => 'Our Vision', 'description' => 'To be a prestigious, high-quality hotel known across Rwanda and beyond for world-class accommodation, conference facilities, and genuine African hospitality.'],
        ];
        foreach ($sections as $s) {
            \App\Models\HomeSection::updateOrCreate(['section_key' => $s['section_key']], $s);
        }

        // ── Hero Slides ──
        $slides = [
            ['image' => 'frontend/assets/img/home-one.jpg', 'alt_text' => 'Lucerna', 'sort_order' => 1, 'status' => true],
            ['image' => 'frontend/assets/img/about-img.jpg', 'alt_text' => 'Accommodation', 'sort_order' => 2, 'status' => true],
            ['image' => 'frontend/assets/img/DSC_0224.jpg', 'alt_text' => 'Dining', 'sort_order' => 3, 'status' => true],
            ['image' => 'frontend/assets/img/DSC_0325.jpg', 'alt_text' => 'Grounds', 'sort_order' => 4, 'status' => true],
        ];
        \App\Models\HeroSlide::query()->delete();
        foreach ($slides as $s) { \App\Models\HeroSlide::create($s); }

        // ── Hero Stats ──
        $stats = [
            ['counter_value' => '48+', 'counter_label' => 'Luxury Rooms', 'sort_order' => 1],
            ['counter_value' => '★★★', 'counter_label' => 'Hotel Rating', 'sort_order' => 2],
            ['counter_value' => '3', 'counter_label' => 'Dining Venues', 'sort_order' => 3],
            ['counter_value' => '300', 'counter_label' => 'Conference Seats', 'sort_order' => 4],
        ];
        \App\Models\HeroStat::query()->delete();
        foreach ($stats as $s) { \App\Models\HeroStat::create($s); }

        // ── About Pillars ──
        $pillars = [
            ['name' => 'Faith & Hospitality', 'description' => 'Every detail rooted in Catholic values and genuine welcome.', 'sort_order' => 1],
            ['name' => 'Rwandan Warmth', 'description' => 'Celebrating local culture, heritage, and our homeland\'s beauty.', 'sort_order' => 2],
            ['name' => 'World-Class Service', 'description' => 'Professional standards delivered with personal care and grace.', 'sort_order' => 3],
            ['name' => 'Timeless Elegance', 'description' => 'Refined spaces that endure in the memory of every guest.', 'sort_order' => 4],
        ];
        \App\Models\AboutPillar::query()->delete();
        foreach ($pillars as $p) { \App\Models\AboutPillar::create($p); }

        // ── Amenities (Our Offerings) ──
        $amenities = [
            ['icon' => '✦', 'name' => 'Fine Dining', 'description' => 'Curated menus celebrating Rwandan flavours alongside international cuisine.', 'sort_order' => 1, 'status' => true],
            ['icon' => '◈', 'name' => 'Conference Centre', 'description' => 'State-of-the-art facilities for up to 300 delegates with full AV support.', 'sort_order' => 2, 'status' => true],
            ['icon' => '❧', 'name' => 'Serene Gardens', 'description' => 'Manicured grounds — a tranquil retreat for reflection and morning walks.', 'sort_order' => 3, 'status' => true],
            ['icon' => '◎', 'name' => '24/7 Concierge', 'description' => 'Our dedicated team attends to every detail of your stay with quiet care.', 'sort_order' => 4, 'status' => true],
        ];
        \App\Models\Amenity::query()->delete();
        foreach ($amenities as $a) { \App\Models\Amenity::create($a); }

        // ── Featured Amenities On-Site ──
        $featured = [
            ['icon_key' => 'garden', 'name' => 'Outdoor Garden', 'note' => null, 'sort_order' => 1, 'status' => true],
            ['icon_key' => 'linen', 'name' => 'Fresh Linen Provided', 'note' => 'All Rooms & Suites', 'sort_order' => 2, 'status' => true],
            ['icon_key' => 'business', 'name' => 'Business Center', 'note' => null, 'sort_order' => 3, 'status' => true],
            ['icon_key' => 'meeting', 'name' => 'Meeting Space', 'note' => null, 'sort_order' => 4, 'status' => true],
            ['icon_key' => 'restaurant', 'name' => 'Restaurant & Bar', 'note' => 'Complimentary Water', 'sort_order' => 5, 'status' => true],
            ['icon_key' => 'fitness', 'name' => 'Fitness Center', 'note' => 'Complimentary', 'sort_order' => 6, 'status' => true],
            ['icon_key' => 'laundry', 'name' => 'On-Site Laundry', 'note' => null, 'sort_order' => 7, 'status' => true],
            ['icon_key' => 'frontdesk', 'name' => '24-Hour Front Desk', 'note' => null, 'sort_order' => 8, 'status' => true],
        ];
        \App\Models\FeaturedAmenity::query()->delete();
        foreach ($featured as $f) { \App\Models\FeaturedAmenity::create($f); }

        // ── Dining Items ──
        $dining = [
            ['name' => 'The Garden Restaurant', 'time_text' => '06:30 – 22:30', 'sort_order' => 1],
            ['name' => 'Lucerna Bar & Lounge', 'time_text' => '11:00 – 00:00', 'sort_order' => 2],
            ['name' => 'Private Dining Room', 'time_text' => 'By Reservation', 'sort_order' => 3],
            ['name' => 'Conference Catering', 'time_text' => 'Full-day Service', 'sort_order' => 4],
        ];
        \App\Models\DiningItem::query()->delete();
        foreach ($dining as $d) { \App\Models\DiningItem::create($d); }

        // ── Event Features ──
        $events = [
            ['name' => 'Grand Ballroom', 'description' => 'Up to 300 guests, theatre style, full AV', 'sort_order' => 1],
            ['name' => 'Executive Boardroom', 'description' => 'Intimate 20-seat meetings', 'sort_order' => 2],
            ['name' => 'Breakout Spaces', 'description' => 'Four flexible rooms for workshops', 'sort_order' => 3],
            ['name' => 'Garden Terrace', 'description' => 'Open-air receptions under Rwanda\'s sky', 'sort_order' => 4],
        ];
        \App\Models\EventFeature::query()->delete();
        foreach ($events as $e) { \App\Models\EventFeature::create($e); }

        // ── Hotel Information ──
        $infos = [
            ['group' => 'Policies', 'title' => 'Check-in: 2:00 PM', 'detail' => null, 'icon' => 'clock', 'sort_order' => 1],
            ['group' => 'Policies', 'title' => 'Check-out: 12:00 PM', 'detail' => null, 'icon' => 'clock', 'sort_order' => 2],
            ['group' => 'Policies', 'title' => 'Minimum Age to Check In: 18', 'detail' => null, 'icon' => 'user', 'sort_order' => 3],
            ['group' => 'Policies', 'title' => 'Smoke Free Property', 'detail' => null, 'icon' => 'no', 'sort_order' => 4],
            ['group' => 'Services', 'title' => 'Front Desk', 'detail' => 'Staffed 24/7', 'icon' => 'phone', 'sort_order' => 5],
            ['group' => 'Services', 'title' => 'Airport Transfer', 'detail' => 'Available on request', 'icon' => 'truck', 'sort_order' => 6],
            ['group' => 'Services', 'title' => 'Parking', 'detail' => 'Complimentary On-Site', 'icon' => 'pin', 'sort_order' => 7],
            ['group' => 'Services', 'title' => 'Restaurant', 'detail' => 'Open daily 06:30 – 22:30', 'icon' => 'cup', 'sort_order' => 8],
            ['group' => 'Accessibility & Pet Policy', 'title' => 'Accessible Facilities', 'detail' => 'Ramps & accessible rooms available', 'icon' => 'accessibility', 'sort_order' => 9],
            ['group' => 'Accessibility & Pet Policy', 'title' => 'Pet Policy', 'detail' => 'Pets not allowed', 'icon' => 'no', 'sort_order' => 10],
            ['group' => 'Accessibility & Pet Policy', 'title' => 'Safety & Security', 'detail' => '24-hour security on premises', 'icon' => 'shield', 'sort_order' => 11],
        ];
        \App\Models\HotelInfo::query()->delete();
        foreach ($infos as $i) { \App\Models\HotelInfo::create($i); }

        // ── Site Settings ──
        \App\Models\SiteSetting::updateOrCreate(['id' => 1], [
            'logo' => 'logo.png',
            'phone' => '+250 794 191 115',
            'address' => 'Muhanga, Kabgayi, Rwanda',
            'email' => 'hotellucernakabgayi@gmail.com',
            'copyright' => '© ' . date('Y') . ' Lucerna Kabgayi Hotel. All rights reserved.',
            'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6149.053947903886!2d29.754994947779355!3d-2.08832623103027!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dccb9e7e84a8c1%3A0xbf93699bed85f0f!2sLucerna-Kabgayi%20Hotel!5e0!3m2!1sen!2sus!4v1707836567416!5m2!1sen!2sus',
            'checkin_time' => '14:00',
            'checkout_time' => '11:00',
        ]);
    }
}
