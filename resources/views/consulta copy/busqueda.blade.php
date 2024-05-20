<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-12 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                @if (session('error'))
                    <div>{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('consulta') }}">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="npersonal">
                            Ingresa tú número de personal
                        </label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="np" type="text" name="np" required="required" autofocus="autofocus">
                    </div>



                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                            Buscar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>