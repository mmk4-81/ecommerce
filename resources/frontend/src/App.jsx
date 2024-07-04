import { BrowserRouter, useLocation } from 'react-router-dom';
import AppRoutes from './route/routes';
import ResponsiveAppBar from './components/Navbar/Navbar';

const App = () => {
  const location = useLocation();
  const noNavbarRoutes = ['/login', '/signup', '/profile', '/dashboard', '/logout', '*']; 

  return (
    <div className="App">
      {!noNavbarRoutes.includes(location.pathname) && <ResponsiveAppBar />}
      <div style={{ marginTop: noNavbarRoutes.includes(location.pathname) ? '0' : '80px' }}>
        <AppRoutes />
      </div>
    </div>
  );
}

const AppWrapper = () => (
  <BrowserRouter>
    <div className='container'>
      <App />
    </div>
  </BrowserRouter>
);

export default AppWrapper;
