import { router } from "@inertiajs/react";

export default function ProductTable({ products }) {
    if (products.length === 0) {
        return <p className="card bg-base-100 p-8 text-center">No products yet.</p>;
    }

    function remove(product) {
        if (window.confirm(`Delete "${product.name}"?`)) {
            router.delete(route("admin.products.destroy", product.id));
        }
    }

    function edit(product) {
        router.get(route("admin.products.edit", product.id));
    }

    return (
        <div className="overflow-x-auto card bg-base-100 shadow-md border border-base-300">
            <table className="table">
                <thead>
                    <tr><th>Product</th><th>Price</th><th>Stock</th><th>Status</th><th /></tr>
                </thead>
                <tbody>
                    {products.map((product) => (
                        <tr key={product.id}>
                            <td><div className="font-semibold">{product.name}</div><div className="text-sm opacity-60">{product.description}</div></td>
                            <td>{Number(product.price).toLocaleString()} RWF</td>
                            <td>{product.stock}</td>
                            <td><span className={`badge ${product.is_active ? "badge-success" : "badge-ghost"}`}>{product.is_active ? "Active" : "Hidden"}</span></td>
                            <td className="text-right whitespace-nowrap">
                                <button className="btn btn-sm btn-ghost" onClick={() => edit(product)}>Edit</button>
                                <button className="btn btn-sm btn-error btn-outline" onClick={() => remove(product)}>Delete</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}
