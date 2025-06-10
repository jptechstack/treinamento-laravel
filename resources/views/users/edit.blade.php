<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Função') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-6">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Nome da Role -->
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Nome da Função')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $role->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="permissions" :value="__('Permissões da Função')" />

                        <div class="grid grid-cols-2 gap-2">
                            @foreach($permissions as $permission)
                                <x-checkbox-input
                                    name="permissions"
                                    :value="$permission->id"
                                    :label="$permission->name"
                                    :checked="in_array($permission->id, $selectedPermissions)"
                                />
                            @endforeach
                        </div>

                        <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                    </div>

                    <!-- Botão de salvar e cancelar -->
                    <div class="flex justify-end space-x-4 mt-6">
                        <!-- Botão Cancelar -->
                        <a href="{{ route('roles.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cancelar') }}
                        </a>

                        <!-- Botão Salvar -->
                        <x-primary-button>
                            {{ __('Salvar') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
