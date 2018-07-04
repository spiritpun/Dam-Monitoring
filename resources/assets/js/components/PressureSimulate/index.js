import React from 'react';
import { compose, withState, withHandlers, lifecycle } from 'recompose';
import { isEmpty } from 'lodash';
import { Spin } from 'antd';
import { setupRendering, renderFrameData, renderBarScale, renderFrameDataCache } from '~/utils/beanField';
import { SimulateSection, TerminateSimulateBtn, CenterBtn, SpinCenter } from './style';

const PressureSimulate = ({
  runSimulate,
  pressureSimulator,
  isLoading,
  startSimulateHandler,
  stopSimulateHandler,
  renderPressure,
  renderSection,
}) => (
  <SimulateSection>
    <canvas id="renderSection" width="1200" height="500" ref={renderSection} />
    <canvas id="renderPressure" width="1200" height="500" ref={renderPressure} />
    {runSimulate && <TerminateSimulateBtn type="danger" onClick={() => stopSimulateHandler()}>หยุดระบบ</TerminateSimulateBtn>}
    {(!runSimulate && pressureSimulator.data) && <CenterBtn type="primary" size="large" onClick={() => startSimulateHandler()}>เริ่มระบบจำลองสถานการณ์</CenterBtn>}
    {(pressureSimulator.data && isLoading) && <CenterBtn type="dashed" size="large" disabled>ข้อมูลไม่พร้อมแสดงผล</CenterBtn>}
    {isLoading === true && (
      <SpinCenter>
        <Spin />
      </SpinCenter>
    )}
  </SimulateSection>
);

const runSimulator = props => frameIndex => {
  const { pressureSimulator, frameCache, runSimulate } = props;
  const totalFrame = pressureSimulator.data.length;
  const { time: dateTime } = pressureSimulator.data[frameIndex];

  if (isEmpty(frameCache[dateTime])) {
    if (frameIndex === 0) renderBarScale();

    renderFrameData(pressureSimulator[frameIndex]).then((dataURL) => {
      frameCache[dateTime] = dataURL;
      props.setframeCache(frameCache);
      if (runSimulate) runSimulator((frameIndex + 1) % totalFrame);
    });
  } else {
    renderFrameDataCache(frameCache[dateTime]).then(() => {
      if (runSimulate) runSimulator((frameIndex + 1) % totalFrame);
    });
  }
};

export default compose(
  withState('runSimulate', 'setRunSimulate', false),
  withState('frameCache', 'setframeCache', null),
  withState('renderPressure', 'setRenderPressure', React.createRef()),
  withState('renderSection', 'setRenderSection', React.createRef()),
  withHandlers({
    runSimulator: props => (frameIndex = 0) => {
      const { pressureSimulator, frameCache, runSimulate } = props;
      const totalFrame = pressureSimulator.data.length;
      const { time: dateTime } = pressureSimulator.data[frameIndex];

      if (isEmpty(frameCache) || isEmpty(frameCache[dateTime])) {
        if (frameIndex === 0) renderBarScale();

        renderFrameData(pressureSimulator.data[frameIndex]).then((dataURL) => {
          frameCache[dateTime] = dataURL;
          props.setframeCache(frameCache);
          if (runSimulate) runSimulator((frameIndex + 1) % totalFrame);
        });
      } else {
        renderFrameDataCache(frameCache[dateTime]).then(() => {
          if (runSimulate) runSimulator((frameIndex + 1) % totalFrame);
        });
      }
    },
  }),
  withHandlers({
    stopSimulateHandler: props => () => props.setRunSimulate(false),
    startSimulateHandler: props => () => {
      props.runSimulator();
      props.setRunSimulate(true);
    },
  }),
  lifecycle({
    componentDidMount() {
      const { profile: { pressure: { dam_section: damsectionImage } }, renderSection, renderPressure } = this.props;
      setupRendering({ canvasPressureId: renderPressure.current, canvasDamSectionId: renderSection.current, damsectionImage });
    },
  }),
)(PressureSimulate);
