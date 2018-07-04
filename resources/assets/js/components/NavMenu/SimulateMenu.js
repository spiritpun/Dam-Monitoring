import React from 'react';
import { Button } from 'antd';
import { menu } from './constant';

const SimulateMenu = () => (
  <Button href={menu.simulate.link} style={{ marginLeft: 8 }}>
    {menu.simulate.title}
  </Button>
);

export default SimulateMenu;
