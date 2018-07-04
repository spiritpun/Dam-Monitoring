<?php

return array(
    "site_name" => "อ่างเก็บน้ำแม่ฮ่องสอน",
    "seismic" => array(
        "enable" => true,
        "site_id" => "maehongson_seismic",
        "station" => array(
            "4017" => "Accelerometer สันเขื่อน (4017)",
            "4018" => "Accelerometer กลางเขื่อน (4018)",
            "4019" => "Accelerometer ฐานเขื่อน (4019)",
        ),
    ),
    "pressure" => array(
        "enable" => true,
        "extend_point" => true,
        "index_format" => "CAL(%d)",
        "head_water_sensor" => "WL_Level_MSL",
        "site_id" => "maehongson_pressure",
        "min_sea_water" => 314,
        "max_sea_water" => 333,
        "simulation_template" => array(
            "water_level" => array(
                "min" => array(90,288),
                "max" => array(604,142)
            )
        ),
        "total" => array(
            "start" => 1,
            "end" => 46
        ),
        "dam_section" => "../resources/assets/js/images/DamProfile/maehongson/maehongson_dam_structure_0_136.png",
        "coordinate" => '{"p1":{"coor":[66,323]},"p2":{"coor":[141,323]},"p3":{"coor":[141,286]},"p4":{"coor":[217,323]},"p5":{"coor":[217,286]},"p6":{"coor":[292,323]},"p7":{"coor":[292,280]},"p8":{"coor":[367,323]},"p9":{"coor":[367,280]},"p10":{"coor":[367,242]},"p11":{"coor":[442,323]},"p12":{"coor":[442,280]},"p13":{"coor":[442,242]},"p14":{"coor":[517,371]},"p15":{"coor":[517,323]},"p16":{"coor":[517,280]},"p17":{"coor":[517,242]},"p18":{"coor":[517,204]},"p19":{"coor":[592,371]},"p20":{"coor":[592,342]},"p21":{"coor":[592,310]},"p22":{"coor":[592,280]},"p23":{"coor":[592,242]},"p24":{"coor":[592,204]},"p25":{"coor":[592,172]},"p26":{"coor":[667,371]},"p27":{"coor":[667,342]},"p28":{"coor":[667,310]},"p29":{"coor":[667,280]},"p30":{"coor":[667,242]},"p31":{"coor":[667,204]},"p32":{"coor":[667,172]},"p33":{"coor":[742,371]},"p34":{"coor":[742,342]},"p35":{"coor":[742,318]},"p36":{"coor":[742,280]},"p37":{"coor":[742,242]},"p38":{"coor":[742,204]},"p39":{"coor":[818,342]},"p40":{"coor":[818,323]},"p41":{"coor":[818,280]},"p42":{"coor":[818,242]},"p43":{"coor":[893,342]},"p44":{"coor":[893,329]},"p45":{"coor":[893,299]},"p46":{"coor":[968,348]}}'
    )    
);
