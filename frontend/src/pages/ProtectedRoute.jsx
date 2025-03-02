// import { Navigate } from "react-router-dom";

// const ProtectedRoute = ({ children }) => {
//   const token = localStorage.getItem("authToken");
//   return token ? children : <Navigate to="/login" />;
// };

// export default ProtectedRoute;

import { Navigate } from "react-router-dom";
import { useAuth } from "../pages/auth/AuthContext";

const ProtectedRoute = ({ children, requiredRole }) => {
    const { auth } = useAuth();

    if (!auth.token) {
        return <Navigate to="/login" />;
    }

    if (requiredRole && auth.user?.role.toLowerCase() !== requiredRole) {
        return <Navigate to="/dashboard" />;
    }

    return children;
};

export default ProtectedRoute;