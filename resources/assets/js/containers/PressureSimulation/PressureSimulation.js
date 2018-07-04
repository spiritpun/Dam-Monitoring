import React from 'react';
import { Helmet } from 'react-helmet';
import { connect } from 'react-redux';
import { compose, lifecycle } from 'recompose';
import { Row, Col } from 'antd';
import { Pressure as Action } from '~/actions';
import { PressureSimulate } from '~/components';
import maengud from '~/profile/maengud';
import { PressureSection } from './style';

const PressureSimulation = ({ pressure }) => (
  <PressureSection>
    <Helmet>
      <title>โครงการ | Pressure Simulator</title>
    </Helmet>
    <Row style={{ marginTop: '20px' }}>
      <Col xs={24} sm={{ span: 12, offset: 6 }}>
        <PressureSimulate profile={maengud} pressureSimulator={pressure} isLoading={pressure.isloading} />
      </Col>
    </Row>
  </PressureSection>
);

export default compose(
  connect(
    state => ({ pressure: state.pressure }),
    dispatch => ({ loadPressure: () => dispatch(Action.getDataPressureSimulate()) }),
  ),
  lifecycle({
    componentDidMount() {
      this.props.loadPressure();
    },
  }),
)(PressureSimulation);
