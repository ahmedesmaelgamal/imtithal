<?php

namespace App\Enum;

enum VehicleType: int
{
    case Car = 0;
    case PublicUtilityVehicle = 1;
    case GovernmentVehicle = 2;
    case CommercialVehicle = 3;
    case Truck = 4;
    case Bus = 5;
    case Motorcycle = 6;



    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function lang(): string
    {
        return match ($this) {
            self::Car => 'مركبة خاصة',
            self::PublicUtilityVehicle => 'مركبة خدمات عامة',
            self::GovernmentVehicle => 'مركبة حكومية',
            self::CommercialVehicle => 'مركبة تجارية',
            self::Truck => 'شاحنة',
            self::Bus => 'حافلة',
            self::Motorcycle => 'دراجة نارية',
        };
    }
}
