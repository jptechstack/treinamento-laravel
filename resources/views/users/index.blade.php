<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listagem de Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                    <div class="flex justify-end">
                        <a href="{{ route('users.create') }}">
                            <x-primary-button>
                                {{ __('Cadastrar +') }}
                            </x-primary-button>
                        </a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nome de Usuário</th>
                                    <th scope="col" class="px-6 py-3">Funções</th>
                                    <th scope="col" class="px-6 py-3">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $user->name }}
                                    </th>
                                    <td class="px-6 py-4 text-gray-900 dark:text-white whitespace-nowrap">
                                        @if($user->roles->isNotEmpty())
                                            @foreach($user->roles as $role)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-sm text-gray-500">Sem função</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 space-x-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-600 dark:text-blue-500 hover:text-blue-800">
                                                <x-heroicon-o-pencil-square class="h-5 w-5 text-blue-500"/>
                                            </a>
                                            <button
                                                type="button"
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{ $user->id }}')"
                                                class="text-red-500"
                                            >
                                                <x-heroicon-s-trash class="h-5 w-5"/>
                                            </button>

                                            <x-modal name="confirm-user-deletion-{{ $user->id }}" focusable>
                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="p-6">
                                                    @csrf
                                                    @method('DELETE')

                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Tem certeza que deseja excluir este usuário?') }}
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
