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
      customer_name: formData.customerName,
      customer_email: formData.customerEmail,
      customer_phone: formData.customerPhone,
      shipping_address: formData.shipping_address,
      items: cart.map((item) => ({
        product_id: item.id,
        quantity: item.quantity,
      })),
    }));
    
    post(route("order.checkout"));
  };

  function field(name, label, type = "text", errorName = name) {
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
        {errors[errorName] && (
          <span className="text-error text-sm mt-1">
            {errors[errorName]}
          </span>
        )}
      </label>
    );
  }

  return (
    <form onSubmit={handleSubmit} className="card bg-base-100 shadow-md border border-base-300">
      <div className="card-body">
        <h2 className="card-title">Checkout</h2>
        
        {field("customerName", "Full name", "text", "customer_name")}
        {field("customerEmail", "Email", "email", "customer_email")}
        {field("customerPhone", "Phone number", "tel", "customer_phone")}
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
