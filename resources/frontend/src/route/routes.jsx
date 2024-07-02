import { Routes, Route } from 'react-router-dom';
import DashboardIndex from '../pages/dashboard/dashboard';
import Layout from '../layouts/layout';
// import Home from './components/Home';
// import About from './components/About';

const ShopRoutes = () => {
  return (
    <Routes>
      {/* <Route path="/" exact component={Home} />
      <Route path="/about" component={About} /> */}
      <Route path="/dashboard" element={<Layout />} >
         <Route index element={<DashboardIndex />} />
      </Route>

    </Routes>
  );
};

export default ShopRoutes;
