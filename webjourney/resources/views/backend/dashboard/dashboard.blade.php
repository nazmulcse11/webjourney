@extends('backend.layouts.master')
@section('title', 'Dashboard')

@section('style')
<style>
    .metric-card {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }
    .pulse-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #28a745;
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .pulse-dot {
        width: 8px;
        height: 8px;
        background-color: #ffffff;
        border-radius: 50%;
        animation: pulseAnimation 1.5s infinite;
    }
    @keyframes pulseAnimation {
        0% { transform: scale(0.95); opacity: 0.8; }
        50% { transform: scale(1.3); opacity: 1; }
        100% { transform: scale(0.95); opacity: 0.8; }
    }
</style>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold" style="color: #1e293b;">{{ __('Dashboard') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <!-- Real-time Top Summary Row -->
                <div class="row mb-4">
                    <!-- Real-time Active Users -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card metric-card mb-0" style="background: #17a2b8; color: #fff; border-radius: 8px; padding: 20px; height: 100%; border: none;">
                            <div class="d-flex align-items-center">
                                <div style="width: 48px; height: 48px; background-color: rgba(255, 255, 255, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 22px; flex-shrink: 0; margin-right: 16px;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 13px; font-weight: 600; color: rgba(255, 255, 255, 0.9); margin-bottom: 2px;">{{ __('Active Users (Real-time)') }}</div>
                                    <div style="font-size: 26px; font-weight: 800; color: #ffffff; line-height: 1;" id="active-users-count">{{ $metrics['active_users'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Web Users -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card metric-card mb-0" style="background: #fff; border-radius: 8px; padding: 20px; height: 100%;">
                            <div class="d-flex align-items-center">
                                <div style="width: 48px; height: 48px; background-color: #007bff; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; flex-shrink: 0; margin-right: 16px;">
                                    <i class="fas fa-globe"></i>
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 2px;">{{ __('Web Users') }}</div>
                                    <div style="font-size: 26px; font-weight: 700; color: #0f172a; line-height: 1;" id="web-users-count">{{ $metrics['web_users'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Users -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card metric-card mb-0" style="background: #fff; border-radius: 8px; padding: 20px; height: 100%;">
                            <div class="d-flex align-items-center">
                                <div style="width: 48px; height: 48px; background-color: #6f42c1; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; flex-shrink: 0; margin-right: 16px;">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div style="text-align: left;">
                                    <div style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 2px;">{{ __('Mobile Users') }}</div>
                                    <div style="font-size: 26px; font-weight: 700; color: #0f172a; line-height: 1;" id="mobile-users-count">{{ $metrics['mobile_users'] ?? 0 }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Real-time Page Activity Table Card -->
                <div class="row">
                    <div class="col-12">
                        <div class="card metric-card">
                            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                                <h5 class="m-0 font-weight-bold" style="color: #334155;">
                                    <i class="fas fa-wifi text-info mr-2"></i> {{ __('Real-time Page Activity') }}
                                </h5>
                                <span class="pulse-badge">
                                    <span class="pulse-dot"></span> {{ __('LIVE') }}
                                </span>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped mb-0 align-middle">
                                        <thead style="background-color: #f8fafc; color: #475569;">
                                            <tr>
                                                <th class="py-3 px-4">{{ __('Page Title') }}</th>
                                                <th class="py-3 px-4">{{ __('Path') }}</th>
                                                <th class="py-3 px-4 text-right">{{ __('Active Users') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="realtime-pages-body">
                                            @forelse($metrics['pages'] as $page)
                                                <tr>
                                                    <td class="px-4 font-weight-bold" style="color: #1e293b;">{{ $page['title'] }}</td>
                                                    <td class="px-4 text-muted">{{ $page['path'] }}</td>
                                                    <td class="px-4 text-right">
                                                        <span class="badge badge-primary px-3 py-2" style="font-size: 13px; border-radius: 12px;">
                                                            {{ $page['active_users'] }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center py-4 text-muted">
                                                        {{ __('No active user page activity right now.') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function fetchRealtimeData() {
        $.ajax({
            url: "{{ route('admin.dashboard.realtime') }}",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('#active-users-count').text(data.active_users);
                $('#web-users-count').text(data.web_users);
                $('#mobile-users-count').text(data.mobile_users);

                let rowsHtml = '';
                if (data.pages && data.pages.length > 0) {
                    $.each(data.pages, function (index, page) {
                        rowsHtml += `
                            <tr>
                                <td class="px-4 font-weight-bold" style="color: #1e293b;">${page.title}</td>
                                <td class="px-4 text-muted">${page.path}</td>
                                <td class="px-4 text-right">
                                    <span class="badge badge-primary px-3 py-2" style="font-size: 13px; border-radius: 12px;">
                                        ${page.active_users}
                                    </span>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    rowsHtml = `
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">
                                {{ __('No active user page activity right now.') }}
                            </td>
                        </tr>
                    `;
                }

                $('#realtime-pages-body').html(rowsHtml);
            },
            error: function (xhr, status, error) {
                console.error("Realtime data fetch error:", error);
            }
        });
    }

    // Auto-refresh metrics every 5 seconds
    setInterval(fetchRealtimeData, 5000);
</script>
@endsection
