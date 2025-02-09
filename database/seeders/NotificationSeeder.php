<?php

namespace Database\Seeders;

use App\Enums\NotificationPosition;
use App\Enums\NotificationVariant;
use App\Models\Notification;
use App\Models\Role;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        // right center Halloween with image, countdown and action
        Notification::create([
            'title' => 'Promoción Halloween',
            'message' => '¡Aprovecha nuestra promoción de Halloween! Descuentos de hasta el 50% en todos nuestros productos.',
            'custom_background_color' => '#FF4500',
            'custom_text_color' => '#FFFFFF',
            'position' => NotificationPosition::RightCenter,
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addMinute(),
            'image_url' => 'https://img.freepik.com/fotos-premium/fondo-halloween-calabazas-ilustracion-vectorial_941097-5208.jpg?w=996',
            'display_after_miliseconds' => 3000,
            'has_countdown' => true,
            'target_audience' => ['roles' => [Role::USER]],
            'action_text' => 'Ver promoción',
            'action_link' => 'http://localhost/halloween-promotion',
            'action_background_color' => '#000000',
            'action_text_color' => '#FF4500',
            'cookie_name' => 'my_site_notification_halloween_promotion_2024',
            'cookie_lifetime_in_days' => 7,
        ]);

        // left center Christmas with custom colors and action
        Notification::create([
            'title' => '🎅 ¡Feliz Navidad! 🎅',
            'message' => '¡Felices fiestas! Que la magia de la Navidad llene tu hogar de amor y felicidad.',
            'custom_background_color' => '#DD3333',
            'custom_text_color' => '#FFFFFF',
            'position' => NotificationPosition::BottomLeft,
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addDays(40)->endOfDay(),
            'display_after_miliseconds' => 5000,
            'has_countdown' => false,
            'target_audience' => ['roles' => [Role::USER]],
            'action_text' => 'Ver promoción',
            'action_link' => 'http://localhost/christmas-promotion',
            'cookie_name' => 'my_site_notification_christmas_2024',
            'cookie_lifetime_in_days' => 30,
        ]);

        // top full black friday with countdown and action
        Notification::create([
            'title' => 'Black Friday',
            'message' => '¡Aprovecha nuestra promoción de Black Friday! Descuentos de hasta el 70% en todos nuestros productos.',
            'variant' => NotificationVariant::Error,
            'position' => NotificationPosition::FullTop,
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addDays(3)->endOfDay(),
            'display_after_miliseconds' => 0,
            'has_countdown' => true,
            'action_text' => 'Ver promoción',
            'action_link' => 'http://localhost/black-friday-promotion',
            'action_background_color' => '#000000',
            'action_text_color' => '#FF0000',
            'cookie_name' => 'my_site_notification_black_friday_2024',
            'cookie_lifetime_in_days' => 3,
        ]);

        // bottom full new year with action
        Notification::create([
            'title' => '¡Feliz Año Nuevo!',
            'message' => '¡Feliz Año Nuevo! Que el 2025 esté lleno de éxitos y bendiciones para ti y tus seres queridos.',
            'variant' => NotificationVariant::Info,
            'position' => NotificationPosition::FullBottom,
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addDays(7)->endOfDay(),
            'display_after_miliseconds' => 0,
            'has_countdown' => false,
            'target_audience' => ['roles' => [Role::USER]],
            'action_text' => 'Ver promoción',
            'action_link' => 'http://localhost/new-year-promotion',
            'cookie_name' => 'my_site_notification_new_year_2025',
            'cookie_lifetime_in_days' => 7,
        ]);

        // center full valentine with image and action
        Notification::create([
            'title' => '¡Feliz Día de San Valentín!',
            'message' => '¡Feliz Día de San Valentín! Celebra el amor con nuestra promoción especial.',
            'position' => NotificationPosition::Center,
            'custom_background_color' => '#FF69B4',
            'custom_text_color' => '#FFFFFF',
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addDays(7)->endOfDay(),
            'image_url' => 'https://img.freepik.com/vector-premium/feliz-dia-san-valentin-corazon-amor-kawaii-caracter_25030-30561.jpg?w=2000',
            'display_after_miliseconds' => 8000,
            'has_countdown' => false,
            'target_audience' => ['roles' => [Role::USER]],
            'action_text' => 'Ver promoción',
            'action_link' => 'http://localhost/valentines-day-promotion',
            'cookie_name' => 'my_site_notification_valentines_day_2025',
            'cookie_lifetime_in_days' => 7,
            'action_background_color' => '#000000',
            'action_text_color' => '#FF69B4',
        ]);

        // center security alert with action for admins
        Notification::create([
            'title' => '¡Alerta de seguridad!',
            'message' => 'Se ha detectado un error al procesar la actividad de seguridad. Por favor, revisa el registro de actividad.',
            'variant' => NotificationVariant::Error,
            'position' => NotificationPosition::Center,
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addDay()->endOfDay(),
            'display_after_miliseconds' => 0,
            'has_countdown' => false,
            'target_audience' => ['roles' => [Role::ADMIN]],
            'action_text' => 'Ver actividad',
            'action_link' => 'http://localhost/security-activity',
            'cookie_name' => 'my_site_notification_security_alert_2024',
            'cookie_lifetime_in_days' => 1,
        ]);

        // left center without countdown, image and action
        Notification::create([
            'title' => '¡Feliz Día de la Madre!',
            'message' => '¡Feliz Día de la Madre! Celebra con nosotros y disfruta de un 20% de descuento en todos nuestros productos.',
            'position' => NotificationPosition::LeftCenter,
            'custom_background_color' => '#FF69B4',
            'custom_text_color' => '#FFFFFF',
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addDays(7)->endOfDay(),
            'display_after_miliseconds' => 5000,
            'has_countdown' => true,
            'target_audience' => ['roles' => [Role::USER]],
            'action_text' => 'Ver promoción',
            'action_link' => 'http://localhost/mothers-day-promotion',
            'cookie_name' => 'my_site_notification_mothers_day_2025',
            'cookie_lifetime_in_days' => 7,
            'action_background_color' => '#000000',
            'action_text_color' => '#FF69B4',
        ]);

        // bottom center without countdown, image and action
        Notification::create([
            'title' => '¡Feliz Día del Padre!',
            'message' => '¡Feliz Día del Padre! Celebra con nosotros y disfruta de un 20% de descuento en todos nuestros productos.',
            'position' => NotificationPosition::BottomCenter,
            'custom_background_color' => '#4169E1',
            'custom_text_color' => '#FFFFFF',
            'enabled' => true,
            'start_date' => now()->startOfDay(),
            'end_date' => now()->addDays(7)->endOfDay(),
            'display_after_miliseconds' => 5000,
            'has_countdown' => false,
            'target_audience' => ['roles' => [Role::USER]],
            'cookie_name' => 'my_site_notification_fathers_day_2025',
            'cookie_lifetime_in_days' => 7,
        ]);
    }
}
