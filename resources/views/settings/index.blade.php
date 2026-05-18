@extends('layouts.template')

@push('styles')
    <style>
        /*  Tab Nav ─ */
        .settings-tab-nav {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #ddd;
            padding-bottom: 0;
        }

        .settings-tab-btn {
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            padding: 0.55rem 1.2rem;
            font-size: 0.88rem;
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
            border-radius: 6px 6px 0 0;
            letter-spacing: 0.3px;
        }

        .settings-tab-btn:hover {
            color: #1b4332;
            background: rgba(27, 67, 50, 0.05);
        }

        .settings-tab-btn.active {
            color: #1b4332;
            border-bottom-color: #1b4332;
        }

        /*  Tab Panel ─ */
        .tab-panel {
            display: none;
        }

        .tab-panel.active {
            display: block;
        }

        /*  Section Title ─ */
        .section-title {
            font-weight: 700;
            color: #1b4332;
            font-size: 1rem;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /*  Form Grid ─ */
        .form-label-setting {
            font-size: 0.8rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.3rem;
        }

        .form-control-setting {
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.88rem;
            padding: 0.5rem 0.85rem;
            transition: border-color 0.2s;
        }

        .form-control-setting:focus {
            border-color: #2d6a4f;
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.15);
            outline: none;
        }

        /*  Jam buka wrap ─ */
        .jam-wrap {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .jam-wrap span {
            font-weight: 600;
            color: #6b7280;
            font-size: 0.85rem;
        }

        /*  Layanan Table ─ */
        .layanan-table th {
            background: #2d6a4f;
            color: white;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 0.6rem 0.9rem;
            border: none;
        }

        .layanan-table td {
            font-size: 0.85rem;
            padding: 0.6rem 0.9rem;
            vertical-align: middle;
            border-color: #e5e7eb;
        }

        .layanan-table tbody tr:hover {
            background: #f0fdf4;
        }

        .badge-aktif {
            background: #dcfce7;
            color: #16a34a;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
        }

        .badge-nonaktif {
            background: #f3f4f6;
            color: #6b7280;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
        }

        /*  Flash spesifik settings ─ */
        .alert-settings {
            border-radius: 8px;
            font-size: 0.83rem;
            padding: 0.65rem 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-settings.success {
            background: #dcfce7;
            border-left: 4px solid #16a34a;
            color: #15803d;
        }

        /*  Tampilan Tab  */
        .color-swatch-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .color-swatch {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: border 0.2s, transform 0.15s;
            flex-shrink: 0;
        }

        .color-swatch:hover {
            transform: scale(1.1);
        }

        .color-swatch.selected {
            border-color: #1a1a1a;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.15);
        }

        .lang-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            margin-bottom: 0.5rem;
        }

        .lang-option:hover {
            border-color: #2d6a4f;
            background: #f0fdf4;
        }

        .lang-option.selected {
            border-color: #2d6a4f;
            background: #f0fdf4;
        }

        .lang-option input[type="radio"] {
            accent-color: #2d6a4f;
            width: 16px;
            height: 16px;
        }

        .lang-flag {
            font-size: 1.4rem;
        }

        .lang-label {
            font-weight: 600;
            font-size: 0.88rem;
        }

        .lang-sublabel {
            font-size: 0.75rem;
            color: #6b7280;
        }

        .theme-preview-bar {
            height: 8px;
            border-radius: 4px;
            margin-top: 0.4rem;
            transition: background 0.3s;
        }
    </style>
@endpush

@section('contents')
    <div style="max-width:860px; margin:0 auto;">

        {{-- Header --}}
        <div class="d-flex align-items-center gap-2 mb-3">
            <i class="bi bi-gear-fill" style="font-size:1.3rem; color:#1b4332;"></i>
            <h4 style="font-weight:700; color:#1b4332; margin:0; font-size:1.4rem;">Settings</h4>
        </div>

        {{-- Flash Messages --}}
        @if (session('success_info'))
            <div class="alert-settings success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success_info') }}
            </div>
        @endif

        @if (session('success_layanan'))
            <div class="alert-settings success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success_layanan') }}
            </div>
        @endif

        @if (session('success_tampilan'))
            <div class="alert-settings success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success_tampilan') }}
            </div>
        @endif

        <div class="card-pixel p-4">

            {{-- Tab Navigation --}}
            <div class="settings-tab-nav">
                <button class="settings-tab-btn active" onclick="switchTab('info', this)">
                    <i class="bi bi-shop me-1"></i> Info Barbershop
                </button>
                <button class="settings-tab-btn" onclick="switchTab('layanan', this)">
                    <i class="bi bi-scissors me-1"></i> Layanan
                </button>
                <button class="settings-tab-btn" onclick="switchTab('tampilan', this)">
                    <i class="bi bi-palette me-1"></i> Tampilan
                </button>
            </div>


            {{-- TAB 1: Info Barbershop                              --}}

            <div id="tab-info" class="tab-panel active">

                <form action="{{ route('settings.info') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        {{-- Nama Toko --}}
                        <div class="col-12">
                            <label class="form-label-setting">Nama Toko</label>
                            <input type="text" name="nama_toko" class="form-control form-control-setting"
                                value="{{ $settings['nama_toko'] ?? '' }}" placeholder="Pixel Barbershop" required>
                        </div>

                        {{-- Alamat --}}
                        <div class="col-12">
                            <label class="form-label-setting">Alamat</label>
                            <textarea name="alamat" class="form-control form-control-setting" rows="2" placeholder="Jl. Contoh No. 123, Kota"
                                required>{{ $settings['alamat'] ?? '' }}</textarea>
                        </div>

                        {{-- No Telp --}}
                        <div class="col-md-6">
                            <label class="form-label-setting">No. Telepon / WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text"
                                    style="font-size:0.82rem; background:#f9fafb; border-color:#d1d5db;">
                                    <i class="bi bi-telephone-fill" style="color:#2d6a4f;"></i>
                                </span>
                                <input type="text" name="no_telp" class="form-control form-control-setting"
                                    style="border-left:none;" value="{{ $settings['no_telp'] ?? '' }}"
                                    placeholder="08123456789" required>
                            </div>
                        </div>

                        {{-- Hari Buka --}}
                        <div class="col-md-6">
                            <label class="form-label-setting">Hari Buka</label>
                            <input type="text" name="hari_buka" class="form-control form-control-setting"
                                value="{{ $settings['hari_buka'] ?? '' }}" placeholder="Senin - Sabtu" required>
                        </div>

                        {{-- Jam Operasional --}}
                        <div class="col-12">
                            <label class="form-label-setting">Jam Operasional</label>
                            <div class="jam-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-clock" style="color:#2d6a4f;"></i>
                                    <input type="time" name="jam_buka" class="form-control form-control-setting"
                                        style="width:140px;" value="{{ $settings['jam_buka'] ?? '09:00' }}" required>
                                </div>
                                <span>s/d</span>
                                <input type="time" name="jam_tutup" class="form-control form-control-setting"
                                    style="width:140px;" value="{{ $settings['jam_tutup'] ?? '21:00' }}" required>
                            </div>
                        </div>

                        {{-- Preview Card --}}
                        <div class="col-12">
                            <div
                                style="background:#f0fdf4; border:1.5px solid #bbf7d0; border-radius:12px; padding:1rem 1.2rem; margin-top:0.5rem;">
                                <div
                                    style="font-size:0.75rem; font-weight:700; color:#16a34a; letter-spacing:1px; margin-bottom:0.6rem;">
                                    PREVIEW INFO TOKO
                                </div>
                                <div style="font-size:0.88rem; color:#1b4332;">
                                    <div class="d-flex gap-2 mb-1">
                                        <i class="bi bi-shop-window" style="margin-top:2px; flex-shrink:0;"></i>
                                        <span id="preview_nama">{{ $settings['nama_toko'] ?? 'Pixel Barbershop' }}</span>
                                    </div>
                                    <div class="d-flex gap-2 mb-1">
                                        <i class="bi bi-geo-alt-fill" style="margin-top:2px; flex-shrink:0;"></i>
                                        <span id="preview_alamat">{{ $settings['alamat'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex gap-2 mb-1">
                                        <i class="bi bi-telephone-fill" style="margin-top:2px; flex-shrink:0;"></i>
                                        <span id="preview_telp">{{ $settings['no_telp'] ?? '-' }}</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-clock-fill" style="margin-top:2px; flex-shrink:0;"></i>
                                        <span id="preview_jam">
                                            {{ $settings['hari_buka'] ?? '-' }},
                                            {{ $settings['jam_buka'] ?? '09:00' }} –
                                            {{ $settings['jam_tutup'] ?? '21:00' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn-pixel-primary">
                            <i class="bi bi-floppy-fill me-1"></i> SIMPAN PERUBAHAN
                        </button>
                    </div>
                </form>
            </div>

            {{-- TAB 2: Layanan  --}}
            <div id="tab-layanan" class="tab-panel">

                {{-- Tombol Tambah --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="section-title mb-0">
                        <i class="bi bi-list-check"></i> Daftar Layanan
                    </div>
                    <button class="btn-pixel-primary d-flex align-items-center gap-1" data-bs-toggle="modal"
                        data-bs-target="#modalTambahLayanan" style="font-size:0.82rem; padding:0.4rem 1rem;">
                        <i class="bi bi-plus-lg"></i> Tambah Layanan
                    </button>
                </div>

                {{-- Tabel --}}
                <div class="table-responsive">
                    <table class="table layanan-table table-bordered align-middle mb-0">
                        <thead>
                            <tr>
                                <th width="40">No</th>
                                <th>Nama Layanan</th>
                                <th>Harga</th>
                                <th>Durasi</th>
                                <th width="80" class="text-center">Status</th>
                                <th width="130" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($layanans as $i => $l)
                                <tr>
                                    <td class="text-center">{{ $i + 1 }}</td>
                                    <td style="font-weight:600;">{{ $l->nama }}</td>
                                    <td>{{ $l->harga_format }}</td>
                                    <td>{{ $l->durasi_menit }} menit</td>
                                    <td class="text-center">
                                        <span class="{{ $l->aktif ? 'badge-aktif' : 'badge-nonaktif' }}">
                                            {{ $l->aktif ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{-- Toggle aktif --}}
                                        <form action="{{ route('settings.layanan.toggle', $l) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm py-0 px-2 me-1"
                                                style="font-size:0.72rem; font-weight:600; border-radius:6px;
                                                   {{ $l->aktif ? 'border:1.5px solid #6b7280; color:#6b7280;' : 'border:1.5px solid #16a34a; color:#16a34a;' }}"
                                                title="{{ $l->aktif ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                <i class="bi bi-{{ $l->aktif ? 'pause-fill' : 'play-fill' }}"></i>
                                            </button>
                                        </form>

                                        {{-- Edit --}}
                                        <button class="btn btn-sm btn-warning py-0 px-2 me-1"
                                            style="font-size:0.72rem; font-weight:600; border-radius:6px;"
                                            data-bs-toggle="modal" data-bs-target="#modalEditLayanan{{ $l->id }}">
                                            Edit
                                        </button>

                                        {{-- Hapus --}}
                                        <button class="btn btn-sm btn-outline-danger py-0 px-2"
                                            style="font-size:0.72rem; font-weight:600; border-radius:6px;"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalHapusLayanan{{ $l->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4" style="font-size:0.85rem;">
                                        Belum ada layanan. Klik "Tambah Layanan" untuk mulai.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Summary --}}
                @if ($layanans->count() > 0)
                    <div class="d-flex gap-3 mt-3">
                        <div style="font-size:0.78rem; color:#6b7280;">
                            Total: <strong>{{ $layanans->count() }}</strong> layanan
                        </div>
                        <div style="font-size:0.78rem; color:#16a34a;">
                            Aktif: <strong>{{ $layanans->where('aktif', true)->count() }}</strong>
                        </div>
                        <div style="font-size:0.78rem; color:#9ca3af;">
                            Nonaktif: <strong>{{ $layanans->where('aktif', false)->count() }}</strong>
                        </div>
                    </div>
                @endif

            </div>{{-- /tab-layanan --}}


            {{-- TAB 3: Tampilan                                      --}}

            <div id="tab-tampilan" class="tab-panel">
                <form action="{{ route('settings.tampilan') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        {{--  Tema Warna  --}}
                        <div class="col-12">
                            <div class="section-title">
                                <i class="bi bi-palette-fill"></i> Tema Warna
                            </div>

                            @php
                                $temaAktif = $settings['tema_warna'] ?? 'green';
                                $temas = [
                                    'green' => [
                                        'label' => 'Hijau (Default)',
                                        'primary' => '#1b4332',
                                        'mid' => '#2d6a4f',
                                        'bg' => '#a8d5a2',
                                    ],
                                    'blue' => [
                                        'label' => 'Biru',
                                        'primary' => '#1e3a5f',
                                        'mid' => '#2563eb',
                                        'bg' => '#bfdbfe',
                                    ],
                                    'maroon' => [
                                        'label' => 'Merah Tua',
                                        'primary' => '#4a0e0e',
                                        'mid' => '#991b1b',
                                        'bg' => '#fecaca',
                                    ],
                                    'purple' => [
                                        'label' => 'Ungu',
                                        'primary' => '#3b0764',
                                        'mid' => '#7c3aed',
                                        'bg' => '#ddd6fe',
                                    ],
                                    'slate' => [
                                        'label' => 'Abu-abu',
                                        'primary' => '#1e293b',
                                        'mid' => '#475569',
                                        'bg' => '#cbd5e1',
                                    ],
                                ];
                            @endphp

                            <div class="color-swatch-wrap mb-3">
                                @foreach ($temas as $key => $t)
                                    <div style="text-align:center;">
                                        <label style="cursor:pointer;">
                                            <input type="radio" name="tema_warna" value="{{ $key }}"
                                                style="display:none;" {{ $temaAktif === $key ? 'checked' : '' }}>
                                            <div class="color-swatch {{ $temaAktif === $key ? 'selected' : '' }}"
                                                style="background: linear-gradient(135deg, {{ $t['primary'] }} 50%, {{ $t['mid'] }} 50%);"
                                                title="{{ $t['label'] }}"
                                                onclick="selectTema('{{ $key }}', this)">
                                            </div>
                                            <div
                                                style="font-size:0.65rem; color:#6b7280; margin-top:0.3rem; max-width:50px;">
                                                {{ $t['label'] }}
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Preview bar tema --}}
                            <div style="font-size:0.75rem; font-weight:600; color:#6b7280; margin-bottom:0.3rem;">
                                Preview
                            </div>
                            <div style="border-radius:10px; overflow:hidden; border:1.5px solid #e5e7eb;">
                                <div id="previewNavbar"
                                    style="padding:0.6rem 1rem; color:white; font-weight:700; font-size:0.85rem;
                                        display:flex; align-items:center; gap:0.5rem;
                                        background:{{ $temas[$temaAktif]['primary'] }};">
                                    <span style="font-family:'Jersey 15',cursive; font-size:1.1rem;">PIXEL</span>
                                    <span style="font-size:0.65rem; opacity:0.8;">BARBERSHOP</span>
                                    <div style="margin-left:auto; display:flex; gap:0.4rem;">
                                        <div
                                            style="background:rgba(255,255,255,0.2); border-radius:6px; padding:0.15rem 0.5rem; font-size:0.72rem;">
                                            Dashboard</div>
                                        <div
                                            style="background:rgba(255,255,255,0.2); border-radius:6px; padding:0.15rem 0.5rem; font-size:0.72rem;">
                                            Staff</div>
                                    </div>
                                </div>
                                <div id="previewBg"
                                    style="padding:0.8rem 1rem; background:{{ $temas[$temaAktif]['bg'] }};">
                                    <div
                                        style="background:white; border-radius:8px; padding:0.5rem 0.8rem; font-size:0.78rem; color:#374151; display:inline-block;">
                                        Contoh konten halaman
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--  Bahasa  --}}
                        <div class="col-12">
                            <div class="section-title">
                                <i class="bi bi-translate"></i> Bahasa Antarmuka
                            </div>

                            @php $bahasaAktif = $settings['bahasa'] ?? 'id'; @endphp

                            <label class="lang-option {{ $bahasaAktif === 'id' ? 'selected' : '' }}"
                                onclick="selectLang(this)">
                                <input type="radio" name="bahasa" value="id"
                                    {{ $bahasaAktif === 'id' ? 'checked' : '' }}>
                                <span class="lang-flag">🇮🇩</span>
                                <div>
                                    <div class="lang-label">Bahasa Indonesia</div>
                                    <div class="lang-sublabel">Antarmuka dalam Bahasa Indonesia</div>
                                </div>
                            </label>

                            <label class="lang-option {{ $bahasaAktif === 'en' ? 'selected' : '' }}"
                                onclick="selectLang(this)">
                                <input type="radio" name="bahasa" value="en"
                                    {{ $bahasaAktif === 'en' ? 'checked' : '' }}>
                                <span class="lang-flag">🇬🇧</span>
                                <div>
                                    <div class="lang-label">English</div>
                                    <div class="lang-sublabel">Interface in English</div>
                                </div>
                            </label>

                            @if (($settings['bahasa'] ?? 'id') === 'en')
                                <div
                                    style="background:#fef9c3; border:1.5px solid #fde047; border-radius:8px;
                                    padding:0.6rem 0.9rem; font-size:0.78rem; color:#854d0e; margin-top:0.5rem;">
                                    <i class="bi bi-info-circle-fill me-1"></i>
                                    Fitur multi-bahasa akan diterapkan setelah save dan reload halaman.
                                </div>
                            @endif
                        </div>

                    </div>{{-- /row --}}

                    <div class="text-end mt-4">
                        <button type="submit" class="btn-pixel-primary">
                            <i class="bi bi-floppy-fill me-1"></i> SIMPAN TAMPILAN
                        </button>
                    </div>
                </form>
            </div>{{-- /tab-tampilan --}}

        </div>{{-- /card-pixel --}}
    </div>

    
    {{-- MODALS                                                                 --}}
    

    {{-- Modal Tambah Layanan --}}
    <div class="modal fade" id="modalTambahLayanan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; border:none;">
                <div class="modal-header" style="background:#1b4332; color:white; border-radius:14px 14px 0 0;">
                    <h5 class="modal-title" style="font-size:0.95rem; font-weight:700; letter-spacing:0.5px;">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Layanan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('settings.layanan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" style="font-size:0.82rem; font-weight:600;">Nama Layanan</label>
                            <input type="text" name="nama" class="form-control" required
                                placeholder="cth: Haircut, Shave, dll">
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label" style="font-size:0.82rem; font-weight:600;">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" required min="0"
                                    step="1000" placeholder="35000">
                            </div>
                            <div class="col-6">
                                <label class="form-label" style="font-size:0.82rem; font-weight:600;">Durasi
                                    (menit)</label>
                                <input type="number" name="durasi_menit" class="form-control" required min="1"
                                    placeholder="30">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-pixel-primary"
                            style="font-size:0.82rem; padding:0.4rem 1.1rem;">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit & Hapus per layanan --}}
    @foreach ($layanans as $l)
        {{-- Edit --}}
        <div class="modal fade" id="modalEditLayanan{{ $l->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius:14px; border:none;">
                    <div class="modal-header" style="background:#2d6a4f; color:white; border-radius:14px 14px 0 0;">
                        <h5 class="modal-title" style="font-size:0.95rem; font-weight:700;">
                            <i class="bi bi-pencil me-1"></i> Edit Layanan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('settings.layanan.update', $l) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" style="font-size:0.82rem; font-weight:600;">Nama Layanan</label>
                                <input type="text" name="nama" class="form-control" value="{{ $l->nama }}"
                                    required>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label" style="font-size:0.82rem; font-weight:600;">Harga
                                        (Rp)
                                    </label>
                                    <input type="number" name="harga" class="form-control"
                                        value="{{ $l->harga }}" min="0" step="1000" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" style="font-size:0.82rem; font-weight:600;">Durasi
                                        (menit)</label>
                                    <input type="number" name="durasi_menit" class="form-control"
                                        value="{{ $l->durasi_menit }}" min="1" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-pixel-primary"
                                style="font-size:0.82rem; padding:0.4rem 1.1rem;">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Hapus --}}
        <div class="modal fade" id="modalHapusLayanan{{ $l->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content" style="border-radius:14px; border:none;">
                    <div class="modal-header" style="background:#dc3545; color:white; border-radius:14px 14px 0 0;">
                        <h5 class="modal-title" style="font-size:0.9rem; font-weight:700;">Hapus Layanan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="font-size:0.88rem;">
                        Yakin hapus layanan <strong>{{ $l->nama }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('settings.layanan.destroy', $l) }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm px-3">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        //  Tab switching 
        function switchTab(tabId, btn) {
            // Sembunyikan semua panel
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.settings-tab-btn').forEach(b => b.classList.remove('active'));

            // Tampilkan panel yang dipilih
            document.getElementById('tab-' + tabId).classList.add('active');
            btn.classList.add('active');

            // Simpan tab aktif di sessionStorage supaya tidak reset setelah form submit
            sessionStorage.setItem('activeSettingTab', tabId);
        }

        // Restore tab aktif setelah redirect (misal setelah simpan layanan)
        document.addEventListener('DOMContentLoaded', function() {
            const saved = sessionStorage.getItem('activeSettingTab');
            if (saved) {
                const btn = document.querySelector(`.settings-tab-btn[onclick*="${saved}"]`);
                if (btn) switchTab(saved, btn);
            }

            // Kalau ada flash success_layanan, otomatis buka tab layanan
            @if (session('success_layanan'))
                const layananBtn = document.querySelector(".settings-tab-btn[onclick*='layanan']");
                if (layananBtn) switchTab('layanan', layananBtn);
            @endif

            // Kalau ada flash success_tampilan, otomatis buka tab tampilan
            @if (session('success_tampilan'))
                const tampilanBtn = document.querySelector(".settings-tab-btn[onclick*='tampilan']");
                if (tampilanBtn) switchTab('tampilan', tampilanBtn);
            @endif
        });

        //  Pilih tema warna 
        const temaData = {
            green: {
                primary: '#1b4332',
                mid: '#2d6a4f',
                bg: '#a8d5a2'
            },
            blue: {
                primary: '#1e3a5f',
                mid: '#2563eb',
                bg: '#bfdbfe'
            },
            maroon: {
                primary: '#4a0e0e',
                mid: '#991b1b',
                bg: '#fecaca'
            },
            purple: {
                primary: '#3b0764',
                mid: '#7c3aed',
                bg: '#ddd6fe'
            },
            slate: {
                primary: '#1e293b',
                mid: '#475569',
                bg: '#cbd5e1'
            },
        };

        function selectTema(key, swatchEl) {
            // Update radio
            document.querySelectorAll('input[name="tema_warna"]').forEach(r => r.checked = (r.value === key));

            // Update selected state pada swatch
            document.querySelectorAll('.color-swatch').forEach(s => s.classList.remove('selected'));
            swatchEl.classList.add('selected');

            // Update preview
            const t = temaData[key];
            if (!t) return;
            document.getElementById('previewNavbar').style.background = t.primary;
            document.getElementById('previewBg').style.background = t.bg;
        }

        //  Pilih bahasa 
        function selectLang(labelEl) {
            document.querySelectorAll('.lang-option').forEach(l => l.classList.remove('selected'));
            labelEl.classList.add('selected');
        }

        //  Preview info toko realtime 
        function bindPreview(inputName, previewId) {
            const input = document.querySelector(`[name="${inputName}"]`);
            const preview = document.getElementById(previewId);
            if (!input || !preview) return;
            input.addEventListener('input', () => {
                preview.textContent = input.value || '-';
            });
        }

        bindPreview('nama_toko', 'preview_nama');
        bindPreview('alamat', 'preview_alamat');
        bindPreview('no_telp', 'preview_telp');

        // Preview jam operasional
        function updatePreviewJam() {
            const hari = document.querySelector('[name="hari_buka"]')?.value || '-';
            const buka = document.querySelector('[name="jam_buka"]')?.value || '-';
            const tutup = document.querySelector('[name="jam_tutup"]')?.value || '-';
            const preview = document.getElementById('preview_jam');
            if (preview) preview.textContent = `${hari}, ${buka} – ${tutup}`;
        }

        ['hari_buka', 'jam_buka', 'jam_tutup'].forEach(name => {
            const el = document.querySelector(`[name="${name}"]`);
            if (el) el.addEventListener('input', updatePreviewJam);
        });
    </script>
@endpush
