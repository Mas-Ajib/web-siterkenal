<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<style>
        div {
            font-family: 'Montserrat', sans-serif;
        }
</style>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg">
                <i class="fas fa-users text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Admin</h3>
                <p class="text-2xl font-semibold text-gray-900">1</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <i class="fas fa-chart-bar text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Statistik</h3>
                <p class="text-2xl font-semibold text-gray-900">Coming Soon</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-lg">
                <i class="fas fa-bell text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Notifikasi</h3>
                <p class="text-2xl font-semibold text-gray-900">0</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Selamat Datang di Admin SITERKENAL</h3>
    </div>
    <div class="p-6">
        <p class="text-gray-600">Halo <strong>{{ Auth::guard('admin')->user()->name }}</strong>, selamat datang di panel administrator SITERKENAL.</p>
        <p class="text-gray-600 mt-2">Anda login sebagai: <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ Auth::guard('admin')->user()->role }}</span></p>
    </div>
</div>
@endsection