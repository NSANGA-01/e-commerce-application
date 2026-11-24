import { router } from "@inertiajs/react";

export default function OrderTable({ orders }) {
    if (orders.length === 0) {
        return <p className="card bg-base-100 p-8 text-center">No orders yet.</p>;
    }

    function view(order) {
        router.get(route("admin.orders.show", order.id));
    }

    return (
        <div className="overflow-x-auto card bg-base-100 shadow-md border border-base-300">
            <table className="table">
                <thead>
                    <tr><th>Order</th><th>Customer</th><th>Total</th><th>Status</th><th /></tr>
                </thead>
                <tbody>
                    {orders.map((order) => (
                        <tr key={order.id}>
                            <td className="font-semibold">{order.order_number}</td>
                            <td><div>{order.customer_name}</div><div className="text-sm opacity-60">{order.customer_email}</div></td>
                            <td>{Number(order.total_amount).toLocaleString()} RWF</td>
                            <td><span className={`badge ${order.status === "completed" ? "badge-success" : order.status === "cancelled" ? "badge-error" : "badge-warning"}`}>{order.status}</span></td>
                            <td className="text-right">
                                <button className="btn btn-sm btn-ghost" onClick={() => view(order)}>View details</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
