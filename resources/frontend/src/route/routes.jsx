import { Routes, Route } from 'react-router-dom';
import Home from '../pages/Home/Home';
import Products from '../pages/Products/Products';
import Shops from '../pages/Shops/Shops';
import Login from '../pages/Login/Login';
import SignUp from '../pages/SignUp/SignUp';
import Profile from '../pages/Profile/Profile';
import Dashboard from '../pages/dashboard/dashboard';
import LogoutDialog from '../pages/logout/logout';
import NotFound from '../pages/NotFound/NotFound ';

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/products" element={<Products />} />
      <Route path="/shops" element={<Shops />} />
      <Route path="/login" element={<Login />} />
      <Route path="/signup" element={<SignUp />} />
      <Route path="/profile" element={<Profile />} />
      <Route path="/dashboard" element={<Dashboard />} />
      <Route path="/logout" element={<LogoutDialog />} />
      <Route path="*" element={<NotFound />} />
    </Routes>
  );
}

export default AppRoutes;
