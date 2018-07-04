import { REQUEST } from '~/middleware/ndsRequest';

const requestData = (options) => ({
  [REQUEST]: options,
});

export const PressureActionTypes = {
  LOAD_PRESSURE: 'loadPressureSimulate',
};

export default {
  getDataPressureSimulate: () => dispatch => {
    const options = {
      type: PressureActionTypes.LOAD_PRESSURE,
      endpoint: '/api/pressure?start=2018-06-16%2000:00:00&end=2018-06-16%2023:59:00',
      method: 'GET',
    };

    return dispatch(requestData(options));
  },
};
