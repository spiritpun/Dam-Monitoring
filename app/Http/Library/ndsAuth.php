<?php

/**
 * Created by IntelliJ IDEA.
 * User: keitt
 * Date: 2/18/2017
 * Time: 10:10 PM
 */

namespace App\Http\Library;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class NdsAuth {

    public static function decodeAuth($hash, $decode = true) {
      preg_match("/^[A-z0-9=]+.([A-z0-9=]+)/", $hash, $match);

      if ($decode) {
        return json_decode(base64_decode($match[1]), true);
      }
      return $match[1];
    }

    public static function encodeAuth($array) {
      return "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9." . base64_encode(json_encode($array)) . ".he0ErCNloe4J7Id0Ry2SEDg09lKkZkfsRiGsdX_vgEg";
    }

    public static function getAPIToken() {
      $credential = self::getCredentials();

      if ($credential) {
        return self::decodeAuth($credential, false);
      }

      return false;
    }

    public static function getCredentials() {
        $cookie = self::getCookie();
        return $cookie;
    }

    public static function setCookie($data) {
        $timeout = Config::get('auth.timeout');
        $data['timestamp'] = date('U');
        Cookie::queue('authentication', self::encodeAuth($data), $timeout);
//        foreach ($data as $k => $v) {
//            Cookie::queue('nds_' . $k, $v, $timeout);
//        }
        return true;
    }

    public static function revokeCookie() {
        $data = self::getCredentials();
        if (!$data) {
            return false;
        }

        if (!is_array($data)) {
            $data = self::decodeAuth($data);
        }

//        foreach ($data as $k => $v) {
//            Cookie::queue(Cookie::forget('nds_'.$k));
//        }
        Cookie::queue(Cookie::forget('authentication'));
        return true;
    }

    public static function isAuth() {
        $data = self::getCredentials();

        if (!$data) {
            return false;
        }

        if (!is_array($data)) {
            $data = self::decodeAuth($data);
        }
        return true;
    }

    public static function getCookie() {
        return Cookie::get('authentication');
    }

    public static function encryptionPassword($password) {
        $password_salt = $password . Config::get('auth.timeout');
        return base64_encode(gzencode($password_salt));
    }

    public static function getUserId() {
        $authData = self::getCredentials();
        if (!is_array($authData)) {
          $authData = self::decodeAuth($authData);
        }
        return $authData['id'];
    }

    public static function getAuthHeader() {
        // Check Header
        $headerAuth = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : null;
        if (!$headerAuth) {
            return false;
        }

        // Check Format
        preg_match("/^Bearer (.+)$/i", $headerAuth, $match);
        if (!$match) {
            return false;
        }

        $rawsString = base64_decode($match[1]);
        return json_decode($rawsString, true);
    }
}
