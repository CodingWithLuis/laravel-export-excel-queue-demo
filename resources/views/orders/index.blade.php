<x-layouts.app>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Exportar</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <form action="{{ route('orders.export') }}" method="POST">
            @csrf
            <x-button type="primary" class="w-full">Exportar Ordenes</x-button>
        </form>
    </div>

</x-layouts.app>
