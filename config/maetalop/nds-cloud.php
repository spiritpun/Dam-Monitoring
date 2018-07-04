<?php
return array(
    "site_name" => "อ่างเก็บน้ำแม่ทะลบ",
    "seismic" => array(
        "enable" => true,
        "site_id" => "maetalop_seismic",
        "station" => array(
            "5he2" => "Accelerometer ฐานเขื่อน (5HE2)",
            "5he3" => "Accelerometer ข้างสำนักงาน (5HE3)",
            "5he4" => "Accelerometer สันเขื่อน (5HE4)"
        ),
    ),
    "pressure" => array(
        "enable" => true,
        "extend_point" => false,
        "index_format" => "CAL(%d)",
        "head_water_sensor" => "WL_Level_MSL",
        "site_id" => "maetalop_pressure",
        "min_sea_water" => 540,
        "max_sea_water" => 573,
        "simulation_template" => array(
            "water_level" => array(
                "min" => array(25, 338),
                "max" => array(608, 142)
            )
        ),
        "total" => array(
            "start" => 1,
            "end" => 33
        ),
        "dam_section" => "../resources/assets/js/images/DamProfile/maetalop/maetalop_0_300.png",
        "coordinate" => '{"p1":{"coor":[326,374],"value":27.6},"p2":{"coor":[326,306],"value":23.8},"p3":{"coor":[326,248],"value":36.1},"p4":{"coor":[412,374],"value":22.2},"p5":{"coor":[412,306],"value":16.1},"p6":{"coor":[412,248],"value":34.1},"p7":{"coor":[498,374],"value":27.2},"p8":{"coor":[498,306],"value":13.5},"p9":{"coor":[498,248],"value":4.6},"p10":{"coor":[498,202],"value":35.1},"p11":{"coor":[582,306],"value":29},"p12":{"coor":[582,374],"value":12},"p13":{"coor":[582,248],"value":12},"p14":{"coor":[582,192],"value":12},"p15":{"coor":[684,374],"value":12},"p16":{"coor":[684,248],"value":12},"p17":{"coor":[684,306],"value":12},"p18":{"coor":[684,188],"value":12},"p19":{"coor":[745,374],"value":12},"p20":{"coor":[745,306],"value":12},"p21":{"coor":[745,263],"value":12},"p22":{"coor":[745,232],"value":12},"p23":{"coor":[860,374],"value":12},"p24":{"coor":[860,345],"value":12},"p25":{"coor":[860,306],"value":12},"p26":{"coor":[860,263],"value":12},"p27":{"coor":[945,374],"value":12},"p28":{"coor":[945,345],"value":12},"p29":{"coor":[945,306],"value":12},"p30":{"coor":[945,280],"value":12},"p31":{"coor":[1023,374],"value":12},"p32":{"coor":[1023,345],"value":12},"p33":{"coor":[1023,314],"value":12}}'
    )
);
