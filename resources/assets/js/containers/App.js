import React from 'react';
import { Provider } from 'react-redux';
import { Route, Switch } from 'react-router-dom';
import { Helmet } from 'react-helmet';
import 'antd/dist/antd.css';
import DevTools from '~/DevTools';
import PublicLayout from '../components/Layout/PublicLayout';
import PressureSimulation from './PressureSimulation';

const isProd = process.env.NODE_ENV === 'production';

const App = ({ store }) => (
  <Provider store={store}>
    <PublicLayout>
      <Helmet><title>Welcome to Dam monitoring system</title></Helmet>
      <Switch>
        <Route exact path="/" component={PressureSimulation} />
        <Route exact path="/:any" render={() => <h1>not found</h1>} />
      </Switch>
      {!isProd && <DevTools />}
    </PublicLayout>
  </Provider>
);

export default App;
