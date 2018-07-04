import { createStore, compose } from 'redux';
import rootReducer from '~/reducers';
import DevTools from '~/DevTools';
import middleware from '~/middleware';

const configureStore = preloadedState => {
  const store = createStore(
    rootReducer,
    preloadedState,
    compose(
      middleware,
      DevTools.instrument()
    )
  );

  if (module.hot) {
    // Enable Webpack hot module replacement for reducers
    module.hot.accept('../reducers', () => {
      store.replaceReducer(rootReducer);
    });
  }

  return store;
};

export default configureStore;
