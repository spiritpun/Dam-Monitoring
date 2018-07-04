<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;

use App\Repositories\PressureRepository as PressureRepository;
use App\Repositories\SeismicRepository as SeismicRepository;
use App\Repositories\DamRepository as DamRepository;
use App\Libraries\RegisterProfile as RegisterProfile;

class ApiController extends BaseController
{
    private $pressure_repo;
    private $seismic_repo;
    private $profile;

    public function __construct()
    {
        $this->pressure_repo = new PressureRepository;
        $this->seismic_repo  = new SeismicRepository;
        $this->dam_repo      = new DamRepository;
        $this->profile       = RegisterProfile::currentProfile();
    }

    public function getPressure()
    {
        $date       = date('Y-m-d');
        $tempalate  = Input::get('template', 1);
        $start_date = Input::get('start', $date . ' 00:00:00');
        $end_date   = Input::get('end', $date . ' 23:59:00');

        $pressure_data = $this->pressure_repo->getDataByDate($start_date, $end_date);
        $raws_json     = $this->pressure_repo->convertDataForDamview($pressure_data['result']['stream'], "kpa", true);

        $dam_template = false;
        if ($tempalate == true) {
            $dam_template_path = public_path(config("{$this->profile}.nds-cloud.pressure.dam_section"));
            $dam_template      = $this->dam_repo->base64_encode_image($dam_template_path, "png");
        }

        $data = array(
            "code"            => 200,
            "template_base64" => $dam_template,
            "pressure_data"   => json_decode($raws_json)
        );

        return $data;
    }

    public function getSeismic() {
        $site_id = Input::get('site_id', null);
        $start_date = Input::get("start_date", date('Y-m-d H:i:s'));
        $station = Input::get("station", null);
        if (empty($site_id) || empty($start_date) || empty($station) ) {
            return ['code' => 400];
        }

        return $this->seismic_repo->getSeismicData($station, $start_date);
    }

    /**
     * Will Deprecate in nds-report
     * @return type
     */
    public function getSimulate()
    {
        $start_date = Input::get("start_date", date("Y-m-d") . " 00:00");
        $end_date   = Input::get("end_date", date("Y-m-d H:i"));

        $pressure_data     = $this->pressure_repo->getDataByDate($start_date, $end_date);
        $raws_json         = $this->pressure_repo->convertDataForDamview($pressure_data['result']['stream'], "kpa", true);
        $dam_template_path = public_path(Config::get("{$this->profile}/nds-cloud.pressure.dam_section"));
        $dam_template      = $this->dam_repo->base64_encode_image($dam_template_path, "png");

        $data = array(
            "code"            => 200,
            "template_base64" => $dam_template,
            "pressure_data"   => json_decode($raws_json)
        );

        return $data;
    }
}