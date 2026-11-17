import { router } from "@inertiajs/react";
import OrderDetails from "../../../Components/Admin/OrderDetails";
import OrderTable from "../../../Components/Admin/OrderTable";

export default function Index({ orders, selectedOrder, flash }) {
    const orderRows = orders.data ?? orders;

    return (
        <div className="min-h-screen bg-base-200">
            <div className="navbar bg-base-100 shadow-sm px-4">
                <h1 className="text-xl font-bold">Order management</h1>
            </div>
            <main className="max-w-7xl mx-auto p-4 md:p-8 space-y-6">
                {flash?.success && <div className="alert alert-success">{flash.success}</div>}
                {selectedOrder && <OrderDetails order={selectedOrder} onCancel={() => router.get(route("admin.orders.index"))} />}
                <OrderTable orders={orderRows} />
            </main>
        </div>
    );
}
