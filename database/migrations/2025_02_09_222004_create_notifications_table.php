<?php

use App\Enums\NotificationPosition;
use App\Enums\NotificationVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->enum('variant', NotificationVariant::forMigration())->nullable();
            $table->enum('position', NotificationPosition::forMigration())->default(NotificationPosition::FullTop);
            $table->string('custom_background_color')->nullable();
            $table->string('custom_text_color')->nullable();
            $table->boolean('enabled')->default(true);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('image_url')->nullable();
            $table->unsignedSmallInteger('display_after_miliseconds')->default(0);
            $table->boolean('has_countdown')->default(false);
            $table->json('target_audience')->nullable(); // JSON para roles/permisos/membresías específicos
            $table->string('action_text')->nullable();
            $table->string('action_link')->nullable();
            $table->string('action_background_color')->nullable();
            $table->string('action_text_color')->nullable();
            $table->string('cookie_name')->unique()->nullable();
            $table->unsignedSmallInteger('cookie_lifetime_in_days')->default(30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
