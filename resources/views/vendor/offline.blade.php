@extends('layouts.app')
@section('content')
<div class="flex flex-col items-center justify-center h-[70vh] text-center">
    <div class="w-20 h-20 bg-slate-200 rounded-full flex items-center justify-center mb-4 text-3xl">📡</div>
    <h2 class="text-xl font-bold text-slate-800">Kamu sedang Offline</h2>
    <p class="text-sm text-slate-500 mt-2 px-8">Aplikasi ini butuh internet untuk memuat data terbaru.</p>
    <button onclick="window.location.reload()" class="mt-6 bg-indigo-600 text-white px-6 py-2 rounded-full text-sm font-medium">Coba Lagi</button>
</div>
@endsection