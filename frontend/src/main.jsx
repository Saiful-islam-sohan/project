import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.jsx'
import { AuthProvider } from './pages/auth/AuthContext'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    {/* <App /> */}
    <AuthProvider>
      <App />
    </AuthProvider>,
  </StrictMode>,
)
