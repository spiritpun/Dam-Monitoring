import { applyMiddleware } from 'redux';
import { createLogger } from 'redux-logger';
import thunk from 'redux-thunk';

// Middleware
import ndsRequest from './ndsRequest';

const middlewareList = [thunk, ndsRequest];

if (process.env.NODE_ENV !== 'production') {
  middlewareList.push(createLogger());
}

export default applyMiddleware(...middlewareList);
