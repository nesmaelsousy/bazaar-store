@extends('dashboard.app')

@section('content')

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake"
         src="{{ asset('backend/image/Brown_Minimalist_Handmade_Knits_Logo__2_-removebg-preview.png') }}"
         alt="Logo" height="200" width="200">
</div>

<div class="content-wrapper" style="background:#F4F6FA; min-height:100vh;">

    <!-- Page Header -->
    <div class="content-header py-3 px-4" style="background:#fff; border-bottom:1px solid #E5E7EB;">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0 fw-bold" style="color:#111827; font-size:20px;">Dashboard Overview</h4>
                <small style="color:#6B7280;">Welcome back! Here's what's happening today.</small>
            </div>
            <ol class="breadcrumb mb-0" style="background:transparent;">
                <li class="breadcrumb-item"><a href="#" style="color:#FF6A00; text-decoration:none;">Home</a></li>
                <li class="breadcrumb-item active" style="color:#6B7280;">Dashboard</li>
            </ol>
        </div>
    </div>

    <section class="content py-4 px-4">

        <!-- ── Row 1: 4 top metric cards ── -->
        <div class="row g-3 mb-3">
            <!-- Total Orders -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div style="width:42px;height:42px;border-radius:10px;background:#FFF7ED;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-shopping-cart" style="color:#F97316;font-size:18px;"></i>
                            </div>
                            <span class="badge" style="background:#DCFCE7;color:#166534;font-size:11px;padding:4px 10px;border-radius:20px;">↑ 12%</span>
                        </div>
                        <div style="font-size:12px;color:#6B7280;margin-bottom:2px;">Total Orders</div>
                        <div style="font-size:26px;font-weight:700;color:#111827;line-height:1.2;">48,320</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-top:2px;">This month</div>
                    </div>
                </div>
            </div>

            <!-- Total Sales -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div style="width:42px;height:42px;border-radius:10px;background:#FEF2F2;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-dollar-sign" style="color:#EF4444;font-size:18px;"></i>
                            </div>
                            <span class="badge" style="background:#DCFCE7;color:#166534;font-size:11px;padding:4px 10px;border-radius:20px;">↑ 18%</span>
                        </div>
                        <div style="font-size:12px;color:#6B7280;margin-bottom:2px;">Total Sales</div>
                        <div style="font-size:26px;font-weight:700;color:#111827;line-height:1.2;">${{ number_format($totalProduct , 2) }}</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-top:2px;">This month</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── Row 2: 3 metric cards ── -->
        <div class="row g-3 mb-3">

            <!-- Total craftsmens -->
            <div class="col-xl-4 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div style="width:42px;height:42px;border-radius:10px;background:#F5F3FF;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-users" style="color:#8B5CF6;font-size:18px;"></i>
                            </div>
                           
                        </div>
                        <div style="font-size:12px;color:#6B7280;margin-bottom:2px;">Total craftsmens</div>
                        <div style="font-size:26px;font-weight:700;color:#111827;line-height:1.2;">{{ number_format($totalCraftsmen) }}</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-top:2px;">Registered craftsmens</div>
                    </div>
                </div>
            </div>

            <!-- Total Clients -->
            <div class="col-xl-4 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                           <div style="width:42px;height:42px;border-radius:10px;background:#F5F3FF;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-users" style="color:#cb9b43;font-size:18px;"></i>
                            </div>
                            <span class="badge" style="background:#DCFCE7;color:#166534;font-size:11px;padding:4px 10px;border-radius:20px;">↑ 22%</span>
                        </div>
                        <div style="font-size:12px;color:#6B7280;margin-bottom:2px;">Total Clients</div>
                        <div style="font-size:26px;font-weight:700;color:#111827;line-height:1.2;">{{ number_format($totalClient) }}</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-top:2px;">Registered clients</div>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="col-xl-4 col-md-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div style="width:42px;height:42px;border-radius:10px;background:#FDF2F8;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-percentage" style="color:#EC4899;font-size:18px;"></i>
                            </div>
                            <span class="badge" style="background:#FEE2E2;color:#991B1B;font-size:11px;padding:4px 10px;border-radius:20px;">↓ 2%</span>
                        </div>
                        <div style="font-size:12px;color:#6B7280;margin-bottom:2px;">Total Products</div>
                        <div style="font-size:26px;font-weight:700;color:#111827;line-height:1.2;">{{ number_format($totalProduct) }}</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-top:2px;">Collected this month</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── Row 3: Charts ── -->
        <div class="row g-3 mb-3">

            <!-- Sales & Subscriptions Line Chart -->
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                                <div style="font-size:14px;font-weight:600;color:#111827;">Monthly Sales & Subscriptions</div>
                                <div style="font-size:11px;color:#9CA3AF;">Last 7 months — in USD</div>
                            </div>
                            <div class="d-flex gap-3" style="font-size:11px;color:#6B7280;">
                                <span><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#3B82F6;margin-right:4px;"></span>Sales</span>
                                <span><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#10B981;margin-right:4px;border:2px dashed #10B981;background:transparent;"></span>Subscriptions</span>
                            </div>
                        </div>
                        <div style="position:relative;width:100%;height:220px;">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscription Plans Donut -->
            <div class="col-xl-4">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div style="font-size:14px;font-weight:600;color:#111827;margin-bottom:2px;">Plan Distribution</div>
                      
                        <div class="d-flex flex-wrap gap-2 mb-3" style="font-size:11px;color:#6B7280;">
                            <span><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#8B5CF6;margin-right:3px;"></span>Free 34%</span>
                            <span><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#3B82F6;margin-right:3px;"></span>Basic 28%</span>
                            <span><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#10B981;margin-right:3px;"></span>Pro 22%</span>
                            <span><span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:#F97316;margin-right:3px;"></span>Advanced 16%</span>
                        </div>
                        <div style="position:relative;width:100%;height:180px;">
                            <canvas id="donutChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── Row 4: Bar chart + Plan Revenue ── -->
        <div class="row g-3 mb-3">

            <!-- Sales Commission Bar Chart -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div style="font-size:14px;font-weight:600;color:#111827;margin-bottom:2px;">Monthly Total Products</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-bottom:12px;">Collected commissions — in USD</div>
                        <div style="position:relative;width:100%;height:200px;">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Plan Revenue Breakdown -->
            <div class="col-xl-6">
                <div class="card border-0 shadow-sm h-100" style="border-radius:14px;">
                    <div class="card-body p-3">
                        <div style="font-size:14px;font-weight:600;color:#111827;margin-bottom:2px;">Revenue by Plan</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-bottom:16px;">Each plan's contribution to total revenue</div>

                        <div class="d-flex flex-column gap-3">
                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="font-size:13px;font-weight:500;color:#111827;">Advanced</span>
                                    <span style="font-size:12px;color:#6B7280;">$18,400 · 54%</span>
                                </div>
                                <div style="background:#F3F4F6;border-radius:6px;height:7px;overflow:hidden;">
                                    <div style="width:54%;height:100%;background:#F97316;border-radius:6px;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="font-size:13px;font-weight:500;color:#111827;">Professional</span>
                                    <span style="font-size:12px;color:#6B7280;">$9,600 · 28%</span>
                                </div>
                                <div style="background:#F3F4F6;border-radius:6px;height:7px;overflow:hidden;">
                                    <div style="width:28%;height:100%;background:#10B981;border-radius:6px;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="font-size:13px;font-weight:500;color:#111827;">Basic</span>
                                    <span style="font-size:12px;color:#6B7280;">$6,200 · 18%</span>
                                </div>
                                <div style="background:#F3F4F6;border-radius:6px;height:7px;overflow:hidden;">
                                    <div style="width:18%;height:100%;background:#3B82F6;border-radius:6px;"></div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="font-size:13px;font-weight:500;color:#111827;">Free</span>
                                    <span style="font-size:12px;color:#6B7280;">$0 · 0%</span>
                                </div>
                                <div style="background:#F3F4F6;border-radius:6px;height:7px;overflow:hidden;">
                                    <div style="width:1%;height:100%;background:#8B5CF6;border-radius:6px;"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- ── Row 5: Latest Orders ── -->
        <div class="row g-3">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius:14px;">
                    <div class="card-body p-3">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div style="font-size:14px;font-weight:600;color:#111827;">Latest Orders</div>
                                
                            </div>
                            <a href="#" style="font-size:12px;color:#3B82F6;text-decoration:none;">View all →</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" style="font-size:13px;">
                                <thead>
                                    <tr style="border-bottom:1px solid #F3F4F6;">
                                        <th style="font-weight:500;color:#6B7280;font-size:11px;text-transform:uppercase;letter-spacing:.04em;border:none;padding:8px 12px;">Order #</th>
                                        
                                        <th style="font-weight:500;color:#6B7280;font-size:11px;text-transform:uppercase;letter-spacing:.04em;border:none;padding:8px 12px;">craftsmen</th>
                                        <th style="font-weight:500;color:#6B7280;font-size:11px;text-transform:uppercase;letter-spacing:.04em;border:none;padding:8px 12px;">Amount</th>
                                        <th style="font-weight:500;color:#6B7280;font-size:11px;text-transform:uppercase;letter-spacing:.04em;border:none;padding:8px 12px;">Date</th>
                                        <th style="font-weight:500;color:#6B7280;font-size:11px;text-transform:uppercase;letter-spacing:.04em;border:none;padding:8px 12px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding:10px 12px;color:#111827;font-weight:500;">#ORD-8841</td>
                                        <td style="padding:10px 12px;color:#374151;">Sarah Johnson</td>
                                        <td style="padding:10px 12px;color:#111827;font-weight:600;">$124.00</td>
                                        <td style="padding:10px 12px;color:#6B7280;">May 30, 2026</td>
                                        <td style="padding:10px 12px;"><span style="background:#DCFCE7;color:#166534;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px;">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 12px;color:#111827;font-weight:500;">#ORD-8840</td>
                                        <td style="padding:10px 12px;color:#374151;">Code House</td>
                                        <td style="padding:10px 12px;color:#374151;">Michael Lee</td>
                                        <td style="padding:10px 12px;color:#111827;font-weight:600;">$89.50</td>
                                        <td style="padding:10px 12px;color:#6B7280;">May 30, 2026</td>
                                        <td style="padding:10px 12px;"><span style="background:#FEF3C7;color:#92400E;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px;">Processing</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 12px;color:#111827;font-weight:500;">#ORD-8839</td>
                                        <td style="padding:10px 12px;color:#374151;">Beauty Glow</td>
                                        <td style="padding:10px 12px;color:#374151;">Emma Williams</td>
                                        <td style="padding:10px 12px;color:#111827;font-weight:600;">$210.00</td>
                                        <td style="padding:10px 12px;color:#6B7280;">May 29, 2026</td>
                                        <td style="padding:10px 12px;"><span style="background:#DCFCE7;color:#166534;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px;">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 12px;color:#111827;font-weight:500;">#ORD-8838</td>
                                        <td style="padding:10px 12px;color:#374151;">Golden Watches</td>
                                        <td style="padding:10px 12px;color:#374151;">James Carter</td>
                                        <td style="padding:10px 12px;color:#111827;font-weight:600;">$560.00</td>
                                        <td style="padding:10px 12px;color:#6B7280;">May 29, 2026</td>
                                        <td style="padding:10px 12px;"><span style="background:#FEE2E2;color:#991B1B;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px;">Cancelled</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 12px;color:#111827;font-weight:500;">#ORD-8837</td>
                                        <td style="padding:10px 12px;color:#374151;">Tech Tomorrow</td>
                                        <td style="padding:10px 12px;color:#374151;">Olivia Smith</td>
                                        <td style="padding:10px 12px;color:#111827;font-weight:600;">$78.00</td>
                                        <td style="padding:10px 12px;color:#6B7280;">May 28, 2026</td>
                                        <td style="padding:10px 12px;"><span style="background:#DCFCE7;color:#166634;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px;">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 12px;color:#111827;font-weight:500;">#ORD-8836</td>
                                        <td style="padding:10px 12px;color:#374151;">Fresh Foods</td>
                                        <td style="padding:10px 12px;color:#374151;">Liam Brown</td>
                                        <td style="padding:10px 12px;color:#111827;font-weight:600;">$44.75</td>
                                        <td style="padding:10px 12px;color:#6B7280;">May 28, 2026</td>
                                        <td style="padding:10px 12px;"><span style="background:#FEF3C7;color:#92400E;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px;">Processing</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:10px 12px;color:#111827;font-weight:500;">#ORD-8835</td>
                                        <td style="padding:10px 12px;color:#374151;">Bloom Flowers</td>
                                        <td style="padding:10px 12px;color:#374151;">Sophia Davis</td>
                                        <td style="padding:10px 12px;color:#111827;font-weight:600;">$95.00</td>
                                        <td style="padding:10px 12px;color:#6B7280;">May 27, 2026</td>
                                        <td style="padding:10px 12px;"><span style="background:#DCFCE7;color:#166534;font-size:11px;font-weight:500;padding:3px 10px;border-radius:20px;">Completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const months = ['Nov', 'Dec', 'Jan', 'Feb', 'Mar', 'Apr', 'May'];

    // Line Chart — Sales & Subscriptions
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Sales',
                    data: [148000, 162000, 175000, 190000, 205000, 197000, 218450],
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59,130,246,0.08)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointBackgroundColor: '#3B82F6',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Subscriptions',
                    data: [21000, 24500, 27000, 29000, 31500, 33000, 34200],
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16,185,129,0.07)',
                    borderWidth: 2,
                    borderDash: [5, 4],
                    pointRadius: 4,
                    pointBackgroundColor: '#10B981',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: '#9CA3AF', font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.05)' } },
                y: {
                    ticks: {
                        color: '#9CA3AF', font: { size: 10 },
                        callback: v => '$' + Math.round(v / 1000) + 'k'
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                }
            }
        }
    });

    // Donut Chart — Plan Distribution
    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Free', 'Basic', 'Pro', 'Advanced'],
            datasets: [{
                data: [34, 28, 22, 16],
                backgroundColor: ['#8B5CF6', '#3B82F6', '#10B981', '#F97316'],
                borderWidth: 3,
                borderColor: '#fff',
                hoverOffset: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: { legend: { display: false } }
        }
    });

    // Bar Chart — Total Products
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Commission',
                data: [7200, 8100, 8900, 9400, 10100, 10600, 10922],
                backgroundColor: '#EC4899',
                borderRadius: 6,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { ticks: { color: '#9CA3AF', font: { size: 11 } }, grid: { display: false } },
                y: {
                    ticks: {
                        color: '#9CA3AF', font: { size: 10 },
                        callback: v => '$' + Math.round(v / 1000) + 'k'
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                }
            }
        }
    });

});
</script>

@endsection