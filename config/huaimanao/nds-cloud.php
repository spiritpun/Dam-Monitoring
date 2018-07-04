<?php

return array(
    "site_name" => "อ่างเก็บน้ำห้วยแม่มะนาว",
    "seismic" => array(
        "enable" => false,
        "site_id" => "huaimanao_seismic",
        "station" => false
    ),
    "pressure" => array(
        "enable" => true,
        "extend_point" => true,
        "index_format" => "KPA(%d)",
        "head_water_sensor" => "WL_Level_MSL",
        "site_id" => "huaimanao_pressure",
        "min_sea_water" => 350,
        "max_sea_water" => 371,
        "simulation_template" => array(
            "water_level" => array(
                "min" => array(26,321),
                "max" => array(605,115)
            )
        ),
        "total" => array(
            "start" => 1,
            "end" => 12
        ),
        "dam_section" => "../resources/assets/js/images/DamProfile/huaimanao/huaimanao_0_195.png",
        "coordinate" => '{"p1":{"coor":[583,363],"value":27.6},"p2":{"coor":[583,319],"value":23.8},"p3":{"coor":[583,259],"value":36.1},"p4":{"coor":[583,185],"value":22.2},"p5":{"coor":[683,363],"value":16.1},"p6":{"coor":[683,319],"value":34.1},"p7":{"coor":[683,259],"value":27.2},"p8":{"coor":[683,185],"value":13.5},"p9":{"coor":[753,319],"value":4.6},"p10":{"coor":[753,275],"value":35.1},"p11":{"coor":[827,363],"value":29},"p12":{"coor":[827,319],"value":12}}'
    )    
);