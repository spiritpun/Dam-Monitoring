import React from 'react';
import Styled from 'styled-components';
import { Col, Row } from 'antd';
import logoImg from '~/images/logo_white.png';
import backgroundImg from '~/images/bg_02.jpg';
import NavMenu from '../NavMenu';

const HeaderBlock = Styled(Row)`
  padding: 10px 0px;
  background: url(${backgroundImg});
`;

const ImgStyled = Styled.img`
  display: block;
  max-width: 100%;
  height: auto;
`;

const colLayout = {
  xs: { span: 24 },
  sm: { span: 20, offset: 3 },
};

const LayoutHeader = () => (
  <HeaderBlock>
    <Col {...colLayout}>
      <ImgStyled src={logoImg} alt="dam-profile" />
    </Col>
    <Col {...colLayout} style={{ margin: '45px 0 12px' }}>
      <NavMenu />
    </Col>
  </HeaderBlock>
);

export default LayoutHeader;
