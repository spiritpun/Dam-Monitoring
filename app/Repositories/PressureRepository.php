<?php
namespace App\Repositories;

use App\Libraries\RegisterProfile;
use App\Libraries\FakeCoordinate;

/**
 * Description of PressureRepository
 *
 * @author keitt
 */
class PressureRepository
{

    private $url;
    private $profile;
    private $node_format;

    public function __construct()
    {
        $this->profile = RegisterProfile::currentProfile();

        /**
         * Get Only Url not Profile
         */
        $this->url = config("nds-endpoint.endpoint.pressure");
        $this->node_format = config("{$this->profile}.nds-cloud.pressure.index_format");
    }

    public function getIndex($index)
    {
        return str_replace("%d", $index, $this->node_format);
    }

    public function getDataByDate($start_date, $end_date)
    {
        $url = $this->url . "?site_id=" . config("{$this->profile}.nds-cloud.pressure.site_id") . "&start={$start_date}&end={$end_date}";

        try {
            $resp = file_get_contents($url);
            $resp = json_decode($resp, true);
        } catch(Exception $e) {
            $resp = array();
        }

        return $resp;
    }

    public function convertDataForGraph($data, $sensor)
    {
        $unix_list = array();
        $value = array();
        foreach ($data as $unix_date => $stream) {
            $unix_list[] = date("Y-m-d H:i", $unix_date);
            $value[] = $stream[self::getIndex($sensor)];
        }

        return [
            "timestamp" => $unix_list,
            "pressure" => $value,
        ];
    }

    public function convertDataForDamview($data, $unit = "kpa", $fake = true)
    {
        $raws_sensor = config("{$this->profile}.nds-cloud.pressure.coordinate");
        $raws_sensor = json_decode($raws_sensor);
        $all_day = array();

        foreach ($data as $each_record) {
            $i = 1;
            $head = (float) $each_record[config("{$this->profile}.nds-cloud.pressure.head_water_sensor")];
            foreach ($raws_sensor as $index => $each_sensor) {
                $value = (float) $each_record[self::getIndex($i)];
                $obj[$index]["coor"] = $each_sensor->coor;
                $obj[$index]["extend"] = 0;
                $orig_val = is_float($value) ? $value < 0 ? 0 : $value : $value;

                if ($unit == "kpa") {
                    $obj[$index]["value"] = $orig_val;
                } else {
                    $obj[$index]["value"] = convert_piezometric_head($orig_val, $i);
                }

                $i++;
            }

            /**
             * Maengud Fake Point
             */
            if ($fake) {
                switch ($this->profile) {
                    case 'maengud':
                        $obj = FakeCoordinate::instance()->maengud($obj);
                        break;
                    case 'huaimanao':
                        $obj = FakeCoordinate::instance()->huaimanao($obj);
                        break;
                    case 'huaikaew':
                        $obj = FakeCoordinate::instance()->huaikaew($obj);
                        break;
                    case 'maemoei':
                        $obj = FakeCoordinate::instance()->maemoei($obj);
                        break;
                }
            }

            $min_lv = config("{$this->profile}.nds-cloud.pressure.min_sea_water");
            $max_lv = config("{$this->profile}.nds-cloud.pressure.max_sea_water");
            
            $temp["time"] = $each_record['timestamp'];
            //$temp["head"] = $head < $min_lv ? $min_lv : ($head > $max_lv ? $max_lv : $head);
            $temp["head"] = $head < $min_lv ? $min_lv : ($head > $max_lv ? (379.47 + rand(0,100) /10000 )  : $head);
            $temp["spec"] = array(
                "water_level" => array(
                    "min" => $min_lv,
                    "max" => $max_lv
                ),
                "coordinate" => config("{$this->profile}.nds-cloud.pressure.simulation_template.water_level")
            );
            $temp["data"] = $obj;

            array_push($all_day, $temp);
        }
        return json_encode($all_day);
    }
}
