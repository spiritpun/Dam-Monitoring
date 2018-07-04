import React from 'react';
import moment from 'moment';
import Styled from 'styled-components';
import { Row, Col } from 'antd';
import logoImg from '~/images/footer_logo.png';

const RowStyle = Styled(Row)`
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  color: #6699cc;
  font-size: 12px;
  margin-top: 15px;
  p {
      font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
  }
`;

const FooterText = Styled.div`
    float: left;
    margin-left: 6px;
`;

const FooterTextLine1 = Styled.p`
    margin: 8px 0px 0px;
`;

const FooterTextLine2 = Styled.p`
    margin: 0px;
`;

const ImgStyled = Styled.img`
  width: '100%';
  float: left;
`;

const LayoutFooter = () => (
  <RowStyle>
    <Col xs={24} sm={{ span: 20, offset: 3 }} >
      <ImgStyled src={logoImg} alt="" />
      <FooterText>
        <FooterTextLine1>
          (2014 - {moment().format('YYYY')}) by Regional Irrigation Office 1 of Royal Irrigation Department, Thailand
        </FooterTextLine1>
        <FooterTextLine2>
          Brought to you by NDS | TryCatch™
        </FooterTextLine2>
      </FooterText>
    </Col>
  </RowStyle>
);

export default LayoutFooter;
