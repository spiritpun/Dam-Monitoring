import damSection from '~/images/DamProfile/maengud/maengud_dam_structure_0_180.png';
export default {
  site_name: 'เขื่อนแม่งัดสมบูรณ์ชล',
  seismic: {
    enable: true,
    site_id: 'maengud_seismic',
    station: {
      B87C: 'Accelerometer สันเขื่อน (B87C)',
      B887: 'Accelerometer กลางเขื่อน (B887)',
      BA29: 'Accelerometer ฐานเขื่อน (BA29)',
      BBC5: 'Seismometer ฐานเขื่อน (BBC5)',
    },
  },
  pressure: {
    enable: true,
    extend_point: true,
    index_format: 'KPA(%d)',
    head_water_sensor: 'KPA(52)',
    site_id: 'maengud_pressure',
    min_sea_water: 345,
    max_sea_water: 404,
    simulation_template: {
      water_level: {
        min: [30, 313],
        max: [625, 116],
      },
    },
    total: {
      start: 1,
      end: 50,
    },
    dam_section: damSection,
    coordinate: {
      'p1': { 'coor': [529, 338], 'value': 27.6 }, 'p2': { 'coor': [529, 288], 'value': 23.8 }, 'p3': { 'coor': [558, 338], 'value': 36.1 }, 'p4': { 'coor': [558, 289], 'value': 22.2 }, 'p5': { 'coor': [558, 239], 'value': 16.1 }, 'p6': { 'coor': [586, 338], 'value': 34.1 }, 'p7': { 'coor': [586, 288], 'value': 27.2 }, 'p8': { 'coor': [586, 239], 'value': 13.5 }, 'p9': { 'coor': [586, 196], 'value': 4.6 }, 'p10': { 'coor': [611, 338], 'value': 35.1 }, 'p11': { 'coor': [611, 302], 'value': 29 }, 'p12': { 'coor': [611, 238], 'value': 12 }, 'p13': { 'coor': [611, 190], 'value': -0.6 }, 'p14': { 'coor': [631, 380], 'value': 34.1 }, 'p15': { 'coor': [631, 338], 'value': 34.1 }, 'p16': { 'coor': [631, 302], 'value': 34.1 }, 'p17': { 'coor': [631, 269], 'value': 34.1 }, 'p18': { 'coor': [631, 238], 'value': 34.1 }, 'p19': { 'coor': [631, 202], 'value': 34.1 }, 'p20': { 'coor': [631, 169], 'value': 34.1 }, 'p21': { 'coor': [633, 143], 'value': 34.1 }, 'p22': { 'coor': [669, 382], 'value': 34.1 }, 'p23': { 'coor': [669, 338], 'value': 34.1 }, 'p24': { 'coor': [669, 302], 'value': 34.1 }, 'p25': { 'coor': [669, 269], 'value': 34.1 }, 'p26': { 'coor': [669, 238], 'value': 34.1 }, 'p27': { 'coor': [669, 202], 'value': 34.1 }, 'p28': { 'coor': [669, 170], 'value': 34.1 }, 'p29': { 'coor': [669, 143], 'value': 34.1 }, 'p30': { 'coor': [729, 338], 'value': 34.1 }, 'p31': { 'coor': [729, 302], 'value': 34.1 }, 'p32': { 'coor': [729, 269], 'value': 34.1 }, 'p33': { 'coor': [729, 240], 'value': 34.1 }, 'p34': { 'coor': [729, 203], 'value': 34.1 }, 'p35': { 'coor': [787, 338], 'value': 34.1 }, 'p36': { 'coor': [787, 310], 'value': 34.1 }, 'p37': { 'coor': [787, 289], 'value': 34.1 }, 'p38': { 'coor': [787, 238], 'value': 34.1 }, 'p39': { 'coor': [787, 196], 'value': 34.1 }, 'p40': { 'coor': [849, 338], 'value': 34.1 }, 'p41': { 'coor': [849, 310], 'value': 34.1 }, 'p42': { 'coor': [849, 289], 'value': 34.1 }, 'p43': { 'coor': [849, 238], 'value': 34.1 }, 'p44': { 'coor': [911, 338], 'value': 34.1 }, 'p45': { 'coor': [911, 310], 'value': 34.1 }, 'p46': { 'coor': [911, 288], 'value': 34.1 }, 'p47': { 'coor': [911, 254], 'value': 34.1 }, 'p48': { 'coor': [973, 338], 'value': 34.1 }, 'p49': { 'coor': [973, 311], 'value': 34.1 }, 'p50': { 'coor': [973, 289], 'value': 34.1 },
    },
  },
};
