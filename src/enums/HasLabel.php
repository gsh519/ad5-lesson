<?php

declare(strict_types=1);

trait HasLabel
{
    /**
     * Enum に対するラベルを取得
     */
    abstract public function label(): string;

    /**
     * Enum の value と label の一覧を取得
     *
     * @return array<int|string, string>
     */
    public static function labels(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn (self $e) => $e->label(), self::cases()),
        );
    }

    public static function tryFromLabel(?string $label): ?self
    {
        if ($label === null) {
            return null;
        }

        $const = array_search($label, $labels = self::labels());
        if ($const === false) {
            return null;
        }

        return self::from($const);
    }
}
