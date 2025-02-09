<?php

namespace App\Enums;

enum NotificationVariant: string
{
    use BaseEnum;

    case Info = 'info';

    case Warning = 'warning';

    case Success = 'success';

    case Error = 'error';
}
