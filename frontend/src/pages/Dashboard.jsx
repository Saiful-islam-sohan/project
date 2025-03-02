

import { useAuth } from "../pages/auth/AuthContext";

const Dashboard = () => {
  const { auth } = useAuth();

  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold mb-4">Dashboard</h1>
      <p>Welcome, {auth.user?.name}!</p>

      {/* Show admin-specific content only to admin users */}
      {auth.user?.role.toLowerCase() === "admin" && (
        <div className="mt-4">
          <h2 className="text-xl font-semibold">Admin Options</h2>
          <button
            onClick={() => console.log("Admin action")}
            className="bg-green-500 text-white px-4 py-2 rounded"
          >
            Perform Admin Action
          </button>
        </div>
      )}
    </div>
  );
};

export default Dashboard;