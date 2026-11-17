import { useEffect } from "react";
import { useForm } from "@inertiajs/react";

export default function OrderDetails({ order, onCancel }) {
    const { data, setData, put, processing, errors } = useForm({
        status: order?.status ?? "pending",
    });

    useEffect(() => {
        setData("status", order?.status ?? "pending");
    }, [order]);

    function submit(event) {
        event.preventDefault();
        put(route("admin.orders.status", order.id));
    }

    return (
        <section className="card bg-base-100 shadow-md border border-base-300">
            <div className="card-body">
                <div className="flex items-center justify-between gap-4">
                    <h2 className="card-title">Order {order.order_number}</h2>
                    <button type="button" className="btn btn-ghost" onClick={onCancel}>Close</button>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <p><strong>Customer:</strong> {order.customer_name}</p>
                    <p><strong>Email:</strong> {order.customer_email}</p>
                    <p><strong>Phone:</strong> {order.customer_phone || "—"}</p>
                    <p><strong>Shipping address:</strong> {order.shipping_address}</p>
                </div>
                <div className="divider my-1" />
                <div className="space-y-2">
                    {order.order_items?.map((item) => (
                        <div key={item.id} className="flex justify-between">
                            <span>{item.product?.name ?? "Product"} × {item.quantity}</span>
                            <span>{Number(item.total).toLocaleString()} RWF</span>
                        </div>
                    ))}
                    <div className="flex justify-between font-bold">
                        <span>Total</span>
                        <span>{Number(order.total_amount).toLocaleString()} RWF</span>
                    </div>
                </div>
                <form onSubmit={submit} className="card-actions justify-end items-end mt-4">
                    <label className="form-control">
                        <span className="label-text mb-1">Status</span>
                        <select className="select select-bordered" value={data.status} onChange={(event) => setData("status", event.target.value)}>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        {errors.status && <span className="text-error text-sm mt-1">{errors.status}</span>}
                    </label>
                    <button type="submit" className="btn btn-primary" disabled={processing}>
                        {processing ? "Saving..." : "Update status"}
                    </button>
                </form>
            </div>
        </section>
    );
}
