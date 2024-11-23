<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Создать новый чек-лист') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('checklists.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Название чек-листа</label>
                            <input type="text" name="title" id="title" class="block w-full mt-1 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300" required>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('checklists.index') }}" class="px-4 py-2 mr-2 text-sm text-gray-600 bg-gray-200 rounded-md dark:bg-gray-600 dark:text-gray-300">Отмена</a>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md dark:bg-blue-500">Создать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
