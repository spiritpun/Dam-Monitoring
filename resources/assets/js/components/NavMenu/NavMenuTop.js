import React from 'react';
import { Col, Row } from 'antd';
import DamMenu from './DamMenu';
import SimulateMenu from './SimulateMenu';
import GraphPressureMenu from './GraphPressureMenu';
import GraphVibrationMenu from './GraphVibrationMenu';

const NavMenuTop = () => (
  <Row type="flex" justify="end">
    <Col><DamMenu /></Col>
    <Col><SimulateMenu /></Col>
    <Col><GraphPressureMenu /></Col>
    <Col><GraphVibrationMenu /></Col>
  </Row>
);

export default NavMenuTop;
