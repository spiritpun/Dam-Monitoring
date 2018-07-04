import { PressureActionTypes } from '~/actions/pressure';

const initialState = {
  data: null,
  templateBase64: null,
  isloading: true,
};

export default (state = initialState, action) => {
  switch (action.type) {
    case PressureActionTypes.LOAD_PRESSURE:
      return {
        data: action.pressure_data,
        templateBase64: action.template_base64,
        isloading: false,
      };

    default:
      return state;
  }
};
