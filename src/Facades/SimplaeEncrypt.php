<?php
namespace PhpRush\SimplaeEncrypt\Facades;

use Illuminate\Support\Facades\Facade;

class SimplaeEncrypt extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'SimplaeEncrypt';
    }
}