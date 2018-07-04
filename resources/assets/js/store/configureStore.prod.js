import { createStore } from 'redux';
import rootReducer from '~/reducers';
import middleware from '~/middleware';

const configureStore = preloadedState => createStore(
  rootReducer,
  preloadedState,
  middleware,
);

export default configureStore;
