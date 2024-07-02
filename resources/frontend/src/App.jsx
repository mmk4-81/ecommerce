import {BrowserRouter} from 'react-router-dom'
import ShopRoutes from './route/routes'
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {

  return (
    <BrowserRouter>
        <ShopRoutes />
    </BrowserRouter>
  )
}

export default App
