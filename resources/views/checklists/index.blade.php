<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Чеклисты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Кнопка для создания нового чек-листа -->
                    <div class="mb-4">
                        <a href="{{ route('checklists.create') }}" class="px-4 py-2 text-sm text-white bg-green-600 rounded-md dark:bg-green-500">Создать новый чек-лист</a>
                    </div>

                    @foreach ($checklists as $checklist)
                        <div class="mb-6">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold">{{ $checklist->title }}</h1>

                                <!-- Кнопка для удаления чек-листа -->
                                <form action="{{ route('checklists.destroy', $checklist) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-1 text-sm text-white bg-red-600 rounded-md dark:bg-red-500" onclick="return confirm('Вы уверены, что хотите удалить этот чек-лист?');">
                                        Удалить
                                    </button>
                                </form>
                            </div>

                            <ul class="pl-5 list-disc">
                                @forelse ($checklist->items as $item)
                                    <li class="flex items-center {{ $item->is_completed ? 'line-through text-gray-500' : '' }}">
                                        <!-- Форма с чекбоксом для изменения статуса пункта -->
                                        <form action="{{ route('checklists.items.update', [$checklist, $item]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input
                                                type="checkbox"
                                                name="is_completed"
                                                value="1"
                                                class="mr-2"
                                                onchange="this.form.submit()"
                                                {{ $item->is_completed ? 'checked' : '' }}
                                            >
                                            {{ $item->description }}
                                        </form>
                                    </li>
                                @empty
                                    <p class="text-sm text-gray-500">Чек-лист пока не содержит пунктов.</p>
                                @endforelse
                            </ul>

                            <!-- Форма для добавления нового пункта в чек-лист -->
                            <form action="{{ route('checklists.items.store', $checklist) }}" method="POST" class="mt-4">
                                @csrf
                                <div class="flex items-center">
                                    <input type="text" name="description" class="block w-full mr-2 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300" placeholder="Добавить новый пункт..." required>
                                    <button type="submit" class="px-4 py-1 text-sm text-white bg-blue-600 rounded-md dark:bg-blue-500">Добавить</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
