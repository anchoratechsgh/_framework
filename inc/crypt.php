<?php

class pCrypt
{

    private $skey;

    public static function __skey()
    {
        if (Session::get('pepper') == false) {
            return PEPPER;
        } else {
            return Session::get('pepper');
        }
    } #end

    public static function safe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    } #end

    public static function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    } #end

    public static function encode($string)
    {
        if (!$string) {return false;}
        $text = $string;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::__skey(), $text, MCRYPT_MODE_ECB, $iv);
        return trim(self::safe_b64encode($crypttext));
    } #end

    public static function decode($string)
    {
        if (!$string) {return false;}
        $crypttext = self::safe_b64decode($string);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::__skey(), $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    } #end

    public static function cryptPassword($name, $password, $pepp = '')
    {
        $pepper = empty($pepp) ? PEPPER : $pepp;
        $salt = $name;
        $pwd = hash('sha256', $pepper . $password . $salt, false);
        $pwd = self::encode($pwd);
        return $pwd;
    } #end

    public static function lite_encode($string)
    {
        $encoded = serialize($string);
        $encoded = json_encode($encoded);
        $encoded = self::safe_b64encode($encoded);
        return $encoded;
    } #end

    public static function lite_decode($string)
    {
        $decoded = self::safe_b64decode($string);
        $decoded = json_decode($decoded);
        $decoded = unserialize($decoded);
        return $decoded;
    } #end

    public static function openssl_encrypt($string)
    {
        $iv = substr(hash('sha256', PEPPER), 0, 16);
        $encoded = openssl_encrypt($string, 'AES-256-CBC', PEPPER, 0, $iv);
        return base64_encode($encoded);
    } #end

    public static function openssl_decrypt($string)
    {
        $iv = substr(hash('sha256', PEPPER), 0, 16);
        $string = base64_decode($string);
        $decoded = openssl_decrypt($string, 'AES-256-CBC', PEPPER, 0, $iv);
        return $decoded;
    } #end

} #endClass
