@extends('layouts.app')

@section('title', 'CAPAIAN - BBLSDM KOMDIGI MEDAN')

@push('styles')
    <style>
        .iframe-container {
            width: 100%;
            height: calc(100vh - 180px);
            /* Adjust based on navbar and padding */
            min-height: 600px;
            overflow: hidden;
            background: #fff;
        }

        iframe {
            display: block;
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
@endpush

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-white">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Capaian BBLSDM Komdigi Medan</h2>
                <p class="text-sm text-gray-500 mt-1">Dashboard Monitoring Capaian Kinerja</p>
            </div>
            <div class="flex space-x-2">
                <button onclick="document.getElementById('app-iframe').contentWindow.location.reload();"
                    class="p-2 text-gray-400 hover:text-primary transition-colors" title="Reload Dashboard">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <a href="https://script.google.com/macros/s/AKfycbzOjXny9akv6Cy2qPliZx5szx590ssUDGawk57I8qz0Ufij4gAPPMNC6mOP3Plf7bSHKA/exec"
                    target="_blank" class="p-2 text-gray-400 hover:text-primary transition-colors" title="Buka di Tab Baru">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>
        </div>
        <div class="p-0">
            <div class="iframe-container">
                <iframe id="app-iframe"
                    src="https://script.google.com/macros/s/AKfycbzOjXny9akv6Cy2qPliZx5szx590ssUDGawk57I8qz0Ufij4gAPPMNC6mOP3Plf7bSHKA/exec"
                    scrolling="yes" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"
                    allow="fullscreen">
                </iframe>
            </div>
        </div>
    </div>
@endsection