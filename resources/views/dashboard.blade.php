@extends('layouts.template')

@section('contents')
    <div style="max-width:1100px; margin:0 auto;">
        {{-- Greeting --}}
        <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
            <div class="row g-3">
                <h2 style="font-weight:700; font-size:1.75rem; color:#1b4332; margin-bottom:1.3rem;">
                     Halo, Selamat Datang! {{ Auth::user()->name }}
                </h2>

                {{-- <div class="row g-3 mb-4"> --}}
                {{-- Today Appointments --}}
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-label">Today Appointments</div>
                        <div class="stat-value">
                            <i class="bi bi-calendar3 stat-icon"></i>
                            <span>{{ $stats['today_appointments'] }}</span>
                        </div>
                        <div class="stat-sub">Booked Today</div>
                    </div>
                </div>

                {{-- Staff Available --}}
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-label">Staff Available Today</div>
                        <div class="stat-value">
                            <i class="bi bi-people stat-icon"></i>
                            <span id="statAvailableCount">{{ $stats['staff_available'] }}</span>
                        </div>
                        <div class="stat-sub">Today</div>
                    </div>
                </div>

                {{-- Service Completed --}}
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-label">Service Completed</div>
                        <div class="stat-value">
                            <i class="bi bi-scissors stat-icon"></i>
                            <span>{{ $stats['service_completed'] }}</span>
                        </div>
                        <div class="stat-sub">This Week</div>
                    </div>
                </div>

                {{-- Customer Review --}}
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-label">Customer Review</div>
                        <div class="stat-value">
                            <i class="bi bi-star-fill stat-icon" style="color:#f9c74f;"></i>
                            <span>{{ $stats['customer_review'] }}</span>
                        </div>
                        <div class="stat-sub">This Week</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-3">

            {{-- Staff Availability --}}
            <div class="col-md-7">
                <div class="card-pixel p-3 h-100" style="background:#fff;">
                    <h5 style="font-weight:700; color:#1b4332; margin-bottom:0.5rem; font-size:1rem;">
                        Staff Availability
                    </h5>
                    <hr style="margin:0 0 0.8rem; border-color:#ddd;">

                    <div id="staffList">
                        @forelse($barbers as $k)
                            @php $status = $k->getStatus(); @endphp
                            <div class="d-flex align-items-center justify-content-between py-2"
                                style="border-bottom:1px solid #eee;">

                                {{-- Info karyawan --}}
                                <div class="d-flex align-items-center gap-2">
                                    <div
                                        style="width:40px;height:40px;border-radius:50%;background:#3a3a3a;
                                        display:flex;align-items:center;justify-content:center;
                                        overflow:hidden;flex-shrink:0;">
                                        @if ($k->foto)
                                            <img src="{{ asset('storage/' . $k->foto) }}"
                                                style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            <i class="bi bi-person-fill" style="color:white;font-size:1.2rem;"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div style="font-weight:700; font-size:0.9rem; text-transform:uppercase;">
                                            {{ $k->nama }}
                                        </div>
                                        <div style="font-size:0.75rem; color:#6b7280;">{{ $k->profesi }}</div>
                                    </div>
                                </div>

                                {{-- Dropdown status --}}
                                <div class="status-dropdown-wrap">
                                    <button class="status-dropdown-trigger" data-id="{{ $k->id }}"
                                        onclick="toggleStatusMenu({{ $k->id }}, event)">
                                        <i class="bi bi-chevron-down status-chevron"></i>
                                        <span class="status-badge {{ $status }}" id="badge-{{ $k->id }}">
                                            {{ strtoupper($status) }}
                                        </span>
                                    </button>

                                    <div class="status-dropdown-menu" id="menu-{{ $k->id }}">
                                        <div class="menu-title">STATUS</div>
                                        <button class="status-option available"
                                            onclick="setStatus({{ $k->id }}, 'available', event)">
                                            AVAILABLE
                                        </button>
                                        <button class="status-option busy"
                                            onclick="setStatus({{ $k->id }}, 'busy', event)">
                                            BUSY
                                        </button>
                                        <button class="status-option off"
                                            onclick="setStatus({{ $k->id }}, 'off', event)">
                                            OFF
                                        </button>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <p class="text-muted text-center py-3" style="font-size:0.85rem;">
                                <i class="bi bi-scissors me-1"></i> Belum ada data barber.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Customer Feedback --}}
            <div class="col-md-5">
                <div class="card-pixel p-3 h-100" style="background:#fff;">
                    <h5 style="font-weight:700; color:#1b4332; margin-bottom:0.5rem; font-size:1rem;">
                        Customer Feedback
                    </h5>
                    <hr style="margin:0 0 0.8rem; border-color:#ddd;">

                    @foreach ($feedbacks as $f)
                        <div class="feedback-item">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div
                                    style="width:30px;height:30px;border-radius:50%;background:#c9b8e8;
                                        display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi bi-person-fill" style="font-size:0.8rem;color:#7c5cbf;"></i>
                                </div>
                                <span class="feedback-name">{{ $f['nama'] }}</span>
                            </div>
                            <div class="star-rating mb-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi bi-star{{ $i <= $f['rating'] ? '-fill' : '' }}"></i>
                                @endfor
                            </div>
                            <div class="feedback-quote">{{ $f['komentar'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        function toggleStatusMenu(id, e) {
            e.stopPropagation();
            document.querySelectorAll('.status-dropdown-menu').forEach(m => {
                if (m.id !== 'menu-' + id) m.classList.remove('show');
            });
            document.getElementById('menu-' + id).classList.toggle('show');
        }

        document.addEventListener('click', () => {
            document.querySelectorAll('.status-dropdown-menu').forEach(m => m.classList.remove('show'));
        });

        function setStatus(id, status, e) {
            e.stopPropagation();

            fetch(`/karyawan/${id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        status
                    }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const badge = document.getElementById('badge-' + id);
                        badge.textContent = status.toUpperCase();
                        badge.className = 'status-badge ' + status;

                        document.getElementById('menu-' + id).classList.remove('show');

                        updateAvailableCount();
                    }
                })
                .catch(err => console.error(err));
        }

        function updateAvailableCount() {
            const count = document.querySelectorAll('.status-badge.available').length;
            const el = document.getElementById('statAvailableCount');
            if (el) el.textContent = count;
        }
    </script>
@endpush
