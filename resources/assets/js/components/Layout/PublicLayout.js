import React, { Fragment } from 'react';
import  Header from './LayoutHeader';
import Footer from './LayoutFooter';

const PublicLayout = ({ children }) => (
  <Fragment>
    <Header />
    {children}
    <Footer />
  </Fragment>
);

export default PublicLayout;
