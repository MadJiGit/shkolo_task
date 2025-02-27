<?php

declare(strict_types=1);

namespace App;

class LoadDB
{
    /**
     * @param string $path
     * @return void
     */
    public function load(string $path): void
    {
        $lines = parse_ini_file($path);

        foreach ($lines as $name => $value ) {
            $_ENV[$name] = $value;
        }
    }
}