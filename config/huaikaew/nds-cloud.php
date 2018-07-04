<?php

return array(
    "site_name" => "อ่างเก็บน้ำห้วยแก้ว",
    "seismic" => array(
        "enable" => true,
        "site_id" => "huaikaew_seismic",
        "station" => array(
            "4020" => "Accelerometer สันเขื่อน (4020)",
        ),
    ),
    "pressure" => array(
        "enable" => true,
        "extend_point" => true,
        "index_format" => "CAL(%d)",
        "head_water_sensor" => "WL_Level_MSL",
        "site_id" => "huaikaew_pressure",
        "min_sea_water" => 331,
        "max_sea_water" => 339,
        "simulation_template" => array(
            "water_level" => array(
                "min" => array(50,278),
                "max" => array(498,134)
            )
        ),
        "total" => array(
            "start" => 1,
            "end" => 20
        ),
        "dam_section" => "../resources/assets/js/images/DamProfile/huaikaew/huaikaew_dam_structure_0_105.png",
        "coordinate" => '{"p1":{"coor":[400,355]},"p2":{"coor":[400,288]},"p3":{"coor":[400,224]},"p4":{"coor":[493,355]},"p5":{"coor":[493,288]},"p6":{"coor":[493,224]},"p7":{"coor":[493,165]},"p8":{"coor":[571,355]},"p9":{"coor":[571,288]},"p10":{"coor":[571,244]},"p11":{"coor":[571,196]},"p12":{"coor":[664,355]},"p13":{"coor":[664,288]},"p14":{"coor":[664,244]},"p15":{"coor":[664,196]},"p16":{"coor":[757,355]},"p17":{"coor":[757,288]},"p18":{"coor":[757,244]},"p19":{"coor":[943,297]},"p20":{"coor":[943,255]}}'
    )    
);