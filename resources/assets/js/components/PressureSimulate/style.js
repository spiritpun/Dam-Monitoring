import styled from 'styled-components';
import { Button } from 'antd';

export const SimulateSection = styled.div`
    position: relative;

    canvas {
        max-width: 100%;
    }
    
    canvas#renderSection {
        position: relative;
        z-index: 1;
    }

    canvas#renderPressure {
        position: absolute;
        z-index: 0;
        top: 0px;
        left: 0px;
    }
`;

export const SpinCenter = styled.div`
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    width: 20px;
    height: 25px;
`;

export const CenterBtn = styled(Button)`
    position: absolute;
    top: 0px;
    bottom: 0px;
    right: 0px;
    left: 0px;
    margin: auto;
    width: 202px;
    height: 32px;
    z-index: 10;
`;

export const TerminateSimulateBtn = styled(Button)`
    position: absolute;
    top: 25px;
    right: 0px;
    z-index: 10;
`;
