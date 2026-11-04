
import ProductCard from "./ProductCard";

export default function ProductList({ products, onAdd }) {
    if (products.length === 0) {
        return (
            <p className="text-center py-10">
                No products available.
            </p>
        );
    }

    return (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {products.map((product) => (
                <ProductCard
                    key={product.id}
                    product={product}
                    onAdd={onAdd}
                />
            ))}
        </div>
    );
}
