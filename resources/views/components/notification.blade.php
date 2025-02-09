@foreach ($notifications as $notification)
    <div
        id="notification-{{ $notification->id }}"
        class="hide notification {{ $notification->position }} {{ $notification->variant }}"
        style="
            background-color: {{ $notification->custom_background_color ?? 'inherit' }};
            color: {{ $notification->custom_text_color ?? 'inherit' }};
        "
        data-identifier="{{ $notification->id }}"
        data-display-after="{{ $notification->display_after_miliseconds }}"
        data-start-date="{{ $notification->start_date }}"
        data-end-date="{{ $notification->end_date }}"
        data-has-countdown="{{ $notification->has_countdown }}"
        data-notifications-displayed-route="{{ route('notifications.displayed', ['notification' => $notification->id]) }}"
        data-notifications-closed-route="{{ route('notifications.closed', ['notification' => $notification->id]) }}"
    >
        <button
            class="notification-close"
            onclick="Notifications.close('{{ $notification->id }}');"
        >
            ✕
        </button>

        @if($notification->has_countdown)
            <div
                id="countdown-{{ $notification->id }}"
                class="notification-countdown"
            >
                <div class="countdown-box">
                    <span class="countdown-time" id="days">00</span>
                    <span class="countdown-label">Días</span>
                </div>
                <div class="countdown-box">
                    <span class="countdown-time" id="hours">00</span>
                    <span class="countdown-label">Horas</span>
                </div>
                <div class="countdown-box">
                    <span class="countdown-time" id="minutes">00</span>
                    <span class="countdown-label">Minutos</span>
                </div>
                <div class="countdown-box">
                    <span class="countdown-time" id="seconds">00</span>
                    <span class="countdown-label">Segundos</span>
                </div>
            </div>
        @endif

        @if($notification->image_url)
            <img
                style="
                    margin-top: {{ $notification->image_top_margin }};
                "
                src="{{ asset($notification->image_url) }}"
                alt="{{ $notification->title }}"
                class="notification-image"
            />
        @endif

        <h4>{{ $notification->title }}</h4>
        <p>{{ $notification->message }}</p>

        @if($notification->action_text && $notification->action_link)
            <div class="notification-action-container">
                <a
                    href="{{ $notification->action_link }}"
                    class="notification-action"
                    style="
                        background-color: {{ $notification->action_background_color ?? '#fff' }};
                        color: {{ $notification->action_text_color ?? '#000' }};
                    "
                >
                    {{ $notification->action_text }}
                </a>
            </div>
        @endif
    </div>
@endforeach
