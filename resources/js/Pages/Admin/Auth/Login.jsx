import { useForm } from "@inertiajs/react";

export default function Login() {
    const { data, setData, post, processing, errors } = useForm({
        email: "",
        password: "",
    });

    function submit(event) {
        event.preventDefault();
        post(route("admin.login.store"));
    }

    return (
        <div className="min-h-screen bg-base-200 flex items-center justify-center p-4">
            <form onSubmit={submit} className="card w-full max-w-md bg-base-100 shadow-md border border-base-300">
                <div className="card-body">
                    <h1 className="card-title">Admin login</h1>

                    <label className="form-control">
                        <span className="label-text mb-1">Email</span>
                        <input
                            type="email"
                            className="input input-bordered"
                            value={data.email}
                            onChange={(event) => setData("email", event.target.value)}
                            required
                            autoComplete="email"
                        />
                        {errors.email && <span className="text-error text-sm mt-1">{errors.email}</span>}
                    </label>

                    <label className="form-control">
                        <span className="label-text mb-1">Password</span>
                        <input
                            type="password"
                            className="input input-bordered"
                            value={data.password}
                            onChange={(event) => setData("password", event.target.value)}
                            required
                            autoComplete="current-password"
                        />
                        {errors.password && <span className="text-error text-sm mt-1">{errors.password}</span>}
                    </label>

                    <button type="submit" className="btn btn-primary mt-2" disabled={processing}>
                        {processing ? "Signing in..." : "Sign in"}
                    </button>
                </div>
            </form>
        </div>
    );
}
