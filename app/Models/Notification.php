<?php

namespace App\Models;

use App\Enums\NotificationPosition;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'message',
        'variant',
        'position',
        'custom_background_color',
        'custom_text_color',
        'enabled',
        'start_date',
        'end_date',
        'image_url',
        'display_after_miliseconds',
        'has_countdown',
        'target_audience',
        'action_text',
        'action_link',
        'action_background_color',
        'action_text_color',
        'cookie_name',
        'cookie_lifetime_in_days',
    ];

    protected function casts(): array
    {
        return [
            'enabled' => 'boolean',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'has_countdown' => 'boolean',
            'target_audience' => 'array',
            'cookie_lifetime_in_days' => 'integer',
        ];
    }

    // attribute for apply top margin to image if the image
    // doesn't have countdown and not is full top or down positions
    // image_top_margin
    public function getImageTopMarginAttribute(): string
    {
        return $this->image_url && ! $this->has_countdown && ! in_array(
            $this->position, [
                NotificationPosition::FullTop,
                NotificationPosition::FullBottom
            ]) ? '20px' : '0';
    }
}
