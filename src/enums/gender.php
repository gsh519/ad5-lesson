<?php

declare(strict_types=1);

require(__DIR__ . '/HasLabel.php');

enum Gender: int
{
    use HasLabel;

    case MAN = 1;
    case WOMAN = 2;
    case UNKNOWN = 9;

    public function label(): string
    {
        return match ($this) {
            self::MAN => '男',
            self::WOMAN => '女',
            self::UNKNOWN => '不明',
        };
    }
}
