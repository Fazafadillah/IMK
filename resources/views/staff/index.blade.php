@extends('layouts.template')

@section('contents')
    <div class="d-flex justify-content-center">
        <div class="card-pixel p-4" style="max-width:760px; width:100%;">

            <h4
                style="font-family:'Oswald',sans-serif; font-weight:700; color:#1b4332; font-size:1.5rem; text-align:center; letter-spacing:2px; margin-bottom:0.3rem;">
                DAFTAR STAFF
            </h4>
            <hr style="border-color:#aaa; margin-bottom:1rem;">

            {{-- Tombol Tambah --}}
            <button class="btn p-0 mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah" title="Tambah karyawan">
                <i class="bi bi-plus-circle-fill" style="font-size:1.6rem; color:#1b4332;"></i>
            </button>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-pixel table-bordered align-middle" style="font-size:0.88rem;">
                    <thead>
                        <tr>
                            <th width="40">No</th>
                            <th>Nama</th>
                            <th>No Handphone</th>
                            <th>Profesi</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyawans as $i => $k)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->no_handphone }}</td>
                                <td>{{ $k->profesi }}</td>
                                <td class="text-center">
                                    {{-- Edit --}}
                                    <button class="btn btn-sm btn-warning py-0 px-2 me-1"
                                        style="font-size:0.75rem; font-weight:600; border-radius:6px;"
                                        data-bs-toggle="modal" data-bs-target="#modalEdit{{ $k->id }}">Edit</button>

                                    {{-- Hapus --}}
                                    <button class="btn btn-sm btn-outline-danger py-0 px-2"
                                        style="font-size:0.75rem; font-weight:600; border-radius:6px;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalHapus{{ $k->id }}">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada data karyawan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:14px; border:none;">
                <div class="modal-header" style="background:#1b4332; color:white; border-radius:14px 14px 0 0;">
                    <h5 class="modal-title" style="font-family:'Oswald',sans-serif; letter-spacing:1px;">Tambah Karyawan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">No Handphone</label>
                            <input type="text" name="no_handphone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Profesi</label>
                            <select name="profesi" class="form-select" required>
                                <option value="">-- Pilih Profesi --</option>
                                <option value="Senior Barber">Senior Barber</option>
                                <option value="Junior Barber">Junior Barber</option>
                                <option value="Barber Trainee">Barber Trainee</option>
                                <option value="Admin">Admin</option>
                                <option value="Cleaning Staff">Cleaning Staff</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Owner">Owner</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:0.82rem;">Foto (opsional)</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-pixel-primary btn-sm px-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--  MODAL EDIT & HAPUS (per karyawan) --}}
    @foreach ($karyawans as $k)
        {{-- Modal Edit --}}
        <div class="modal fade" id="modalEdit{{ $k->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius:14px; border:none;">
                    <div class="modal-header" style="background:#2d6a4f; color:white; border-radius:14px 14px 0 0;">
                        <h5 class="modal-title" style="font-family:'Oswald',sans-serif; letter-spacing:1px;">Edit Karyawan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('staff.update', $k) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:0.82rem;">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ $k->nama }}"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:0.82rem;">No Handphone</label>
                                <input type="text" name="no_handphone" class="form-control"
                                    value="{{ $k->no_handphone }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:0.82rem;">Profesi</label>
                                <select name="profesi" class="form-select" required>
                                    <option value="Senior Barber" {{ $k->profesi == 'Senior Barber' ? 'selected' : '' }}>
                                        Senior Barber</option>
                                    <option value="Junior Barber" {{ $k->profesi == 'Junior Barber' ? 'selected' : '' }}>
                                        Junior Barber</option>
                                    <option value="Barber Trainee"
                                        {{ $k->profesi == 'Barber Trainee' ? 'selected' : '' }}>Barber Trainee</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:0.82rem;">Foto Baru
                                    (opsional)
                                </label>
                                <input type="file" name="foto" class="form-control" accept="image/*">
                                @if ($k->foto)
                                    <div class="mt-1" style="font-size:0.75rem; color:#6b7280;">
                                        <i class="bi bi-image"></i> Foto saat ini tersimpan.
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-pixel-primary btn-sm px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Hapus --}}
        <div class="modal fade" id="modalHapus{{ $k->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content" style="border-radius:14px; border:none;">
                    <div class="modal-header" style="background:#dc3545; color:white; border-radius:14px 14px 0 0;">
                        <h5 class="modal-title" style="font-family:'Oswald',sans-serif; font-size:1rem;">Hapus Karyawan
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="font-size:0.88rem;">
                        Yakin ingin menghapus <strong>{{ $k->nama }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('staff.destroy', $k) }}" method="POST" style="margin:0;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm px-3">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
