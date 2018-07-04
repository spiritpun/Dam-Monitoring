import React from 'react';
import { Dropdown, Button, Icon, Menu } from 'antd';
import { menu } from './constant';

const { Item } = Menu;

const DamList = (
  <Menu>
    { menu.damList.items.map(item => <Item key={item.title}><a href={item.link}>{item.title}</a></Item>) }
  </Menu>
);

const DamMenu = () => (
  <Dropdown overlay={DamList}>
    <Button style={{ marginLeft: 8 }}>
      {menu.damList.title} <Icon type="down" />
    </Button>
  </Dropdown>
);

export default DamMenu;
