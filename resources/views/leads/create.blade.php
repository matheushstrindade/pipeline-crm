@extends('layouts.app')

@section('title', 'CRM - Cadastrar Lead')

@section('content')
    <div class="w-full max-w-2xl mx-auto bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
        <h2 class="text-3xl font-extrabold text-center text-white mb-10">Cadastrar Lead</h2>

        {{-- Mensagens --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-100 px-5 py-3 rounded-xl mb-6 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-900/20 border border-red-800 text-red-400 px-5 py-3 rounded-xl mb-6 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="{{ route('leads.store') }}" class="space-y-6">
            @csrf

            {{-- Cliente --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Cliente</label>
                <select id="client-select" name="client_id"
                        class="bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-3 py-2 shadow-sm w-full">
                    <option value="" class="text-gray-500">Selecione o cliente</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id || request('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Título da Lead --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Título</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm placeholder-gray-500">
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descrição da Lead --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Descrição da Lead</label>
                <textarea name="description" rows="4" required
                          class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm placeholder-gray-500">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Valor estimado --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Valor estimado</label>
                <input type="number" step="0.01" name="estimated_value" value="{{ old('estimated_value') }}" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm placeholder-gray-500">
                @error('estimated_value')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nivel de Interesse --}}
            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Nivel de Interesse</label>
                <select name="interest_levels" required
                        class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm">
                    <option value="" class="text-gray-500">Selecione o nível de interesse</option>
                    <option value="Frio" {{ old('interest_levels') === 'Frio' ? 'selected' : '' }}>Frio</option>
                    <option value="Morno" {{ old('interest_levels') === 'Morno' ? 'selected' : '' }}>Morno</option>
                    <option value="Quente" {{ old('interest_levels') === 'Quente' ? 'selected' : '' }}>Quente</option>
                </select>
                @error('interest_levels')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Responsável - Só Gestor tem acesso --}}
            @if(auth()->user()->isManager())
                <div>
                    <label class="block text-sm font-semibold text-gray-300 mb-2">Atribuir Responsável</label>
                    <select name="owner_id" required
                            class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm">
                        <option value="" class="text-gray-500">Selecione o responsável por essa lead</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('owner_id') === $user->id || auth()->user()->getAuthIdentifier() === $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('owner_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            {{-- Seta o estágio do pipeline em Contato (id = 1) --}}
            <input type="hidden" name="pipeline_stage_id" value="1">

            {{-- Seta o status da lead como nova (id = 1) --}}
            <input type="hidden" name="status" value="new">

            {{-- Botões --}}
            <div class="flex items-center justify-between">
                {{-- Voltar --}}
                <a href="{{ route('leads.index') }}"
                   class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition cursor-pointer">
                    Voltar
                </a>

                {{-- Cadastrar Lead --}}
                <button type="submit"
                        class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-orange-900/20 transition transform hover:scale-[1.02] cursor-pointer">
                    Cadastrar Lead
                </button>
            </div>

        </form>
    </div>
@endsection
