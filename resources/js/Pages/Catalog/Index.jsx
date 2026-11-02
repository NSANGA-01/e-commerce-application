


import { useState } from "react";
import ProductList from "../../Components/ProductList";
import Cart from "../../Components/Cart";
import CheckoutForm from "../../Components/CheckoutForm";

export default function Index({ products }) {
    const [cart, setCart] = useState([]);

    function addToCart(product) {
        setCart((currentCart) => {
            const existing = currentCart.find(
                (item) => item.id === product.id
            );

            if (existing) {
                if (existing.quantity >= product.stock) {
                    return currentCart;
                }

                return currentCart.map((item) =>
                    item.id === product.id
                        ? { ...item, quantity: item.quantity + 1 }
                        : item
                );
            }

            if (product.stock <= 0) {
                return currentCart;
            }

            return [...currentCart, { ...product, quantity: 1 }];
        });
    }

    function increaseQuantity(id) {
        setCart((currentCart) =>
            currentCart.map((item) =>
                item.id === id && item.quantity < item.stock
                    ? { ...item, quantity: item.quantity + 1 }
                    : item
            )
        );
    }

    function decreaseQuantity(id) {
        setCart((currentCart) =>
            currentCart
                .map((item) =>
                    item.id === id
                        ? { ...item, quantity: item.quantity - 1 }
                        : item
                )
                .filter((item) => item.quantity > 0)
        );
    }

    function removeFromCart(id) {
        setCart((currentCart) =>
            currentCart.filter((item) => item.id !== id)
        );
    }

    return (
        <div className="min-h-screen bg-base-200">
            <div className="navbar bg-base-100 shadow-sm px-4">
                <div className="flex-1">
                    <h1 className="text-xl font-bold">
                        My Store
                    </h1>
                </div>

                <div className="badge badge-primary">
                    Cart: {cart.reduce(
                        (sum, item) => sum + item.quantity,
                        0
                    )}
                </div>
            </div>

            <main className="max-w-7xl mx-auto p-4 md:p-8 space-y-8">
                <section>
                    <h2 className="text-2xl font-bold mb-5">
                        Our Products
                    </h2>

                    <ProductList
                        products={products}
                        onAdd={addToCart}
                    />
                </section>

                <section className="grid grid-cols-1 lg:grid-cols-2 gap-6 items-start">
                    <Cart
                        cart={cart}
                        onIncrease={increaseQuantity}
                        onDecrease={decreaseQuantity}
                        onRemove={removeFromCart}
                    />

                    <CheckoutForm cart={cart} />
                </section>
            </main>
        </div>
    );
}
