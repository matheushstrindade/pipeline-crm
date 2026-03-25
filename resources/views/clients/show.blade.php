@extends('layouts.app')

@section('title', 'CRM - Visualizar Cliente')

@section('content')
    <div class="flex flex-col w-full max-w-2xl mx-auto space-y-8">
        {{-- Card de Informações do Cliente --}}
        <div class="w-full bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
            <h2 class="text-3xl font-extrabold text-center text-white mb-10">{{ $client->name }}</h2>

            {{-- CPF e Nome --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">CPF</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">
                        {{ preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $client->cpf) }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Nome</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">{{ $client->name }}</p>
                </div>
            </div>

            {{-- Email e Telefone --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">E-mail</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200 truncate">{{ $client->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Telefone</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">
                        {{ preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $client->phone) }}
                    </p>
                </div>
            </div>

            {{-- Endereço, Cidade, Estado --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-1">Endereço</label>
                <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">{{ $client->address }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Cidade</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">{{ $client->city }}</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Estado</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">{{ $client->state }}</p>
                </div>
            </div>

            {{-- Redes Sociais --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-300 mb-2">Redes Sociais</label>
                @if ($client->socialNetworks->isNotEmpty())
                    <ul class="space-y-2">
                        @foreach($client->socialNetworks as $social_network)
                            <li class="flex items-center justify-between bg-gray-900 border border-gray-600 px-4 py-2 rounded-xl shadow-sm">
                                <span class="text-gray-300">{{ $social_network->name }}:
                                    <a href="{{ $social_network->pivot->profile_url }}" target="_blank" class="text-orange-500 hover:text-orange-400 hover:underline transition">
                                        {{ $social_network->pivot->profile_url }}
                                    </a>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 italic">Nenhuma rede social cadastrada.</p>
                @endif
            </div>

            {{-- Origem do Contato e Data de Cadastro --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Origem do Contato</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">
                        {{ $client->contactSource->description }}
                    </p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-1">Data de Cadastro</label>
                    <p class="w-full border-2 border-gray-600 rounded-xl px-5 py-3 shadow-sm bg-gray-900 text-gray-200">
                        {{ date_format($client->created_at, 'd/m/Y') }}
                    </p>
                </div>
            </div>

            {{-- Botões de Ação --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 mt-8">
                {{-- Voltar --}}
                <a href="{{ route('clients.index') }}"
                   class="w-full md:w-auto text-center bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition cursor-pointer">
                    Voltar
                </a>

                <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                    {{-- Editar (Laranja) --}}
                    <a href="{{ route('clients.edit', $client->id) }}"
                       class="w-full md:w-auto text-center bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-orange-900/20 transition cursor-pointer transform hover:scale-[1.02]">
                        Editar
                    </a>

                    {{-- Excluir (Vermelho) --}}
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="w-full md:w-auto inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Tem certeza que deseja excluir este cliente?')"
                                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition cursor-pointer transform hover:scale-[1.02]">
                            Excluir
                        </button>
                    </form>

                    {{-- Cadastrar Lead (Verde) --}}
                    <a href="{{ route('leads.create', ['client_id' => $client->id]) }}"
                       class="w-full md:w-auto text-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition cursor-pointer transform hover:scale-[1.02]">
                        Cadastrar Lead
                    </a>
                </div>
            </div>
        </div>

        {{-- Lista de Leads --}}
        <div class="w-full bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
            <h3 class="text-2xl font-bold mb-6 text-white border-b border-gray-700 pb-2">Leads Cadastradas</h3>
            @if($leads->isNotEmpty())
                <div class="overflow-x-auto rounded-xl border border-gray-700">
                    <table class="w-full text-left">
                        <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-600">Título</th>
                            <th class="px-6 py-3 border-b border-gray-600">Status</th>
                            <th class="px-6 py-3 border-b border-gray-600">Data de Criação</th>
                            <th class="px-6 py-3 border-b border-gray-600">Ações</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 bg-gray-800 text-gray-300">
                        @foreach($leads as $lead)
                            <tr class="hover:bg-gray-700 transition">
                                <td class="px-6 py-4 truncate font-medium text-white">{{ $lead->title }}</td>
                                <td class="px-6 py-4">
                                    @switch($lead->status)
                                        @case('new') <span class="text-blue-400 font-semibold">Nova</span> @break
                                        @case('on_going') <span class="text-yellow-400 font-semibold">Em Andamento</span> @break
                                        @case('completed') <span class="text-green-400 font-semibold">Finalizada</span> @break
                                        @case('lost') <span class="text-red-400 font-semibold">Perdida</span> @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4">{{ $lead->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 space-x-3">
                                    <a href="{{ route('leads.show', $lead->id) }}" class="text-orange-500 hover:text-orange-400 hover:underline cursor-pointer">Ver</a>
                                    <a href="{{ route('leads.edit', $lead->id) }}" class="text-yellow-500 hover:text-yellow-400 hover:underline cursor-pointer">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-6">
                    <p class="text-gray-500 italic">Nenhuma lead cadastrada para este cliente.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
