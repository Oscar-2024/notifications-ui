<?php

namespace App\Enums;

enum NotificationPosition: string
{
    use BaseEnum;

    case FullTop = 'full-top';

    case FullBottom = 'full-bottom';

    case TopRight = 'top-right';

    case TopLeft = 'top-left';

    case TopCenter = 'top-center';

    case BottomRight = 'bottom-right';

    case BottomLeft = 'bottom-left';

    case BottomCenter = 'bottom-center';

    case Center = 'center';

    case RightCenter = 'right-center';

    case LeftCenter = 'left-center';
}
