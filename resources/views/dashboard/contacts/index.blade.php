@extends('dashboard.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            <div class="container">

                {{-- Header --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="fw-bold text-brown-dark mb-0">
                                    <i class="far fa-envelope text-brown-medium me-2"></i>
                                    Contact Messages
                                </h2>
                                <p class="text-brown-medium small mt-1">Manage all customer inquiries</p>
                            </div>
                            <span class="badge bg-brown-light text-brown-dark px-3 py-2 rounded-pill">
                                total
                            </span>
                        </div>
                        <hr class="border-brown mt-3" style="width: 80px; opacity: 0.6;">
                    </div>
                </div>

                {{-- Stats Cards --}}
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card stat-card border-brown shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-brown-medium small fw-semibold mb-1">Total Messages</p>
                                        <h3 class="fw-bold text-brown-dark mb-0">{{ $messages->count() }}</h3>
                                    </div>
                                    <div class="stat-icon">
                                       
                                        <i class="far fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card border-brown shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-brown-medium small fw-semibold mb-1">This Week</p>
                                        <h3 class="fw-bold text-brown-dark mb-0">
                                            {{ $messages->where('created_at', '>=', now()->subDays(7))->count() }}</h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="far fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card border-brown shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-brown-medium small fw-semibold mb-1">Latest</p>
                                        <h3 class="fw-bold text-brown-dark mb-0" style="font-size: 1.2rem;">
                                            {{ $messages->first() ? $messages->first()->created_at->diffForHumans() : 'No messages' }}
                                        </h3>
                                    </div>
                                    <div class="stat-icon">
                                        <i class="far fa-clock"></i>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Messages Table --}}
                @if ($messages->count() > 0)
                    <div class="card border-brown shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-brown-lightest">
                                        <tr>
                                            <th class="text-brown-medium fw-semibold small text-uppercase py-3 px-4">Sender
                                            </th>
                                            <th class="text-brown-medium fw-semibold small text-uppercase py-3 px-4">Message
                                            </th>
                                            <th
                                                class="text-brown-medium fw-semibold small text-uppercase py-3 px-4 text-center">
                                                Date</th>
                                            <th
                                                class="text-brown-medium fw-semibold small text-uppercase py-3 px-4 text-center">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td class="py-3 px-4">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="sender-avatar">
                                                            {{ Str::substr($message->fullname, 0, 2) }}
                                                        </div>
                                                        <div class="ml-2">
                                                            <div class="fw-semibold text-brown-dark">
                                                                {{ $message->fullname }}</div>
                                                            <div class="small text-brown-medium">
                                                              
                                                                {{ $message->email }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4">
                                                    <div class="message-preview">
                                                        {{ Str::limit($message->message, 80) }}
                                                    </div>
                                                </td>
                                                <td class="py-3 px-4 text-center text-brown-medium small">
                                                    {{ $message->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="py-3 px-4 text-center">
                                                    <a href="{{ route('admin.contact.show',$message->id) }}" class="btn-action"
                                                        title="View">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if ($messages->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
                        </div>
                    @endif
                @else
                    {{-- Empty State --}}
                    <div class="card border-brown shadow-sm">
                        <div class="card-body py-5 text-center">
                            <div class="empty-icon mx-auto">
                                <i class="far fa-envelope-open"></i>
                            </div>
                            <h4 class="fw-bold text-brown-dark mt-3">No Messages Yet</h4>
                            <p class="text-brown-medium small">Customer inquiries will appear here when received</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

{{-- Custom CSS for Brown Theme --}}
<style>
    /* ===== Colors ===== */
    :root {
        --brown-dark: #5C3D2E;
        --brown-medium: #8B6B4A;
        --brown-light: #A67B5B;
        --brown-beige: #C4A88C;
        --brown-lightest: #E8DCD2;
        --brown-cream: #F0E8E0;
        --brown-hover: #FBF7F4;
    }

    .text-brown-dark {
        color: var(--brown-dark);
    }

    .text-brown-medium {
        color: var(--brown-medium);
    }

    .text-brown-light {
        color: var(--brown-light);
    }

    .bg-brown-lightest {
        background: var(--brown-lightest);
    }

    .bg-brown-cream {
        background: var(--brown-cream);
    }

    .border-brown {
        border-color: var(--brown-lightest);
    }

    /* ===== Stats Cards ===== */
    .stat-card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(92, 61, 46, 0.08) !important;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background: var(--brown-cream);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brown-medium);
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    /* ===== Sender Avatar ===== */
    .sender-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--brown-lightest);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
        color: var(--brown-dark);
        flex-shrink: 0;
    }

    /* ===== Message Preview ===== */
    .message-preview {
        color: #6B4F3A;
        font-size: 0.875rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
    }

    /* ===== Action Button ===== */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        background: var(--brown-dark);
        color: #fff;
        border-radius: 8px;
        transition: all 0.2s ease;
        text-decoration: none;
        border: none;
    }

    .btn-action:hover {
        background: #4A3226;
        color: #fff;
        transform: scale(1.05);
    }

    /* ===== Empty State ===== */
    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--brown-cream);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--brown-light);
    }

    /* ===== Table Hover ===== */
    .table-hover tbody tr:hover {
        background: var(--brown-hover);
    }

    /* ===== Badge ===== */
    .bg-brown-light {
        background: var(--brown-cream);
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .sender-avatar {
            width: 34px;
            height: 34px;
            font-size: 0.75rem;
        }
    }
</style>
