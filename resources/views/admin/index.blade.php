@extends('layouts.admin.navigation')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('title', 'Admin Dashboard')

@section('content')
    @include('admin.partials.dashboard.dashboard_title')
    @include('admin.partials.dashboard.dashboard_chart-filter')
    @include('admin.partials.dashboard.dashboard_summary', [
        'totalProducts' => $totalProducts,
        'productsNeedingReorder' => $productsNeedingReorder,
        'totalSalesToday' => $totalSalesToday,
        'pendingOrders' => $pendingOrders,
    ])
        @include('admin.partials.dashboard.dashboard_recent-orders', [
            'recentOrders' => $recentOrders,
        ])
    @include('admin.partials.dashboard.dashboard_chart')

@endsection
