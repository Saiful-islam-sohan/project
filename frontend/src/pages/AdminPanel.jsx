import { useEffect, useState } from "react";
import API from "../api/axios";
import { toast } from "react-toastify";
import { useAuth } from "../pages/auth/AuthContext";

const AdminPanel = () => {
    const [users, setUsers] = useState([]);
    const { auth } = useAuth(); // Access the auth state

    // Fetch all users
    const fetchUsers = async () => {
        try {
            const response = await API.get("/admin/users");
            setUsers(response.data);
        } catch (error) {
            toast.error("Failed to fetch users");
        }
    };

    useEffect(() => {
        fetchUsers();
    }, []);

    return (
        <div className="p-6">
            <h1 className="text-2xl font-bold mb-4">Admin Panel</h1>

            
            {auth.user?.role.toLowerCase() === "admin" && (
                <div className="mb-4">
                    <button
                        onClick={() => console.log("Add new user")}
                        className="bg-green-500 text-white px-4 py-2 rounded"
                    >
                        Add New User
                    </button>
                </div>
            )}

            {/* Display users table */}
            <div className="overflow-x-auto">
                <table className="min-w-full bg-white border">
                    <thead>
                        <tr>
                            <th className="py-2 px-4 border">ID</th>
                            <th className="py-2 px-4 border">Name</th>
                            <th className="py-2 px-4 border">Email</th>
                            <th className="py-2 px-4 border">Role</th>
                            {auth.user?.role.toLowerCase() === "admin" && (
                                <th className="py-2 px-4 border">Actions</th>
                            )}
                        </tr>
                    </thead>
                    <tbody>
                        {users.map((user) => (
                            <tr key={user.id}>
                                <td className="py-2 px-4 border">{user.id}</td>
                                <td className="py-2 px-4 border">{user.name}</td>
                                <td className="py-2 px-4 border">{user.email}</td>
                                <td className="py-2 px-4 border">{user.role}</td>
                                {auth.user?.role.toLowerCase() === "admin" && (
                                    <td className="py-2 px-4 border">
                                        <button>
                                            Delete
                                        </button>
                                    </td>
                                )}
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );


};

export default AdminPanel;