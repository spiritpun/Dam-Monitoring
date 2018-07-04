<?php
namespace App\Libraries;

class RegisterProfile {

    public static function currentProfile() {
      return "maetalop";
        // $environments = include app_path() . "/config/nds-profile.php";
        $environments = config('nds-profile');


        $domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;

        $hostname = gethostname();

        foreach ($environments as $environment => $hosts) {
            // To determine the current environment, we'll simply iterate through the possible
            // environments and look for the host that matches the host for this request we
            // are currently processing here, then return back these environment's names.
            foreach ((array) $hosts as $host) {
                if (str_is($host, $domain) || ($host == $hostname)) {
                    return $environment;
                }
            }
        }

        return "maengud";
    }

}
