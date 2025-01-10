<?php

namespace App\Bundles\DemoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DemoBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__).'/DemoBundle';
    }
}
