

export default function ProductCard({ product, onAdd }) {
    return (
        <div className="card bg-base-100 shadow-md border border-base-300">
            <div className="card-body">
                <h2 className="card-title">
                    {product.name}
                </h2>
                <img src={product.image} alt={product.name} className="w-80 h-40 rounded-md object-cover shrink-0" />
                <p className="text-sm opacity-70">
                    {product.description}
                </p>

                <p className="text-lg font-bold text-primary">
                    {Number(product.price).toLocaleString()} RWF
                </p>

                <p className="text-sm">
                    Stock: {product.stock}
                </p>

                <div className="card-actions justify-end">
                    <button
                        type="button"
                        className="btn btn-primary"
                        disabled={product.stock <= 0}
                        onClick={() => onAdd(product)}
                    >
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    );
}
