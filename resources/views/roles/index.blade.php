<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listagem de Funções') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                    {{-- Botão para criar nova Role --}}
                    <div class="flex justify-end">
                        <a href="{{ route('roles.create') }}">
                            <x-primary-button>
                                {{ __('Cadastrar +') }}
                            </x-primary-button>
                        </a>
                    </div>

                    {{-- Tabela de Roles --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nome da Função</th>
                                    <th scope="col" class="px-6 py-3">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $role->name }}
                                    </th>
                                    <td class="px-6 py-4 space-x-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('roles.edit', $role->id) }}" class="text-blue-600 dark:text-blue-500 hover:text-blue-800">
                                                <x-heroicon-o-pencil-square class="h-5 w-5 text-blue-500"/>
                                            </a>
                                            <button
                                                type="button"
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-role-deletion-{{ $role->id }}')"
                                                class="text-red-500"
                                            >
                                                <x-heroicon-s-trash class="h-5 w-5"/>
                                            </button>

                                            <x-modal name="confirm-role-deletion-{{ $role->id }}" focusable>
                                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="p-6">
                                                    @csrf
                                                    @method('DELETE')

                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Tem certeza que deseja excluir esta função?') }}
                                                    </h2>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancelar') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Excluir') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
