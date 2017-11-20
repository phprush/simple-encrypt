<?php
namespace PhpRush\SimplaeEncrypt\Sign\Adapter;

use PhpRush\SimplaeEncrypt\Exceptions\SignVerifyException;

/**
 *
 * @author Administrator
 */
class MD5 implements Inter
{

    public $timestamp;

    public $format;

    public $api_key;

    public $api_secret;

    public $sign_method;

    public $sign = null;

    public $formdata = [];

    /**
     * (non-PHPdoc)
     *
     * @see \Sign\Adapter\Inter::getSign()
     *
     */
    public function getSign()
    {
        if (is_null($this->sign)) {
            $this->sign = $this->createSign();
            return $this->sign;
        } else {
            return $this->sign;
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Sign\Adapter\Inter::createSign()
     *
     */
    public function createSign()
    {
        $vars = [];
        foreach ($this->formdata as $key => $value) {
            array_push($vars, $key ?  : '');
            array_push($vars, $value ?  : '');
        }
        
        $dataString = join('-', $vars);
        $dataString = trim($dataString, '-');
        
        $md5String = "{$this->api_key}-{$this->timestamp}-{$this->api_secret}-{$dataString}";
        
        return md5($md5String);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Sign\Adapter\Inter::verify()
     *
     */
    public function verify()
    {
        if ($this->getSign() !== $this->createSign()) {
            throw new SignVerifyException("签名验证失败!");
        }
        
        return true;
    }
}

?>