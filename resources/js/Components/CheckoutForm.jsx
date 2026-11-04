import { useForm } from "@inertiajs/react";

export default function CheckoutForm({ cart }) {
  const { data, setData, transform, post, processing, errors } = useForm({
    customerName: "",
    customerEmail: "",
    customerPhone: "",
    shipping_address: "",
    items: [],
  });

  const handleSubmit = (event) => {
    event.preventDefault();

    transform((formData) => ({
      ...formData,
      items: cart.map((item) => ({
        product_id: item.id,
        quantity: item.quantity,
      })),
    }));
    
    post(route("order.checkout"));
  };

  function field(name, label, type = "text") {
    return (
      <label className="form-control w-full">
        <span className="label-text mb-1">{label}</span>
        <input 
          type={type} 
          className="input input-bordered w-full" 
          value={data[name]} 
          onChange={(event) => setData(name, event.target.value)} 
          required 
        />
        {errors[name] && (
          <span className="text-error text-sm mt-1">
            {errors[name]}
          </span>
        )}
      </label>
    );
  }

  return (
    <form onSubmit={handleSubmit} className="card bg-base-100 shadow-md border border-base-300">
      <div className="card-body">
        <h2 className="card-title">Checkout</h2>
        
        {field("customerName", "Full name")}
        {field("customerEmail", "Email", "email")}
        {field("customerPhone", "Phone number", "tel")}
        {field("shipping_address", "Shipping address")}
        
        {errors.items && (
          <p className="text-error text-sm">
            {errors.items}
          </p>
        )}
        
        <button 
          type="submit" 
          className="btn btn-primary mt-3" 
          disabled={processing || cart.length === 0}
        >
          {processing ? "Placing Order..." : "Place Order"}
        </button>
      </div>
    </form>
  );
}
