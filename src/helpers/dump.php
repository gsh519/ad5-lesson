<?php

declare(strict_types=1);

/**
 * @param mixed ...$args
 * @return void
 */
function dd(mixed ...$args): void
{
    var_dump(...$args);
    die();
}
