@extends('layouts.app')

@section('title', 'Diagnósticos do Lead #{{ $leadId }}')

@section('content')
    <div class="w-full max-w-6xl mx-auto bg-gray-800 rounded-3xl shadow-2xl p-8 border border-gray-700">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-extrabold text-white">
                Diagnósticos do Lead <span class="text-orange-500">#{{ $leadId }}</span>
            </h1>
            <a href="{{ route('leads.diagnostics.create', $leadId) }}"
               class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-orange-900/20 transition duration-300 transform hover:scale-[1.02]">
                + Registrar Novo Diagnóstico
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-100 px-5 py-3 rounded-xl relative mb-6 text-sm font-medium" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($diagnostics->isEmpty())
            <div class="bg-yellow-900/20 border-l-4 border-yellow-600 text-yellow-500 p-6 rounded-r-xl" role="alert">
                <p class="font-medium">Nenhum diagnóstico registrado para este Lead ainda.</p>
            </div>
        @else
            <div class="overflow-x-auto rounded-xl border border-gray-700">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Assessor</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Nível de Urgência</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Descrição do Problema (Início)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Criado em</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-300 uppercase tracking-wider">Ações</th>
                    </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @foreach ($diagnostics as $diagnostic)
                        <tr class="hover:bg-gray-700 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $diagnostic->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">{{ $diagnostic->diagnosedBy->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border border-opacity-20
                                    @if($diagnostic->urgency_level === 'Alta') bg-red-900/50 text-red-300 border-red-500
                                    @elseif($diagnostic->urgency_level === 'Média') bg-yellow-900/50 text-yellow-300 border-yellow-500
                                    @else bg-green-900/50 text-green-300 border-green-500
                                    @endif">
                                    {{ $diagnostic->urgency_level }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ Str::limit($diagnostic->problem_description, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $diagnostic->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                <a href="{{ route('leads.diagnostics.show', ['lead_id' => $leadId, 'diagnostic' => $diagnostic->id]) }}" class="text-orange-500 hover:text-orange-400 transition">Ver</a>
                                <a href="{{ route('leads.diagnostics.edit', ['lead_id' => $leadId, 'diagnostic' => $diagnostic->id]) }}" class="text-yellow-500 hover:text-yellow-400 transition">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('leads.show', $leadId) }}" class="inline-flex items-center text-gray-400 hover:text-white transition group">
                <span class="mr-2 group-hover:-translate-x-1 transition-transform">←</span> Voltar para o Lead
            </a>
        </div>
    </div>
@endsection
