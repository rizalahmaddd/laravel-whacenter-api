<?php

namespace Rizalahmaddd\WhatsappApi\Facades;

use Illuminate\Support\Facades\Facade;

class Whatsapp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'whatsapp';
    }
}
