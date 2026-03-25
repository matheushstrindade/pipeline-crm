@extends('layouts.app')

@section('title', 'Diagnóstico #{{ $diagnostic->id }}')

@section('content')
    <div class="container mx-auto p-4">
        {{-- Card Principal: Mantido estrutura, alterado bg-white para bg-gray-800 --}}
        <div class="bg-gray-800 p-8 rounded-lg shadow-2xl max-w-4xl mx-auto border border-gray-700">

            {{-- Header --}}
            <div class="flex justify-between items-start mb-8 border-b border-gray-700 pb-4">
                <div>
                    {{-- Título Branco e ID Laranja --}}
                    <h1 class="text-3xl font-extrabold text-white">Diagnóstico <span class="text-orange-500">#{{ $diagnostic->id }}</span></h1>
                    <p class="text-lg text-gray-400">
                        Lead: <a href="{{ route('leads.show', $leadId) }}" class="text-orange-500 hover:text-orange-400 font-semibold transition">{{ $diagnostic->lead->name ?? 'Lead Desconhecido' }}</a>
                    </p>
                </div>
                <div class="flex space-x-3">
                    {{-- Botão Editar Laranja --}}
                    <a href="{{ route('leads.diagnostics.edit', ['lead_id' => $leadId, 'diagnostic' => $diagnostic->id]) }}" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                        Editar
                    </a>
                    {{-- Botão Deletar Vermelho --}}
                    <form action="{{ route('leads.diagnostics.destroy', ['lead_id' => $leadId, 'diagnostic' => $diagnostic->id]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este diagnóstico? Esta ação não pode ser desfeita.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-300">
                            Deletar
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Coluna de Detalhes --}}
                <div>
                    <h2 class="text-xl font-semibold mb-3 text-white">Informações Básicas</h2>
                    <div class="space-y-3">
                        <p class="text-sm">
                            <span class="font-medium text-gray-400">Assessor Responsável:</span>
                            <span class="text-gray-200">{{ $diagnostic->diagnosedBy->name ?? 'N/A' }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-400">Data do Registro:</span>
                            <span class="text-gray-200">{{ $diagnostic->created_at->format('d/m/Y H:i') }}</span>
                        </p>
                        <p class="text-sm">
                            <span class="font-medium text-gray-400">Nível de Urgência:</span>
                            <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full border border-opacity-20
                            @if($diagnostic->urgency_level === 'Alta') bg-red-900/50 text-red-300 border-red-500
                            @elseif($diagnostic->urgency_level === 'Média') bg-yellow-900/50 text-yellow-300 border-yellow-500
                            @else bg-green-900/50 text-green-300 border-green-500
                            @endif">
                            {{ $diagnostic->urgency_level }}
                        </span>
                        </p>
                    </div>
                </div>

                {{-- Coluna de Anexos --}}
                <div>
                    <h2 class="text-xl font-semibold mb-3 text-white">Anexos ({{ $diagnostic->attachments->count() }})</h2>
                    @if($diagnostic->attachments->isEmpty())
                        <p class="text-sm text-gray-500 italic">Nenhum documento anexado.</p>
                    @else
                        <ul class="list-disc ml-5 text-orange-500">
                            @foreach($diagnostic->attachments as $attachment)
                                <li><a href="#" class="hover:underline text-gray-300 hover:text-orange-400">{{ $attachment->file_name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                    {{-- Botão para anexar --}}
                    <button class="mt-4 text-sm text-orange-500 hover:text-orange-400 font-semibold hover:underline flex items-center">
                        Anexar Novo Documento
                    </button>
                </div>
            </div>

            {{-- Seção de Detalhes do Diagnóstico --}}
            <div class="mt-8 border-t border-gray-700 pt-8 space-y-8">
                <div>
                    <h2 class="text-xl font-semibold mb-3 text-white">Descrição do Problema</h2>
                    {{-- Mantido p-4 e rounded-lg, alterado apenas cores para bg-gray-900 e text-gray-200 --}}
                    <div class="bg-gray-900 p-4 rounded-lg border border-gray-600 text-gray-200 whitespace-pre-line shadow-inner">{{ $diagnostic->problem_description }}</div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-3 text-white">Necessidades do Cliente</h2>
                    <div class="bg-gray-900 p-4 rounded-lg border border-gray-600 text-gray-200 whitespace-pre-line shadow-inner">{{ $diagnostic->customer_needs }}</div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-3 text-white">Soluções Possíveis</h2>
                    <div class="bg-gray-900 p-4 rounded-lg border border-gray-600 text-gray-200 whitespace-pre-line shadow-inner">{{ $diagnostic->possible_solutions }}</div>
                </div>
            </div>

            <div class="mt-10">
                <a href="{{ route('leads.diagnostics.index', $leadId) }}" class="text-gray-400 hover:text-white transition text-sm">← Voltar para a Lista de Diagnósticos</a>
            </div>
        </div>
    </div>
@endsection
