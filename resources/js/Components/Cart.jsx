


export default function Cart({
    cart,
    onIncrease,
    onDecrease,
    onRemove,
}) {
    const total = cart.reduce(
        (sum, item) => sum + Number(item.price) * item.quantity,
        0
    );

    return (
        <div className="card bg-base-100 shadow-md border border-base-300">
            <div className="card-body">
                <h2 className="card-title">
                    Shopping Cart ({cart.length})
                </h2>

                {cart.length === 0 ? (
                    <p>Your cart is empty.</p>
                ) : (
                    <>
                        {cart.map((item) => (
                            <div
                                key={item.id}
                                className="flex justify-between items-center gap-3 border-b border-base-300 py-3"
                            >
                                <div>
                                    <p className="font-semibold">
                                        {item.name}
                                    </p>

                                    <p className="text-sm opacity-70">
                                        {Number(item.price).toLocaleString()} RWF
                                    </p>
                                </div>

                                <div className="flex items-center gap-2">
                                    <button
                                        type="button"
                                        className="btn btn-xs"
                                        onClick={() => onDecrease(item.id)}
                                    >
                                        −
                                    </button>

                                    <span>{item.quantity}</span>

                                    <button
                                        type="button"
                                        className="btn btn-xs"
                                        disabled={item.quantity >= item.stock}
                                        onClick={() => onIncrease(item.id)}
                                    >
                                        +
                                    </button>

                                    <button
                                        type="button"
                                        className="btn btn-error btn-xs"
                                        onClick={() => onRemove(item.id)}
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        ))}

                        <div className="flex justify-between font-bold text-lg pt-3">
                            <span>Total</span>
                            <span>
                                {total.toLocaleString()} RWF
                            </span>
                        </div>
                    </>
                )}
            </div>
        </div>
    );
}
