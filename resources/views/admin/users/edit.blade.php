@extends('layouts.app')

@section('title', 'CRM - Editar Usuário')

@section('content')
    <div class="w-full max-w-lg mx-auto bg-gray-800 rounded-3xl shadow-2xl p-10 border border-gray-700">
        <h2 class="text-3xl font-extrabold text-center text-white mb-10">Editar Usuário</h2>

        {{-- Mensagem de sucesso --}}
        @if(session('success'))
            <div class="bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensagens de erro --}}
        @if($errors->any())
            <div class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Nome</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 placeholder-gray-500">
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">E-mail</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 placeholder-gray-500">
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Perfil</label>
                <select name="role_id" required
                        class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm">
                    <option value="" class="text-gray-500">Selecione o perfil</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-300 mb-2">Status</label>
                <select name="status" required
                        class="w-full bg-gray-900 border-2 border-gray-600 text-white focus:border-orange-500 focus:ring-orange-500 rounded-xl px-5 py-3 shadow-sm">
                    <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Ativo</option>
                    <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inativo</option>
                </select>
                @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-orange-900/20 transition cursor-pointer transform hover:scale-[1.01]">
                Atualizar Usuário
            </button>
        </form>
    </div>
@endsection
