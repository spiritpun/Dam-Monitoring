import React from 'react';
import { Button } from 'antd';
import { menu } from './constant';

const GraphPressureMenu = () => (
  <Button href={menu.graphPressure.link} style={{ marginLeft: 8 }}>
    {menu.graphPressure.title}
  </Button>
);

export default GraphPressureMenu;
