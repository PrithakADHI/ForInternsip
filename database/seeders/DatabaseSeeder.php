<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['site_main_logo', Null],
            ['site_footer_logo', Null],
            ['site_information', 'Suspendisse non sem ante. Cras pretium gravida leo a convallis. Nam malesuada interdum metus, sit amet dictum ante congue eu. Maecenas ut maximus enim.'],
            ['map', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7064.975251392001!2d85.3221863!3d27.7022268!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1907be5eca8b%3A0x295dba5f53849f77!2sSeneca%20Education%20Consultancy%20Pvt.%20Ltd.!5e0!3m2!1sen!2snp!4v1683805165859!5m2!1sen!2snp'],
            ['site_copyright', '2022 All right Reserved'],
            ['site_contact', '9841617710'],
            ['site_email', 'info@internship.com.np'],
            ['site_contact2', '+01 5553696'],
            ['site_email2', 'internship@gmail.com'],
            ['apply_now_link', null],
            ['office_hour', '10 am - 5 pm'],
            ['office_location', 'Lankupool, Bharatpur, Chitwan'],

            ['course_section_title', 'Courses We Offer ?'],
            ['country_section_title', 'Countries We Offer ?'],
            ['blog_section_title', 'Latest Blog & News'],
            ['team_section_title', 'Meet Our Experts'],
            ['testimonial_section_title', 'What Our Client Says'],
            ['faq_section_title', 'Get every single answer here.'],
            ['faq_section_description', 'A business or organization established to provide a particular service, typically one that involves a organizing transactions.'],

            ['homepage_seo_title', 'Seneca Education'],
            ['homepage_seo_description', 'Seneca Education'],
            ['homepage_seo_keywords', 'Seneca Education'],
            ['fav_icon', null],

            ['about_section_title', 'A Few Words About the Consultancy'],
            ['about_section_description', 'With the help of our knowledge and experience, we can determine which universities are best for each student. We are able to provide our students with the best services. For the best colleges and educational institutions in the world, we serve as representatives and recruiters. For students wishing to pursue their academic interests in some of the most amazing countries in the world, such as Australia, United Kingdom, Canada, New Zealand, and the United States, we provide complete advising and application management services.'],
            ['about_section_slogan', 'About Our Consultancy'],
            ['students_count', '5000+ Students'],
            ['experienced_title', '25+'],
            ['country_count', '10+ Countries'],
            ['about_section_image', null],
            ['student_count_description', 'consectetur adipiscing elit sed do eiusmod tem incid idunt.'],
            ['experienced_description', 'Years of Experience'],
            ['country_count_description', 'consectetur adipiscing elit sed do eiusmod tem incid idunt.'],

            ['about_page_banner', null],
            ['course_page_banner', null],
            ['country_page_banner', null],
            ['blog_page_banner', null],
            ['service_page_banner', null],

            ['video_section_title', "We're Qeducato & We're Diffirent"],
            ['video_section_description', 'Our community is being called to reimagine the future. As the only university where a renowned design school colleges'],
            ['video_section_image', null],
            ['video_section_link', 'https://www.youtube.com/watch?v=vdMPP47nLhc'],

            ['contact_section_description', 'We love to hear from you. Our friendly team is always here to chat'],
            ['contact_seo_title', 'Internship - Contact'],
            ['contact_seo_keywords', 'Internship'],
            ['contact_seo_description', 'Internship Internship'],
            ['contact_image', null],

            ['feature_section_title', 'Our Best Features'],
            ['feature_section_description', 'Special wedding garments are often worn, and the ceremony is sometimes followed by a wedding reception. Music, poetry.'],
            ['feature_section_image', null],

            ['countries_seo_title', 'Internship - countries'],
            ['countries_seo_keywords', 'countries'],
            ['countries_seo_description', 'countries Internship'],

            ['blogs_seo_title', 'Internship - blogs'],
            ['blogs_seo_keywords', 'blogs'],
            ['blogs_seo_description', 'blogs Internship'],

            ['services_seo_title', 'Internship - services'],
            ['services_seo_keywords', 'services'],
            ['services_seo_description', 'services Internship'],

            ['courses_seo_title', 'Internship - courses'],
            ['courses_seo_keywords', 'courses'],
            ['courses_seo_description', 'courses Internship'],
        ];

        if (count($items)) {
            foreach ($items as $item) {
                \App\Models\Setting::create([
                    'key' => $item[0],
                    'value' => $item[1],
                ]);
            }
        }

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@internship.com',
            'password' => Hash::make('password'),
        ]);
    }
}
