<?php
namespace PhpRush\SimplaeEncrypt;

use Exception;
use PhpRush\SimplaeEncrypt\Sign\Manage;

class SimplaeEncrypt
{

    private $appKey;

    private $appSecret;

    private $encryptType = null;

    protected $params = null;

    protected $post = null;

    public function __construct($config, $params = null, $post = null)
    {
        $this->appKey = array_get($config, 'app_key', '');
        $this->appSecret = array_get($config, 'app_secret', '');
        $this->encryptType = strtoupper(array_get($config, 'encrypt_type', 'md5'));
        
        $this->params = $params;
        $this->post = $post;
    }
    
    

    public function verifySign()
    {
        return Manage::Verify($this->params, $this->post, $this->getKeyInfo());
    }
    
    public function createSign()
    {
        return Manage::createSign($this->params, $this->post, $this->getKeyInfo());
    }

    private function getKeyInfo()
    {
        return [
            'sign_method' => $this->encryptType,
            'api_key' => $this->appKey,
            'api_secret' => $this->appSecret
        ];
    }
}