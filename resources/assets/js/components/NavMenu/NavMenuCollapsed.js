import React from 'react';
import { withState } from 'recompose';
import Styled from 'styled-components';
import { Menu, Button, Icon } from 'antd';
import { menu } from './constant';

const { Item, SubMenu, ItemGroup } = Menu;

const DivStyle = Styled.div`
  position: absolute;
  z-index: 1000;
  width: 300px;
`;

const NavMenuCollapsed = ({ isOpen, setIsOpen }) => (
  <DivStyle>
    <Button type="primary" style={{ marginBottom: 16 }} icon={isOpen ? 'menu-unfold' : 'menu-fold'} onClick={() => setIsOpen(!isOpen)} />
    <Menu mode="inline" style={{ display: isOpen ? 'block' : 'none' }}>
      <SubMenu title={<span><Icon type="environment" /><span>{menu.damList.title}</span></span>}>
        { menu.damList.items.map(item => <Item key={item.title}>{item.title}</Item>) }
      </SubMenu>
      <Item key={menu.simulate.title} >
        <Icon type="play-circle" />
        <span>{menu.simulate.title}</span>
      </Item>
      <Item key={menu.graphPressure.title}>
        <Icon type="area-chart" />
        <span>{menu.graphPressure.title}</span>
      </Item>
      <SubMenu title={<span><Icon type="bar-chart" /><span>{menu.graphVibration.title}</span></span>}>
        {
          menu.graphVibration.group.map((subMenu, indexGroup) => (
            <ItemGroup key={subMenu} title={subMenu}>
              {
                menu.graphVibration.items.filter(item => item.group === indexGroup).map(item =>
                  <Item key={item.title}>{item.title}</Item>)
              }
            </ItemGroup>))
        }
      </SubMenu>
    </Menu>
  </DivStyle>
);

export default withState('isOpen', 'setIsOpen', false)(NavMenuCollapsed);
