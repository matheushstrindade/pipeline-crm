@extends('layouts.app')

@section('title', 'CRM - Painel Administrativo')

@section('content')
    <div class="w-full max-w-5xl mx-auto bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
        <h2 class="text-3xl font-extrabold text-white mb-10 text-center">Painel Administrativo</h2>

        {{-- Cards administrativos --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Gestão de Usuários --}}
            <a href="{{ route('admin.users.index') }}"
               class="group bg-gray-900 border border-gray-700 rounded-2xl shadow-md hover:shadow-xl hover:shadow-orange-900/20 hover:border-orange-500/50 transition transform hover:-translate-y-1 p-10 flex flex-col items-center text-center">

                <div class="bg-gray-800 text-orange-500 rounded-full p-4 mb-4 group-hover:scale-110 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m7 0A4 4 0 0012 7a4 4 0 00-1 7.87m6-7.87a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>

                <h3 class="text-xl font-semibold text-white mb-2">Gestão de Usuários</h3>
                <p class="text-gray-400 text-sm mb-4">Adicione, edite e gerencie os acessos dos usuários do sistema.</p>
                <span class="text-orange-500 font-semibold group-hover:text-orange-400 group-hover:underline transition">Acessar</span>
            </a>

            {{-- Configurações --}}
            <a href="{{ route('admin.settings.index') }}"
               class="group bg-gray-900 border border-gray-700 rounded-2xl shadow-md hover:shadow-xl hover:shadow-orange-900/20 hover:border-orange-500/50 transition transform hover:-translate-y-1 p-10 flex flex-col items-center text-center">

                <div class="bg-gray-800 text-orange-500 rounded-full p-4 mb-4 group-hover:scale-110 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0a1.724 1.724 0 001.302 1.155c.937.177 1.26 1.36.566 2.013l-.932.882a1.724 1.724 0 000 2.446l.932.882c.694.653.37 1.836-.566 2.013a1.724 1.724 0 00-1.302 1.155c-.3.921-1.603.921-1.902 0a1.724 1.724 0 00-1.302-1.155c-.937-.177-1.26-1.36-.566-2.013l.932-.882a1.724 1.724 0 000-2.446l-.932-.882c-.694-.653-.37-1.836.566-2.013a1.724 1.724 0 001.302-1.155z" />
                    </svg>
                </div>

                <h3 class="text-xl font-semibold text-white mb-2">Configurações</h3>
                <p class="text-gray-400 text-sm mb-4">Personalize preferências e parâmetros do sistema.</p>
                <span class="text-orange-500 font-semibold group-hover:text-orange-400 group-hover:underline transition">Acessar</span>
            </a>
        </div>
    </div>
@endsection
