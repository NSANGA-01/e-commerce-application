
import { Head, Link } from "@inertiajs/react";
import {Link , usePage} from "@inertiajs/react";


export default function Confirmation({ order }) {

    const { flash } = usePage().props;
    return (
        <div className="min-h-screen bg-base-200 p-4 md:p-8">
            {flash.message && (
                <div className="alert alert-success">
                    <span>{flash.message}</span>
                </div>
            )}
            <Head title="Order Confirmation" />

            <div className="max-w-2xl mx-auto">
                <div className="card bg-base-100 shadow-xl">
                    <div className="card-body items-center text-center">
                        <div className="text-5xl text-success">
                            ✓
                        </div>

                        <h1 className="text-2xl font-bold">
                            Thank you for your order!
                        </h1>

                        <p className="opacity-70">
                            Your order has been received successfully.
                        </p>

                        <div className="alert alert-success mt-4">
                            <span>
                                Order number:{" "}
                                <strong>{order.order_number}</strong>
                            </span>
                        </div>

                        <div className="w-full text-left space-y-2 mt-4">
                            <div className="flex justify-between gap-4">
                                <span>Order status</span>
                                <strong>{order.status}</strong>
                            </div>

                            <div className="flex justify-between gap-4">
                                <span>Total</span>
                                <strong>
                                    {Number(order.total).toLocaleString()} RWF
                                </strong>
                            </div>
                        </div>

                        <Link
                            href={route("catalog")}
                            className="btn btn-primary mt-5"
                        >
                            Continue Shopping
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
