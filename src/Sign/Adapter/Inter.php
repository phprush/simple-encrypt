<?php
namespace PhpRush\SimplaeEncrypt\Sign\Adapter;

interface Inter
{
    public function createSign();
    
    public function getSign();
    
    public function verify();
}

?>