@extends('layouts.app')

@section('title', 'Registrar Diagnóstico')

@section('content')
    <div class="w-full max-w-2xl mx-auto bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
        <h1 class="text-3xl font-extrabold text-center text-white mb-2">Registrar Novo Diagnóstico</h1>
        <p class="text-center text-gray-400 mb-10">Lead ID: <span class="font-mono text-orange-500">#{{ $leadId }}</span></p>

        <form action="{{ route('leads.diagnostics.store', $leadId) }}" method="POST" class="space-y-6">
            @csrf

            {{-- Campo: Descrição do Problema --}}
            <div>
                <label for="problem_description" class="block text-sm font-semibold text-gray-300 mb-2">Descrição do Problema</label>
                <textarea name="problem_description" id="problem_description" rows="3"
                          class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm placeholder-gray-500">{{ old('problem_description') }}</textarea>
                @error('problem_description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo: Necessidades do Cliente --}}
            <div>
                <label for="customer_needs" class="block text-sm font-semibold text-gray-300 mb-2">Necessidades do Cliente</label>
                <textarea name="customer_needs" id="customer_needs" rows="3"
                          class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm placeholder-gray-500">{{ old('customer_needs') }}</textarea>
                @error('customer_needs')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo: Soluções Possíveis --}}
            <div>
                <label for="possible_solutions" class="block text-sm font-semibold text-gray-300 mb-2">Soluções Possíveis</label>
                <textarea name="possible_solutions" id="possible_solutions" rows="3"
                          class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm placeholder-gray-500">{{ old('possible_solutions') }}</textarea>
                @error('possible_solutions')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Campo: Nível de Urgência --}}
            <div>
                <label for="urgency_level" class="block text-sm font-semibold text-gray-300 mb-2">Nível de Urgência</label>
                <select name="urgency_level" id="urgency_level"
                        class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm">
                    <option value="Baixa" {{ old('urgency_level') == 'Baixa' ? 'selected' : '' }}>Baixa</option>
                    <option value="Média" {{ old('urgency_level') == 'Média' ? 'selected' : '' }}>Média</option>
                    <option value="Alta" {{ old('urgency_level') == 'Alta' ? 'selected' : '' }}>Alta</option>
                </select>
            </div>

            {{-- Botões --}}
            <div class="flex items-center justify-between pt-4">
                {{-- Cancelar --}}
                <a href="{{ route('leads.diagnostics.index', $leadId) }}"
                   class="inline-block bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg transition cursor-pointer">
                    Cancelar
                </a>

                {{-- Salvar --}}
                <button type="submit"
                        class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-orange-900/20 transition transform hover:scale-[1.02] cursor-pointer">
                    Salvar Diagnóstico
                </button>
            </div>
        </form>
    </div>
@endsection
