<?php

namespace App\Enums;

enum TaskType: string
{
    case Translate = 'translate';
    case Generate = 'generate';
    case Summarize = 'summarize';

    public function label(): string
    {
        return match ($this) {
            self::Translate => 'Translate',
            self::Generate => 'Generate',
            self::Summarize => 'Summarize',
        };
    }

    public static function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
