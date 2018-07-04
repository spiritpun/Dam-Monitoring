import React, { Fragment } from 'react';
import Responsive from 'react-responsive';
import NavMenuTop from './NavMenuTop';
import NavMenuCollapsed from './NavMenuCollapsed';

const Desktop = props => <Responsive {...props} minWidth={992} />;
const Device = props => <Responsive {...props} maxWidth={991} />;

const contain = () => (
  <Fragment>
    <Desktop><NavMenuTop /></Desktop>
    <Device><NavMenuCollapsed /></Device>
  </Fragment>
);

export default contain;
