// import { Link } from "react-router-dom";

// const Navbar = () => {
//   return (
//     <nav className="bg-blue-600 p-4 text-white">
//       <div className="container mx-auto flex justify-between items-center">
//         <Link to="/" className="text-xl font-bold">
//           MyApp
//         </Link>
//         <div className="space-x-4">
//           <Link to="/login" className="hover:text-gray-200">
//             Login
//           </Link>
//           <Link to="/register" className="hover:text-gray-200">
//             Register
//           </Link>
//         </div>
//       </div>
//     </nav>
//   );
// };

// export default Navbar;

import { Link } from "react-router-dom";
import { useAuth } from "../pages/auth/AuthContext";

const Navbar = () => {
  const { auth } = useAuth();

  return (
    // <nav>
    //   <Link to="/dashboard">Dashboard</Link>
    //   {auth.user?.role === "admin" && <Link to="/admin">Admin Panel</Link>}
    // </nav>
    <nav className="bg-blue-600 p-4 text-white">
      <div className="container mx-auto flex justify-between items-center">
        <Link to="/" className="text-xl font-bold">
          MyApp
        </Link>
        <div className="space-x-4">
          {/* Show Admin Panel link only to admin users */}
          {auth.user?.role.toLowerCase() === "admin" && (
            <Link to="/admin" className="hover:text-gray-200">
              Admin Panel
            </Link>
          )}
          <Link to="/dashboard" className="hover:text-gray-200">
            Dashboard
          </Link>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;