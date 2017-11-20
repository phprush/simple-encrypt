<?php
namespace PhpRush\SimplaeEncrypt\Sign;

use PhpRush\SimplaeEncrypt\Sign\Adapter\MD5;

/**
 *
 * @author Administrator
 */
class Manage
{

    const SIGN_TYPE_MD5 = 'MD5';

    protected static $adapters = array();

    static public function getInstance($signType = self::SIGN_TYPE_MD5)
    {
        if (! isset(self::$adapters[$signType]) || empty(self::$adapters[$signType])) {
            
            switch ($signType) {
                case self::SIGN_TYPE_MD5:
                    $adapter = new MD5();
                    break;
                default:
                    ;
            }
            
            self::$adapters[$signType] = $adapter;
        } else {
            $adapter = self::$adapters[$signType];
        }
        
        return $adapter;
    }

    static public function Verify($get, $post, $keyInfo)
    {
        $signType = isset($keyInfo['sign_method']) && ! empty($keyInfo['sign_method']) ? $keyInfo['sign_method'] : self::SIGN_TYPE_MD5;
        $signAdapter = self::getInstance($signType);
        $signAdapter->timestamp = isset($get['timestamp']) ? $get['timestamp'] : time();
        $signAdapter->api_key = $keyInfo['api_key'];
        $signAdapter->api_secret = $keyInfo['api_secret'];
        $signAdapter->formdata = $post;
        $signAdapter->sign = isset($get['sign']) && ! empty($get['sign']) ? $get['sign'] : null;
        
        $signAdapter->verify();
        
        return true;
    }
    
    static public function createSign($get, $post, $keyInfo)
    {
        $signType = isset($keyInfo['sign_method']) && ! empty($keyInfo['sign_method']) ? $keyInfo['sign_method'] : self::SIGN_TYPE_MD5;
        $signAdapter = self::getInstance($signType);
        $signAdapter->timestamp = isset($get['timestamp']) ? $get['timestamp'] : time();
        $signAdapter->api_key = $keyInfo['api_key'];
        $signAdapter->api_secret = $keyInfo['api_secret'];
        $signAdapter->formdata = $post;
    
        return $signAdapter->createSign();
    }
}
