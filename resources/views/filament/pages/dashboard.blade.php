<x-filament::page>
  <div class="text-xl font-bold">Добро пожаловать в панель управления</div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
    <x-filament::card>
      <div class="text-sm text-gray-500">Количество пользователей</div>
      <div class="text-2xl font-bold">{{ \App\Models\User::count() }}</div>
    </x-filament::card>

    <x-filament::card>
      <div class="text-sm text-gray-500">Всего тестов</div>
      <div class="text-2xl font-bold">{{ \App\Models\Quiz::count() }}</div>
    </x-filament::card>
  </div>
</x-filament::page>