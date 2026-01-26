<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Social Media Links
    |--------------------------------------------------------------------------
    |
    | Konfigurasi link sosial media sekolah
    | Ganti dengan link sosial media Anda yang sebenarnya
    |
    */

    'facebook' => env('SOCIAL_FACEBOOK', ''),
    'instagram' => env('SOCIAL_INSTAGRAM', 'https://www.instagram.com/kxkl_ubed/'),
    'youtube' => env('SOCIAL_YOUTUBE', 'https://www.youtube.com/@hapisubed'),
    'whatsapp' => env('SOCIAL_WHATSAPP', 'https://wa.me/6282323084443'),
    'twitter' => env('SOCIAL_TWITTER', ''),
    'tiktok' => env('SOCIAL_TIKTOK', ''),

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    */
    
    'phone' => env('SCHOOL_PHONE', '+62 293 123456'),
    'email' => env('SCHOOL_EMAIL', 'info@smkitihsanulfikri.sch.id'),
    'address' => env('SCHOOL_ADDRESS', 'Jl. Raya Mungkid, Magelang, Jawa Tengah 56511'),
    'website' => env('SCHOOL_WEBSITE', 'www.smkitihsanulfikri.sch.id'),
];