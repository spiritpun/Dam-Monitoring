import React from 'react';
import { Dropdown, Button, Icon, Menu } from 'antd';
import { menu } from './constant';

const { ItemGroup, Item } = Menu;

const ItemList = (
  <Menu>
    {
      menu.graphVibration.group.map((subMenu, indexGroup) => (
        <ItemGroup key={subMenu} title={subMenu}>
          {
            menu.graphVibration.items.filter(item => item.group === indexGroup).map(item =>
              <Item key={item.title}><a href={item.link}>{item.title}</a></Item>)
          }
        </ItemGroup>))
    }
  </Menu>
);


const GraphVibrationMenu = () => (
  <Dropdown overlay={ItemList}>
    <Button style={{ marginLeft: 8 }}>
      {menu.graphVibration.title} <Icon type="down" />
    </Button>
  </Dropdown>
);

export default GraphVibrationMenu;
