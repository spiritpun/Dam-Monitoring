import rp from 'request-promise';

export const REQUEST = 'Request';

export default store => next => action => {
  const callAPI = action[REQUEST];
  if (typeof callAPI === 'undefined') {
    return next(action);
  }

  const {
    type,
    endpoint,
    method,
    ...param
  } = callAPI;

  const requestMethod = String(method).toUpperCase();

  if (!['GET', 'POST', 'PUT', 'DELETE'].includes(requestMethod)) {
    return next(action);
  }

  let options = {
    uri: `${location.origin}${endpoint}`,
    json: true,
  };

  if (requestMethod !== 'GET') {
    options = {
      ...options,
      method: requestMethod,
      body: param,
    };
  }

  const successType = typeof type === 'string' ? type : type[0];
  const errorType = typeof type === 'string' ? null : type[1];

  return rp(options).then(response => next({
    type: successType,
    ...response,
  })).catch(error => next({
    type: errorType || 'setGlobalErrorMessage',
    message: 'Oops!! please check you internet connection',
    error,
  }));
};
