@extends('layouts.app')

@section('title', 'CRM - Usuários')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-gray-800 rounded-3xl shadow-2xl p-8 border border-gray-700">
        {{-- Cabeçalho --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 space-y-4 md:space-y-0">
            <h2 class="text-3xl font-extrabold text-white">Usuários</h2>
            <div class="flex items-center space-x-3">
                <span class="text-gray-400">Filtros: </span>
                <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center space-x-2">
                    {{-- Campo de busca --}}
                    <input type="text" name="search" placeholder="Digite nome ou e-mail"
                           value="{{ request('search') }}"
                           class="rounded-xl bg-gray-900 border-gray-600 text-white text-sm px-4 py-2 focus:ring-orange-500 focus:border-orange-500 placeholder-gray-500">

                    {{-- Filtro por status --}}
                    <select name="status" onchange="this.form.submit()"
                            class="rounded-xl bg-gray-900 border-gray-600 text-white text-sm px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Ativo</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inativo</option>
                    </select>

                    {{-- Filtro por perfil (role) --}}
                    <select name="role_id" onchange="this.form.submit()"
                            class="rounded-xl bg-gray-900 border-gray-600 text-white text-sm px-4 py-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Perfil</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                {{-- Botão adicionar usuário (Laranja) --}}
                <a href="{{ route('admin.users.create') }}"
                   class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md shadow-orange-900/20 transition">
                    + Adicionar Usuário
                </a>
            </div>
        </div>

        {{-- Mensagens --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-100 px-5 py-3 rounded-xl mb-6 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="text-red-400 mb-4 bg-red-900/20 p-4 rounded-xl border border-red-800">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-gray-700">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-700 text-gray-300">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">#</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nome</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">E-mail</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Perfil</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-3 text-right text-sm font-semibold">Ações</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-700 bg-gray-800 text-gray-300">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-700 transition duration-150">
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4 font-medium text-white">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-900 border border-gray-600 text-gray-300">
                                {{ $user->role['name'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="{{ $user->status == 'inactive' ? 'text-red-400 font-semibold' : 'text-green-400 font-semibold' }}">
                                {{ $user->status == 'inactive' ? 'Inativo' : 'Ativo' }}
                            </span>
                        </td>

                        {{-- Icones de ações --}}
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-3">

                                {{-- Editar --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   class="text-yellow-500 hover:text-yellow-400 cursor-pointer transition" title="Editar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                         stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a2.121 2.121 0 113
                             3L12 15l-4 1 1-4 7.862-7.513z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M18 14v6H6v-6" />
                                    </svg>
                                </a>

                                {{-- Excluir --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400 cursor-pointer transition" title="Excluir">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                             stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 7h12M9 7V4h6v3m-7 4v7m4-7v7m4-7v7" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">
                            Nenhum usuário encontrado com os filtros atuais.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div class="mt-6 text-gray-300">
            {{ $users->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
