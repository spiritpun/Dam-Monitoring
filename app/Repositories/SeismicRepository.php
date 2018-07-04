<?php
namespace App\Repositories;

use GuzzleHttp\Client;
use App\Libraries\RegisterProfile;

/**
 * Description of SeismicRepository
 *
 * @author keitt
 */
class SeismicRepository
{

    private $url;
    private $profile;

    public function __construct()
    {
        $this->profile = RegisterProfile::currentProfile();

        /**
         * Get Only Url not Profile
         */
        $this->url = config("nds-endpoint.endpoint.seismic");
    }

    public function getStatus()
    {
        $url = $this->url . "/sync?site_id=" . config("{$this->profile}/nds-cloud.seismic.site_id");
        try {
            $resp = file_get_contents($url);
            $resp = json_decode($resp, true);
        } catch(Exception $e) {
            $resp = array();
        }
        return $resp;
    }

    public function getEvent($page, $limit = 150)
    {
        $url = $this->url . "/event-archive?site_id=" . config("{$this->profile}/nds-cloud.seismic.site_id") . "&page={$page}&limit={$limit}";
        try {
            $resp = file_get_contents($url);
            $resp = json_decode($resp, true);
        } catch(Exception $e) {
            $resp = array();
        }
        return $resp;
    }

    public function getSeismicData($station, $time)
    {
        $url = $this->url . "?site_id=" . config("{$this->profile}/nds-cloud.seismic.site_id") . "&station={$station}&time={$time}";
        try {
            $resp = file_get_contents($url);
            $resp = json_decode($resp, true);
            if (empty($resp['result']['stream'])) {
                $resp = array();
            }
        } catch (Exception $e) {
            $resp = array();
        }
        return $resp;
    }

    public function convertDataToGoogleChart($stream)
    {
        $ch0 = "[";
        $ch1 = "[";
        $ch2 = "[";

        $ch0 .= "[\"Time\", \"G\"]";
        $ch1 .= "[\"Time\", \"G\"]";
        $ch2 .= "[\"Time\", \"G\"]";

        foreach ($stream as $each_sec => $g_date) {
            $date = date("Y-m-d H:i:s", $each_sec);
            //if(($g_date['ch0'][0] != 0)&&($g_date['ch0'][1] != 0)&&($g_date['ch1'][0] != 0)&&($g_date['ch1'][1] != 0)&&($g_date['ch2'][0] != 0)&&($g_date['ch2'][1] != 0)){
            $ch0 .= ",[\"{$date}\",{$g_date['ch0'][0]}],[\"{$date}\",{$g_date['ch0'][1]}]";
            $ch1 .= ",[\"{$date}\",{$g_date['ch1'][0]}],[\"{$date}\",{$g_date['ch1'][1]}]";
            $ch2 .= ",[\"{$date}\",{$g_date['ch2'][0]}],[\"{$date}\",{$g_date['ch2'][1]}]";
            //}
        }

        $ch0 .= "]";
        $ch1 .= "]";
        $ch2 .= "]";
        return [
            "ch0" => $ch0,
            "ch1" => $ch1,
            "ch2" => $ch2
        ];
    }

    public function convertDataToHiChart($stream)
    {
        $ch0 = [];
        $ch1 = [];
        $ch2 = [];

        foreach ($stream as $each_sec => $g_date) {
            $milisec = $each_sec * 1000;
            $ch0[] = [$milisec, $g_date['ch0'][0], $g_date['ch0'][1]];
            $ch1[] = [$milisec, $g_date['ch1'][0], $g_date['ch1'][1]];
            $ch2[] = [$milisec, $g_date['ch2'][0], $g_date['ch2'][1]];
        }

        return [
            "ch0" => json_encode($ch0),
            "ch1" => json_encode($ch1),
            "ch2" => json_encode($ch2)
        ];
    }
}
