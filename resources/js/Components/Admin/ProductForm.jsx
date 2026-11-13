import { useEffect } from "react";
import { useForm } from "@inertiajs/react";

export default function ProductForm({ product, onCancel }) {
    const {
        data,
        setData,
        post,
        put,
        processing,
        errors,
        clearErrors,
    } = useForm({
        name: product?.name ?? "",
        description: product?.description ?? "",
        price: product?.price ?? "",
        image: product?.image ?? "",
        stock: product?.stock ?? 0,
        is_active: product?.is_active ?? true,
    });


    useEffect(() => {
        setData({
            name: product?.name ?? "",
            description: product?.description ?? "",
            price: product?.price ?? "",
            image: product?.image ?? "",
            stock: product?.stock ?? 0,
            is_active: product?.is_active ?? true,
        });
        clearErrors();
    }, [product]);



    function submit(event) {
        event.preventDefault();
        if (product) {
            put(route("admin.products.update", product.id), {
                onSuccess: onCancel,
            });
        } else {
            post(route("admin.products.store"), {
                onSuccess: onCancel,
            });
        }
    }
    

    function field(name, label, type = "text") {
        return (
            <label className="form-control">
                <span className="label-text mb-1">{label}</span>
                <input
                    type={type}
                    className="input input-bordered"
                    value={data[name]}
                    onChange={(event) => setData(name, event.target.value)}
                    required={name !== "image"}
                />
                {errors[name] && (
                    <span className="text-error text-sm mt-1">{errors[name]}</span>
                )}
            </label>
        );
    }
    

    return (
        <form onSubmit={submit} className="card bg-base-100 shadow-md border border-base-300">
            
            <div className="card-body">
                <h2 className="card-title">{product ? "Edit product" : "Add product"}</h2>
                {field("name", "Name")}
                {field("description", "Description")}
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {field("price", "Price", "number")}
                    {field("stock", "Stock", "number")}
                </div>


                {field("image", "Image URL", "url")}
                <label className="label cursor-pointer justify-start gap-3">
                    <input
                        type="checkbox"
                        className="checkbox checkbox-primary"
                        checked={data.is_active}
                        onChange={(event) => setData("is_active", event.target.checked)}
                    />
                    <span className="label-text">Visible in catalog</span>
                </label>


                <div className="card-actions justify-end">
                    {product && <button type="button" className="btn btn-ghost" onClick={onCancel}>Cancel</button>}
                    <button type="submit" className="btn btn-primary" disabled={processing}>
                        {processing ? "Saving..." : product ? "Update product" : "Add product"}
                    </button>
                </div>

            </div>

        </form>
    );
}
