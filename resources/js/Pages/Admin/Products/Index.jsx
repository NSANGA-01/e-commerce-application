import { router } from "@inertiajs/react";
import { useState } from "react";
import ProductForm from "../../../Components/Admin/ProductForm";
import ProductTable from "../../../Components/Admin/ProductTable";

export default function Index({ products, flash }) {
    const [editingProduct, setEditingProduct] = useState(null);
    const productRows = products.data ?? products;

    return (
        <div className="min-h-screen bg-base-200">
            <div className="navbar bg-base-100 shadow-sm px-4">
                <h1 className="text-xl font-bold">Product management</h1>
                <button
                    type="button"
                    className="btn btn-sm btn-ghost ml-auto"
                    onClick={() => router.post(route("admin.logout"))}
                >
                    Logout
                </button>
            </div>
            <main className="max-w-7xl mx-auto p-4 md:p-8 space-y-6">
                {flash?.success && <div className="alert alert-success">{flash.success}</div>}
                <ProductForm />
                <ProductTable
                    products={productRows}
                    onEdit={setEditingProduct}
                />
                {editingProduct && (
                    <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
                        <div className="w-full max-w-2xl">
                            <ProductForm
                                product={editingProduct}
                                onCancel={() => setEditingProduct(null)}
                            />
                        </div>
                    </div>
                )}
            </main>
        </div>
    );
}
