
import { isEmpty, chunk } from 'lodash';
import Bluebird from 'bluebird';
import moment from '~/_moment';

let canvas = null;
let canvasDamSection = null;
let damSection = null;
let distance = {};
let onlyHasValue = true;
let quality = 1;

const end2Pi = 2 * Math.PI;

// less to more
const alpha = 0.1;
let initialSimulate = 0.1;

export const setupRendering = ({ canvasPressureId, canvasDamSectionId, damsectionImage }) => {
  damSection = damsectionImage;
  canvas = canvasPressureId;
  canvasDamSection = canvasDamSectionId;
  distance = {};
  renderDamsection();
  onlyHasValue = true;
  quality = 2;
};

export const renderDamsection = () => new Promise((resolve) => {
  const context = canvasDamSection.getContext('2d');
  const bgImage = new Image();
  bgImage.src = damSection;
  bgImage.onload = () => {
    context.drawImage(bgImage, 0, 0);
    resolve(true);
  };
});

export const renderFrameData = ({ data, time }) => new Promise(resolve => {
  const context = canvas.getContext('2d');
  calculatePressureCoordinate({ data }).then(({ femStack, barScale }) => {
    // Clear after calculated
    clearCanvas();

    context.fillStyle = '#222';
    context.font = '15px Arial';
    context.textAlign = 'right';
    context.fillText(moment(time, 'YYYY-MM-DD HH:mm:ss').format('LLLL'), 1090, 40);

    putBarScaleValue(barScale).then(() => {
      drawPressureShade({ femStack }).then(() => {
        drawSensorPoint({ data }).then(() => {
          setTimeout(() => resolve(canvas.toDataURL()), 500);
        });
      });
    });
  });
});

export const renderFrameDataCache = (cacheDataURL) => new Promise(resolve => {
  clearCanvas();
  const context = canvas.getContext('2d');
  const bgImage = new Image();
  bgImage.src = cacheDataURL;
  bgImage.onload = () => {
    context.drawImage(bgImage, 0, 0);
    setTimeout(() => resolve(true), 1500);
  };
});

export const renderBarScale = () => {
  const context = canvasDamSection.getContext('2d');
  const barScaleCtx = context.createLinearGradient(0, 0, 300, 0);
  barScaleCtx.addColorStop(0, '#0000FF');
  barScaleCtx.addColorStop(0.25, '#00FFFF');
  barScaleCtx.addColorStop(0.5, '#00FF00');
  barScaleCtx.addColorStop(0.75, '#FFFF00');
  barScaleCtx.addColorStop(1, '#FF0000');
  context.fillStyle = barScaleCtx;
  context.fillRect(20, 20, 300, 20);
};

const putBarScaleValue = ({ maxValue, minValue }) => new Promise(resolve => {
  const step = maxValue / 5;
  const plotStep = 300 / 5;
  const context = canvas.getContext('2d');
  const scale = [];

  for (let i = 0; i <= 5; i += 1) {
    scale.push(Number(i === 0 ? minValue : (i * step)).toFixed(2));
  }

  Promise.all(scale.map((value, index) => new Promise(_internalResolve => {
    context.fillStyle = '#222';
    context.font = '11px Arial';
    context.textAlign = 'center';
    context.textBaseline = 'hanging';
    context.fillText(String(value), (Math.round(index * plotStep) + 20), 50);
    _internalResolve({ value: String(value), x: (Math.round(index * plotStep) + 20), y: 50 });
  }))).then(() => {
    resolve(true);
  });
});

/**
 * 0 <= rgb (0, +0, 255)
 * 25 <= rgb (0, 255, -255)
 * 50 <= rgb (+0, 255, 0)
 * 75 <= rgb (255, -255, 0)
 * 100 == rgb (255, 0, 0)
 */
const stressDistributionShade = (percentageReal) => {
  let r = 0;
  let g = 0;
  let b = 0;
  let a = alpha;

  const percentage = percentageReal > 100 ? 100 : percentageReal;

  if (percentage > 0 && percentage < 25) {
    r = 0;
    g = stepColor({ baseValue: 0, currentValue: percentage });
    b = 255;
    a = 0.08;
  } else if (percentage >= 25 && percentage < 50) {
    r = 0;
    g = 255;
    b = 255 - stepColor({ baseValue: 25, currentValue: percentage });
    a = 0.09;
  } else if (percentage >= 50 && percentage < 75) {
    r = stepColor({ baseValue: 50, currentValue: percentage });
    g = 255;
    b = 0;
    a = 0.1;
  } else {
    // Nearly Max
    r = 255;
    g = 255 - stepColor({ baseValue: 75, currentValue: percentage });
    b = 0;
    a = 0.15;
  }

  return {
    rgba: {
      r, g, b, a,
    },
    section: Math.round(percentage),
  };
};

const stepColor = ({ baseValue, currentValue }) => Math.round(((currentValue - baseValue) * 255) / 25);

const clearCanvas = () => {
  canvas.getContext('2d').clearRect(0, 0, 1200, 500);
};

const drawSensorPoint = ({ data }) => new Promise((resolve) => {
  const context = canvas.getContext('2d');
  const promiseList = Object.keys(data).map((sensorPoint) => new Promise((_resolve) => {
    const { coor: [x, y], extend, value } = data[sensorPoint];
    if (!extend) {
      if (value > 0) {
        context.font = '10px Arial';
        context.textAlign = 'left';
        context.fillStyle = '#000';
        context.fillText(` ${Number(value).toFixed(2)}`, x, y);
      }

      context.beginPath();
      context.fillStyle = '#F00';
      context.arc(x, y, 1.5, 0, end2Pi);
      context.fill();
    }

    _resolve(true);
  }));

  Promise.all(promiseList).then(() => {
    resolve(true);
  });
});

const calculateDistance = ({
  x1, y1, x2, y2,
}) => {
  const driffX = x2 - x1;
  const driffY = y2 - y1;
  return {
    distance: Math.sqrt((driffX ** 2) + (driffY ** 2)),
    driffX,
    driffY,
  };
};

const findMaxPressure = ({ data }) => new Promise((resolve) => {
  let maxPressure = 0;
  const totalIndexSensor = Object.keys(data).length - 1;
  Object.keys(data).forEach((sensorId, index) => {
    maxPressure = maxPressure < data[sensorId].value ? data[sensorId].value : maxPressure;
    if (totalIndexSensor === index) {
      resolve({ maxPressure });
    }
  });
});

const calculatePressureCoordinate = ({ data }) => new Promise(resolve => {
  const totalIndexSensor = Object.keys(data).length - 1;

  // Calculate Shade Step
  const femStack = {};
  const barScale = { maxValue: 0, minValue: 0 };
  findMaxPressure({ data }).then(({ maxPressure }) => {
    initialSimulate = maxPressure * 0.02;
    barScale.maxValue = maxPressure;
    barScale.minValue = initialSimulate;

    // Draw Pressure Line
    Object.keys(data).forEach((sensorInit, indexInit) => {
      Object.keys(data).forEach((sensorEnd, indexEnd) => {
        if ((sensorInit !== sensorEnd) && isEmpty(distance[`${sensorInit}${sensorEnd}`]) && isEmpty(distance[`${sensorEnd}${sensorInit}`])) {
          const { coor: [x1, y1], value: pressureInit } = data[sensorInit];
          const { coor: [x2, y2], value: pressureEnd } = data[sensorEnd];

          const continueCheck = onlyHasValue ? (pressureInit > 0 && pressureEnd > 0) : true;

          if (continueCheck) {
            const { distance: realDistance, driffX, driffY } = calculateDistance({
              x1, y1, x2, y2,
            });

            // Calculate Data Difference
            const pressureDiff = pressureEnd - pressureInit;
            const totalPropPressure = Math.ceil(realDistance / quality);

            // Calculate Plot Step
            const distanceStep = realDistance / totalPropPressure;

            // Plot stack
            for (let multiply = 0; (Math.abs(multiply * distanceStep) < realDistance); multiply += 1) {
              const distanceOffset = distanceStep * multiply;
              const Xn = Math.round((distanceOffset / (realDistance / driffX)) + x1);
              const Yn = Math.round((distanceOffset / (realDistance / driffY)) + y1);
              const currentPressure = pressureInit + ((pressureDiff * distanceOffset) / realDistance);

              if (currentPressure > initialSimulate) {
                const percentage = (currentPressure / maxPressure) * 100;
                const {
                  rgba: {
                    r, g, b, a,
                  }, section: indexPressure,
                } = stressDistributionShade(percentage);

                femStack[`p${indexPressure}`] = femStack[`p${indexPressure}`] || [];
                femStack[`p${indexPressure}`].push({
                  coor: { x: Xn, y: Yn },
                  rgba: {
                    r, g, b, a,
                  },
                });
              }
            }
          }

          // Prevent recalculate in revert route: improve perforance
          distance[`${sensorInit}${sensorEnd}`] = true;
          distance[`${sensorEnd}${sensorInit}`] = true;
        }

        if ((totalIndexSensor === indexEnd) && (totalIndexSensor === indexInit)) {
          resolve({ femStack, barScale });
        }
      });
    });
  });
});

const drawPressureShadeAsync = ({ list }) => new Promise((resolve) => {
  const context = canvas.getContext('2d');
  const totalPointIndex = list.length - 1;
  list.forEach(({
    coor: { x, y }, rgba: {
      r, g, b, a,
    },
  }, i) => {
    context.fillStyle = `rgba(${r}, ${g}, ${b}, ${a})`;
    context.beginPath();
    context.arc(x, y, 12, 0, end2Pi);
    context.fill();
    if (i === totalPointIndex) {
      resolve(true);
    }
  });
});

const drawPressureShade = ({ femStack }) => new Promise((resolve) => {
  new Bluebird.each(Object.keys(femStack), (pressureKey) => new Promise((_resInternal) => {
    const promiseList = chunk(femStack[pressureKey], 512).map((list) => drawPressureShadeAsync({ list }));
    Promise.all(promiseList).then(() => {
      _resInternal(true);
    });
  })).then(() => {
    resolve(true);
  });
});
