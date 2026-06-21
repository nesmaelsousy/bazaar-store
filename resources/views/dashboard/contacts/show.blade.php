@extends('dashboard.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            <div class="container">

                {{-- Back Button --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-brown btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Back to Messages
                        </a>
                    </div>
                </div>

                {{-- Message Details Card --}}
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-brown shadow-sm rounded-3">
                            <div class="card-header bg-brown-cream border-bottom border-brown-lightest py-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="fw-bold text-brown-dark mb-0">

                                        Message Details
                                    </h4>
                                    <span class="badge bg-brown-light text-brown-dark px-3 py-2 rounded-pill">
                                        #{{ $message->id }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body p-4">

                                {{-- Sender Info --}}
                                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom border-brown-lightest">
                                    <div class="sender-avatar-lg">
                                        {{ Str::substr($message->fullname, 0, 2) }}
                                    </div>
                                    <div class=" ml-3">
                                        <h5 class="fw-bold text-brown-dark mb-1">{{ $message->fullname }}</h5>
                                        <p class="text-brown-medium mb-0">

                                            {{ $message->email }}
                                        </p>
                                    </div>
                                </div>

                                {{-- Date & Time --}}
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 text-brown-medium">
                                            <i class="far fa-calendar"></i>
                                            <span class="small ml-2">Received:
                                                {{ $message->created_at->format('F d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center gap-2 text-brown-medium">
                                            <i class="far fa-clock"></i>
                                            <span class="small ml-2">Time:
                                                {{ $message->created_at->format('h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Message Content --}}
                                <div class="mb-4">
                                    <label class="fw-semibold text-brown-dark mb-2">Message</label>
                                    <div class="p-4 bg-brown-cream rounded-3 border border-brown-lightest">
                                        <p class="text-brown-dark mb-0" style="line-height: 1.8; white-space: pre-wrap;">
                                            {{ $message->message }}
                                        </p>
                                    </div>
                                </div>
                                <form action="{{ route('admin.contact.replay',$message->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3 form-group">
                                        <label for="reply">Reply</label>
                                        <textarea name="reply" id="reply" class="form-control" cols="20" rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-brown px-3 "><i class="fas fa-paper-plane mr-2"></i>
                                        Reply to Sender</button>
                                         <a href="{{ route('admin.contact.index') }}"
                                        class="btn btn-outline-brown flex-grow-1 py-2">
                                        <i class="far fa-circle-left me-1"></i>
                                        Close
                                    </a>
                                </form>            
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    <style>
        /* ===== Brown Theme Colors ===== */
        :root {
            --brown-dark: #5C3D2E;
            --brown-medium: #8B6B4A;
            --brown-light: #A67B5B;
            --brown-beige: #C4A88C;
            --brown-lightest: #E8DCD2;
            --brown-cream: #F0E8E0;
            --brown-hover: #FBF7F4;
        }

        /* ===== Text Colors ===== */
        .text-brown-dark {
            color: var(--brown-dark);
        }

        .text-brown-medium {
            color: var(--brown-medium);
        }

        .text-brown-light {
            color: var(--brown-light);
        }

        /* ===== Background Colors ===== */
        .bg-brown-cream {
            background: var(--brown-cream);
        }

        .bg-brown-light {
            background: var(--brown-lightest);
        }

        .bg-brown-hover {
            background: var(--brown-hover);
        }

        /* ===== Border Colors ===== */
        .border-brown {
            border-color: var(--brown-lightest) !important;
        }

        .border-brown-lightest {
            border-color: var(--brown-lightest);
        }

        .border-brown:focus {
            border-color: var(--brown-dark);
        }

        /* ===== Card ===== */
        .card {
            border-radius: 16px !important;
            border: 1px solid var(--brown-lightest);
        }

        .card-header {
            border-radius: 16px 16px 0 0 !important;
        }

        /* ===== Buttons ===== */
        .btn-brown {
            background: var(--brown-dark);
            color: #ffffff;
            border: 1px solid var(--brown-dark);
            transition: all 0.3s ease;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-brown:hover {
            background: #4A3226;
            border-color: #4A3226;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(92, 61, 46, 0.2);
        }

        .btn-outline-brown {
            background: transparent;
            color: var(--brown-dark);
            border: 1px solid var(--brown-lightest);
            transition: all 0.3s ease;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-outline-brown:hover {
            background: var(--brown-hover);
            border-color: var(--brown-beige);
            color: var(--brown-dark);
            transform: translateY(-2px);
        }

        .btn-outline-secondary {
            border-radius: 12px;
            border-color: #DCCFC4;
            color: var(--brown-medium);
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: var(--brown-cream);
            border-color: var(--brown-beige);
            color: var(--brown-dark);
        }

        /* ===== Avatar ===== */
        .sender-avatar-lg {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: var(--brown-lightest);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--brown-dark);
            flex-shrink: 0;
        }

        /* ===== Form Controls ===== */
        .form-control {
            border-radius: 12px;
            border: 1px solid var(--brown-lightest);
            padding: 0.625rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--brown-dark);
            box-shadow: 0 0 0 0.2rem rgba(92, 61, 46, 0.15);
        }

        .form-control::placeholder {
            color: #B8A69C;
            font-size: 0.9rem;
        }

        /* ===== Modal ===== */
        .modal-content {
            border-radius: 16px !important;
            border: 1px solid var(--brown-lightest);
        }

        .modal-header {
            padding: 1.25rem 1.5rem 0.5rem 1.5rem;
        }

        .modal-body {
            padding: 1rem 1.5rem 1.5rem 1.5rem;
        }

        /* ===== Responsive ===== */
        @media (max-width: 576px) {
            .sender-avatar-lg {
                width: 44px;
                height: 44px;
                font-size: 1rem;
            }

            .modal-body .d-flex {
                flex-direction: column;
            }

            .modal-body .d-flex .btn {
                width: 100%;
            }

            .modal-body .d-flex .btn:first-child {
                margin-bottom: 0.5rem;
            }

            .card-body .d-flex {
                flex-direction: column;
            }

            .card-body .d-flex .btn {
                width: 100%;
            }

            .card-body .d-flex .btn:first-child {
                margin-bottom: 0.5rem;
            }
        }
    </style>

    {{-- Scripts --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Open Reply Modal
                window.openReplyModal = function(name) {
                    document.getElementById('replyToName').textContent = name;
                    const modal = new bootstrap.Modal(document.getElementById('replyModal'));
                    modal.show();
                };

                // Handle Reply Form
                document.getElementById('replyForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const message = document.getElementById('replyMessage');
                    if (message.value.trim()) {
                        // Your reply logic here
                        alert('Reply sent successfully to ' + document.getElementById('replyToName')
                            .textContent + '!');
                        const modal = bootstrap.Modal.getInstance(document.getElementById('replyModal'));
                        if (modal) modal.hide();
                        message.value = '';
                    } else {
                        alert('Please enter a reply message.');
                    }
                });
            });
        </script>
    @endpush

    </div>
    </div>
    </div>
@endsection
