

function Welcome() {
    return (
        <div className="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div className="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div className="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <h1 className="text-3xl font-bold text-gray-900 dark:text-white">Welcome to Inertia.js!</h1>
                </div>  
                <div className="mt-6">
                    <p className="text-gray-700 dark:text-gray-300">
                        This is a simple welcome page for the Inertia.js application.
                    </p>
                </div>
            </div>
        </div>
    );
}

export default Welcome;