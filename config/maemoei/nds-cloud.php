<?php

return array(
    "site_name" => "อ่างเก็บน้ำแม่เมย",
    "seismic" => array(
        "enable" => false,
        "site_id" => "maemoei_seismic",
        "station" => false,
    ),
    "pressure" => array(
        "enable" => true,
        "extend_point" => true,
        "index_format" => "CAL(%d)",
        "head_water_sensor" => "WL_Level_MSL",
        "site_id" => "maemoei_pressure",
        "min_sea_water" => 365,
        "max_sea_water" => 376,
        "simulation_template" => array(
            "water_level" => array(
                "min" => array(49,246),
                "max" => array(523,86)
            )
        ),
        "total" => array(
            "start" => 1,
            "end" => 10
        ),
        "dam_section" => "../resources/assets/js/images/DamProfile/maemoei/maemoei_dam_structure_0_265.png",
        "coordinate" => '{"p1":{"coor":[525,373]},"p2":{"coor":[525,265]},"p3":{"coor":[525,156]},"p4":{"coor":[637,373]},"p5":{"coor":[637,265]},"p6":{"coor":[637,156]},"p7":{"coor":[746,272]},"p8":{"coor":[746,210]},"p9":{"coor":[867,337]},"p10":{"coor":[867,272]}}'
    )    
);