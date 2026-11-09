import { useState } from "react";
import ProductForm from "../../../Components/Admin/ProductForm";
import ProductTable from "../../../Components/Admin/ProductTable";

export default function Index({ products, editingProduct: selectedProduct, flash }) {
    const [editingProduct, setEditingProduct] = useState(selectedProduct);
    const productRows = products.data ?? products;

    return (
        <div className="min-h-screen bg-base-200">
            <div className="navbar bg-base-100 shadow-sm px-4">
                <h1 className="text-xl font-bold">Product management</h1>
            </div>
            <main className="max-w-7xl mx-auto p-4 md:p-8 space-y-6">
                {flash?.success && <div className="alert alert-success">{flash.success}</div>}
                <ProductForm product={editingProduct} onCancel={() => setEditingProduct(null)} />
                <ProductTable products={productRows} />
            </main>
        </div>
    );
}
