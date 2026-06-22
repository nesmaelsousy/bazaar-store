@extends('dashboard.app')

@section('content')
    <div class="content-wrapper" style="background:#F4F6FA; min-height:100vh;">

        <!-- Page Header -->
        <div class="content-header py-3 px-4" style="background:#fff; border-bottom:1px solid #E5E7EB;">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0 fw-bold" style="color:#111827; font-size:20px;">Dashboard</h4>
                    <small style="color:#6B7280;">{{ now()->format('l, F j, Y') }}</small>
                </div>
                <ol class="breadcrumb mb-0" style="background:transparent;">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                            style="color:#FF6A00; text-decoration:none;">Home</a></li>
                    <li class="breadcrumb-item active" style="color:#6B7280;">Dashboard</li>
                </ol>
            </div>
        </div>

        <section class="content py-4 px-4">

            <!-- ── Row 1: 4 Key Metrics ── -->
            <div class="row g-3 mb-4">

                <!-- Total Products -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius:12px; border-left:4px solid #835837;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div style="font-size:13px; color:#6B7280; margin-bottom:8px;">Total Products</div>
                                    <div style="font-size:28px; font-weight:700; color:#111827;">
                                        {{ number_format($totalProduct) }}</div>
                                </div>
                                <div
                                    style="width:50px; height:50px; border-radius:10px; background:#F0F9FF; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-box" style="color:#3B82F6; font-size:22px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Sales -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius:12px; border-left:4px solid #10B981;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div style="font-size:13px; color:#6B7280; margin-bottom:8px;">Total Sales</div>
                                    <div style="font-size:28px; font-weight:700; color:#111827;">
                                        ${{ number_format($totalSales, 2) }}</div>
                                </div>
                                <div
                                    style="width:50px; height:50px; border-radius:10px; background:#F0FDF4; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-dollar-sign" style="color:#10B981; font-size:22px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Craftsmen -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius:12px; border-left:4px solid #8B5CF6;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div style="font-size:13px; color:#6B7280; margin-bottom:8px;">Total Craftsmen</div>
                                    <div style="font-size:28px; font-weight:700; color:#111827;">
                                        {{ number_format($totalCraftsmen) }}</div>
                                </div>
                                <div
                                    style="width:50px; height:50px; border-radius:10px; background:#FAF5FF; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-hammer" style="color:#8B5CF6; font-size:22px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Clients -->
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius:12px; border-left:4px solid #F97316;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div style="font-size:13px; color:#6B7280; margin-bottom:8px;">Total Clients</div>
                                    <div style="font-size:28px; font-weight:700; color:#111827;">
                                        {{ number_format($totalClient) }}</div>
                                </div>
                                <div
                                    style="width:50px; height:50px; border-radius:10px; background:#FFF7ED; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-users" style="color:#F97316; font-size:22px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card border-0 shadow-sm" style="border-radius:12px; border-left:4px solid #EF4444;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div style="font-size:13px; color:#6B7280; margin-bottom:8px;">Pending Orders</div>
                                    <div style="font-size:28px; font-weight:700; color:#111827;">
                                        {{ $pendingOrders ?? 0 }}
                                    </div>
                                </div>
                                <div
                                    style="width:50px; height:50px; border-radius:10px; background:#FEF2F2; display:flex; align-items:center; justify-content:center;">
                                    <i class="fas fa-clock" style="color:#EF4444; font-size:22px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase fw-semibold small tracking-wide">
                                <i class="fas fa-chart-line me-1 text-primary"></i> This Month Sales
                            </span>
                            <h3 class="fw-bold mt-1 mb-0">${{ number_format($totalSalesMonth, 2) }}</h3>
                        </div>
                        <div class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                            <i class="fas fa-arrow-up me-1"></i> {{ $growth }}
                        </div>
                    </div>
                    <div class="mt-3 pt-1">
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: {{ $salesProgress }}%; role="progressbar"></div>
                        </div>
                        <small class="text-muted">{{ number_format($salesProgress, 1) }}% of monthly target ($1.2M)</small>
                    </div>
                </div>
            </div>

            <!-- ── Row 2: Quick Actions ── -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm" style="border-radius:12px;">
                        <div class="card-body p-4">
                            <div style="font-size:14px; font-weight:600; color:#111827; margin-bottom:16px;">Quick Actions
                            </div>
                            <div class="row g-2">
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.product.create') }}" class="btn btn-outline-primary w-100"
                                        style="border-radius:8px; font-size:13px;">
                                        <i class="fas fa-plus me-2"></i> Add Product
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success w-100"
                                        style="border-radius:8px; font-size:13px;">
                                        <i class="fas fa-user-plus me-2"></i> Add Craftsman
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.order.index') }}" class="btn btn-outline-info w-100"
                                        style="border-radius:8px; font-size:13px;">
                                        <i class="fas fa-eye me-2"></i> View Orders
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Row 3: Latest Orders ── -->
            <div class="row g-3">
                <div class="col-12">
                    <div class="card border-0 shadow-sm" style="border-radius:12px;">
                        <div class="card-body p-4">

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <div style="font-size:14px; font-weight:600; color:#111827;">Latest Orders</div>
                                    <small style="color:#6B7280;">Recent transactions</small>
                                </div>
                                <a href="{{ route('admin.order.index') }}"
                                    style="font-size:12px; color:#835837; text-decoration:none;">View all
                                    →</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" style="font-size:13px;">
                                    <thead>

                                        <tr style="border-bottom:2px solid #E5E7EB; background:#F9FAFB;">
                                            <th
                                                style="font-weight:600; color:#374151; font-size:12px; padding:12px; text-transform:uppercase; letter-spacing:.05em;">
                                                Order ID</th>
                                            <th
                                                style="font-weight:600; color:#374151; font-size:12px; padding:12px; text-transform:uppercase; letter-spacing:.05em;">
                                                Craftsman</th>
                                            <th
                                                style="font-weight:600; color:#374151; font-size:12px; padding:12px; text-transform:uppercase; letter-spacing:.05em;">
                                                Amount</th>
                                            <th
                                                style="font-weight:600; color:#374151; font-size:12px; padding:12px; text-transform:uppercase; letter-spacing:.05em;">
                                                Date</th>
                                            <th
                                                style="font-weight:600; color:#374151; font-size:12px; padding:12px; text-transform:uppercase; letter-spacing:.05em;">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentOrders as $recentOrder)
                                            <tr style="border-bottom:1px solid #E5E7EB;">
                                                <td style="padding:12px; color:#111827; font-weight:500;">
                                                    #{{ $recentOrder->number }}</td>
                                                <td style="padding:12px; color:#374151;">
                                                    {{ $recentOrder->address->fullname }}</td>
                                                <td style="padding:12px; color:#111827; font-weight:600;">
                                                    ${{ $recentOrder->total }}</td>
                                                <td style="padding:12px; color:#6B7280;">{{ $recentOrder->created_at }}
                                                </td>
                                                <td style="padding:12px;">
                                                    <span
                                                        style="background:#DCFCE7; color:#166534; font-size:11px; font-weight:500; padding:4px 12px; border-radius:20px;">{{ $recentOrder->status }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%" class="text-center py-10 ">
                                                    <div class="flex flex-col items-center justify-center gap-2"
                                                        style=" color:#374151;">
                                                        <i class="fas fa-box-open text-3xl text-gray-300"></i>
                                                        <p class="text-lg font-semibold">No orders yet</p>
                                                        <p class="text-sm text-gray-400">There are no orders available at
                                                            the moment</p>
                                                    </div>
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

        </section>

    </div>
@endsection
