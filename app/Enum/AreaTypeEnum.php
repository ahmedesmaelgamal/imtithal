<?php

namespace App\Enum;

enum AreaTypeEnum: int
{
    case PARKING = 0;
    case BUS = 1;
    case RAILWAY = 2;
    case ROAD = 3;
    case STATION = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::PARKING => 'موقف', // Parking
            self::BUS => 'باص', // Bus
            self::RAILWAY => 'سكك حديدية', // Railway
            self::ROAD => 'طريق', // Road
            self::STATION => 'محطة', // Station

        };
    }
}
