<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - Livocare Labs Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Early Dark Mode Detection -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="admin-page" style="background: var(--bg-page); min-height: 100vh;">

    <!-- Top Admin Header -->
    <header class="admin-topbar">
        <div class="container admin-header-inner">
            <div class="admin-header-brand">
                <a href="{{ route('admin.dashboard') }}" class="brand-logo" style="text-decoration: none;" aria-label="LIVOCARE LABS ADMIN">
                    <img src="{{ asset('images/logo.png') }}" alt="LIVOCARE LABS" class="brand-logo-img admin-brand-logo-img">
                </a>
                <span class="badge-tag badge-primary admin-staff-badge">Staff Operations</span>
            </div>

            <div class="admin-header-controls">
                <!-- Theme Toggle Button -->
                <button class="theme-toggle-btn theme-toggle-trigger" aria-label="Toggle Dark Mode" title="Toggle Dark/Light Mode" style="border-color: rgba(255,255,255,0.2);">
                    <svg class="sun-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <svg class="moon-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>

                <a href="{{ route('home') }}" target="_blank" class="btn btn-outline btn-sm admin-view-site-btn">
                    <span class="admin-btn-icon">👁️</span> <span class="admin-btn-text">Live Site</span>
                </a>

                <div class="admin-user-pill">
                    <span class="admin-user-dot"></span>
                    <span class="admin-user-name">{{ auth()->user()->name }}</span>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-sm admin-logout-btn" title="Logout">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container admin-dashboard-wrap">

        @if(session('success'))
            <div class="admin-alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- KPI Statistic Tiles -->
        <div class="admin-kpi-grid">
            <div class="modern-card admin-kpi-card">
                <div class="admin-kpi-value" style="color: var(--text-heading);">{{ $stats['total_bookings'] }}</div>
                <div class="admin-kpi-label">Total Bookings</div>
            </div>

            <div class="modern-card admin-kpi-card">
                <div class="admin-kpi-value" style="color: #d97706;">{{ $stats['pending_pickups'] }}</div>
                <div class="admin-kpi-label">Pending Pickup</div>
            </div>

            <div class="modern-card admin-kpi-card">
                <div class="admin-kpi-value" style="color: #7c3aed;">{{ $stats['in_lab'] }}</div>
                <div class="admin-kpi-label">In Lab Testing</div>
            </div>

            <div class="modern-card admin-kpi-card">
                <div class="admin-kpi-value" style="color: #16a34a;">{{ $stats['reports_ready'] }}</div>
                <div class="admin-kpi-label">Reports Ready</div>
            </div>

            <div class="modern-card admin-kpi-card">
                <div class="admin-kpi-value" style="color: #0284c7;">{{ $stats['prescriptions_count'] }}</div>
                <div class="admin-kpi-label">Prescriptions</div>
            </div>

            <div class="modern-card admin-kpi-card">
                <div class="admin-kpi-value" style="color: #059669;">₹{{ number_format($stats['total_revenue']) }}</div>
                <div class="admin-kpi-label">Completed Rev</div>
            </div>
        </div>

        <!-- Bookings Management Section -->
        <div class="modern-card admin-main-card">
            <div class="admin-section-header">
                <div>
                    <h2 class="admin-section-title">Patient Sample Bookings (Guwahati)</h2>
                    <p class="admin-section-sub">Manage home collections, assign phlebotomists, and upload verified PDF reports.</p>
                </div>

                <!-- Status Filter Pills -->
                <div class="admin-filter-scroll">
                    <a href="{{ route('admin.dashboard', ['status' => 'all']) }}" class="badge-tag {{ (!$statusFilter || $statusFilter === 'all') ? 'badge-primary' : 'badge-navy' }}">All</a>
                    <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" class="badge-tag {{ $statusFilter === 'pending' ? 'badge-primary' : 'badge-navy' }}">Pending</a>
                    <a href="{{ route('admin.dashboard', ['status' => 'sample_collected']) }}" class="badge-tag {{ $statusFilter === 'sample_collected' ? 'badge-primary' : 'badge-navy' }}">Collected</a>
                    <a href="{{ route('admin.dashboard', ['status' => 'in_analysis']) }}" class="badge-tag {{ $statusFilter === 'in_analysis' ? 'badge-primary' : 'badge-navy' }}">In Analysis</a>
                    <a href="{{ route('admin.dashboard', ['status' => 'report_ready']) }}" class="badge-tag {{ $statusFilter === 'report_ready' ? 'badge-primary' : 'badge-navy' }}">Report Ready</a>
                </div>
            </div>

            @if($bookings->isEmpty())
                <div style="text-align: center; padding: 40px; color: var(--text-muted);">
                    No bookings found under this filter.
                </div>
            @else
                <div class="admin-table-scroll-hint">
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                    <span>Swipe table horizontally to view all columns & update status</span>
                </div>

                <div class="table-responsive admin-table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Patient</th>
                                <th>Phone / Location</th>
                                <th>Package / Tests</th>
                                <th>Schedule</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $b)
                                <tr>
                                    <td>
                                        <strong style="color: var(--primary);">#{{ $b->booking_code }}</strong>
                                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $b->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        <strong>{{ $b->patient_name }}</strong>
                                        <div style="font-size: 0.8rem; color: var(--text-muted);">
                                            {{ $b->patient_age }}y • {{ $b->patient_gender }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $b->patient_phone }}" style="color: var(--text-heading); font-weight: 600;">{{ $b->patient_phone }}</a>
                                        <div class="admin-table-address" title="{{ $b->address }}">
                                            {{ $b->address }}
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $b->package_name }}</strong>
                                        <div style="font-size: 0.85rem; color: #16a34a; font-weight: 700;">
                                            ₹{{ number_format($b->total_amount) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>{{ $b->preferred_date->format('d M, Y') }}</div>
                                        <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $b->time_slot }}</div>
                                    </td>
                                    <td>
                                        <span class="admin-badge status-{{ $b->status }}">
                                            {{ str_replace('_', ' ', $b->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="admin-table-actions">
                                            <!-- Update Status Dropdown Form -->
                                            <form action="{{ route('admin.booking.status', $b->id) }}" method="POST" style="margin: 0;">
                                                @csrf
                                                <select name="status" onchange="this.form.submit()" class="form-control admin-status-select">
                                                    <option value="pending" {{ $b->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="confirmed" {{ $b->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                    <option value="phlebotomist_assigned" {{ $b->status === 'phlebotomist_assigned' ? 'selected' : '' }}>Phlebo Assigned</option>
                                                    <option value="sample_collected" {{ $b->status === 'sample_collected' ? 'selected' : '' }}>Sample Collected</option>
                                                    <option value="in_analysis" {{ $b->status === 'in_analysis' ? 'selected' : '' }}>In Analysis</option>
                                                    <option value="report_ready" {{ $b->status === 'report_ready' ? 'selected' : '' }}>Report Ready</option>
                                                    <option value="completed" {{ $b->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="cancelled" {{ $b->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>

                                            <!-- Upload Report Form -->
                                            @if(!$b->report_file)
                                                <form action="{{ route('admin.booking.report', $b->id) }}" method="POST" enctype="multipart/form-data" style="margin: 0;">
                                                    @csrf
                                                    <label class="btn btn-sm btn-outline admin-action-upload-btn" title="Upload PDF Report">
                                                        📤 <span>Upload</span>
                                                        <input type="file" name="report_file" accept=".pdf,image/*" style="display: none;" onchange="this.form.submit()">
                                                    </label>
                                                </form>
                                            @else
                                                <a href="{{ asset('storage/' . $b->report_file) }}" target="_blank" class="btn btn-sm btn-outline admin-action-pdf-btn">
                                                    👁️ PDF
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="admin-pagination-wrap">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>

        <!-- Prescriptions & Inquiries Grid -->
        <div class="admin-split-tables">
            <!-- Uploaded Prescriptions -->
            <div class="modern-card admin-sub-card">
                <h3 class="admin-sub-card-title">Recent Uploaded Prescriptions</h3>

                @if($prescriptions->isEmpty())
                    <p style="color: var(--text-muted); font-size: 0.9rem;">No prescriptions uploaded yet.</p>
                @else
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($prescriptions as $p)
                            <div class="admin-list-item">
                                <div class="admin-list-info">
                                    <strong style="color: var(--text-heading);">{{ $p->patient_name }}</strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 2px;">
                                        📞 {{ $p->patient_phone }} • {{ $p->created_at->diffForHumans() }}
                                    </div>
                                    @if($p->notes)
                                        <div style="font-size: 0.785rem; color: var(--text-secondary); margin-top: 4px; font-style: italic;">
                                            "{{ $p->notes }}"
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ asset('storage/' . $p->file_path) }}" target="_blank" class="btn btn-outline btn-sm admin-list-action">
                                    View File
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Customer Inquiries -->
            <div class="modern-card admin-sub-card">
                <h3 class="admin-sub-card-title">General Contact Inquiries</h3>

                @if($messages->isEmpty())
                    <p style="color: var(--text-muted); font-size: 0.9rem;">No inquiry messages yet.</p>
                @else
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($messages as $m)
                            <div class="admin-list-item admin-inquiry-item">
                                <div class="admin-inquiry-header">
                                    <div>
                                        <strong style="color: var(--text-heading);">{{ $m->name }}</strong>
                                        <span style="font-size: 0.8rem; color: var(--text-muted);">({{ $m->phone }})</span>
                                    </div>
                                    <span class="badge-tag badge-navy" style="font-size: 0.7rem;">{{ $m->subject ?? 'Inquiry' }}</span>
                                </div>
                                <p class="admin-inquiry-msg">
                                    {{ $m->message }}
                                </p>
                                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 4px;">
                                    {{ $m->created_at->format('d M, Y h:i A') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
