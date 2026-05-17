@extends('layouts.template')

@push('styles')
    <style>
        .pw-wrap {
            position: relative;
        }

        .pw-wrap .form-control {
            padding-right: 2.8rem;
            border-radius: 8px;
            font-size: 0.88rem;
        }

        .pw-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #9ca3af;
            font-size: 1rem;
            padding: 0;
            line-height: 1;
            z-index: 5;
        }

        .pw-toggle:hover {
            color: #4b5563;
        }
    </style>
@endpush

@section('contents')
    <div class="d-flex justify-content-center">
        <div class="card-pixel p-4" style="max-width:560px; width:100%;">

            <h4 style="font-weight:700; color:#1b4332; font-size:1.4rem; margin-bottom:0.3rem;">
                Profile Configuration
            </h4>
            <hr style="border-color:#ccc; margin-bottom:1.5rem;">

            {{-- ── Profile Info Form ──────────────────────────────── --}}
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="d-flex align-items-center gap-4 mb-3">

                    {{-- Avatar --}}
                    <div style="position:relative; flex-shrink:0;">
                        <div
                            style="width:90px;height:90px;border-radius:50%;background:#c9b8e8;
                                display:flex;align-items:center;justify-content:center;
                                overflow:hidden;border:2px solid #b39ddb;">

                            {{-- Selalu render img — tersembunyi jika belum ada foto --}}
                            <img id="avatarPreview"
                                src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : '' }}" alt="avatar"
                                style="width:100%;height:100%;object-fit:cover;
                                   display:{{ Auth::user()->foto ? 'block' : 'none' }};"
                                onerror="this.style.display='none';
                                     document.getElementById('avatarIcon').style.display='flex';">
                            <i class="bi bi-person-fill" id="avatarIcon"
                                style="font-size:2.5rem; color:#7c5cbf;
                                  display:{{ Auth::user()->foto ? 'none' : 'flex' }};"></i>
                        </div>

                        <label for="foto"
                            style="position:absolute;bottom:2px;right:2px;background:#fff;
                                  border-radius:50%;width:26px;height:26px;
                                  display:flex;align-items:center;justify-content:center;
                                  cursor:pointer;border:1.5px solid #ccc;
                                  box-shadow:0 1px 4px rgba(0,0,0,.15);"
                            title="Ganti foto">
                            <i class="bi bi-pencil-fill" style="font-size:0.6rem;color:#555;"></i>
                        </label>
                        <input type="file" id="foto" name="foto" accept="image/*" style="display:none;"
                            onchange="previewAvatar(this)">
                    </div>

                    {{-- Name & Email --}}
                    <div class="flex-grow-1">
                        <div class="mb-2 d-flex align-items-center gap-2">
                            <label style="font-weight:700;font-size:0.9rem;white-space:nowrap;min-width:55px;">
                                Name :
                            </label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}"
                                required style="border-radius:8px;">
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <label style="font-weight:700;font-size:0.9rem;white-space:nowrap;min-width:55px;">
                                Email :
                            </label>
                            <span style="font-size:0.88rem;font-weight:600;color:#1b4332;">
                                {{ Auth::user()->email }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="text-end mb-4">
                    <button type="submit" class="btn-pixel-primary">SAVE CHANGES</button>
                </div>
            </form>

            <hr style="border-color:#ccc;">

            {{-- ── Password Form ──────────────────────────────────── --}}
            <form action="{{ route('profile.password') }}" method="POST" class="mt-3">
                @csrf

                {{-- Current Password --}}
                <div class="mb-3">
                    <label class="form-label" style="font-size:0.82rem;font-weight:600;">
                        Current Password
                    </label>
                    <div class="pw-wrap">
                        <input type="password" id="pw_current" name="current_password" class="form-control"
                            placeholder="Ketik password sekarang">
                        <button type="button" class="pw-toggle" onclick="togglePw('pw_current', this)" tabindex="-1">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <div style="color:#dc3545;font-size:0.78rem;margin-top:0.25rem;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- New Password --}}
                <div class="mb-3">
                    <label class="form-label" style="font-size:0.82rem;font-weight:600;">
                        New Password
                    </label>
                    <div class="pw-wrap">
                        <input type="password" id="pw_new" name="new_password" class="form-control"
                            placeholder="Ketik password baru">
                        <button type="button" class="pw-toggle" onclick="togglePw('pw_new', this)" tabindex="-1">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                {{-- Confirm New Password --}}
                <div class="mb-4">
                    <label class="form-label" style="font-size:0.82rem;font-weight:600;">
                        Confirm new Password
                    </label>
                    <div class="pw-wrap">
                        <input type="password" id="pw_confirm" name="confirm_new_password" class="form-control"
                            placeholder="Konfirmasi password baru">
                        <button type="button" class="pw-toggle" onclick="togglePw('pw_confirm', this)" tabindex="-1">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn-pixel-teal">CONFIRM</button>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Preview foto sebelum upload
        function previewAvatar(input) {
            if (!input.files || !input.files[0]) return;
            const reader = new FileReader();
            const preview = document.getElementById('avatarPreview');
            const icon = document.getElementById('avatarIcon');
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (icon) icon.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush
