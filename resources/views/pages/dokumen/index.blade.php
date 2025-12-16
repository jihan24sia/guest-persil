@extends('layouts.guest.app')
@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url('{{ asset('assets-guest/img/construction/showcase-2.webp') }}');">
        <div class="container position-relative">
            <h1>Data Dokumen</h1>
            <p>Daftar dokumen lengkap dengan filter, pencarian, dan aksi edit / hapus.</p>

            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="current">Data Dokumen</li>
                </ol>
            </nav>
        </div>
    </div>
    <section class="section pt-4 pb-5">
        <div class="container">

            {{-- FLASH MESSAGE --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">
                    <i class="bi bi-file-earmark-text-fill me-2"></i> Data Dokumen
                </h4>

                <a href="{{ route('dokumen.create') }}" class="btn btn-orange btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Dokumen
                </a>
            </div>

            {{-- Filter + Search --}}
            <form method="GET" action="{{ route('dokumen.index') }}" class="mb-4">
                <div class="row gy-2">

                    <div class="col-md-3">
                        <select name="jenis_dokumen" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach (['SHM','IMB','Surat Kepemilikan','HGB','PBB','SPPT'] as $jenis)
                                <option value="{{ $jenis }}" {{ request('jenis_dokumen') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                value="{{ request('search') }}" placeholder="Search...">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    @if (request('search'))
                        <div class="col-md-2">
                            <a href="{{ route('dokumen.index') }}" class="btn btn-outline-danger w-100">
                                Clear Search
                            </a>
                        </div>
                    @endif
                </div>
            </form>

            {{-- Kartu Dokumen --}}
            <div class="row gy-4">
                @forelse ($data as $d)
                    <div class="col-lg-4 col-md-6">
                        {{-- Tambahkan data-id untuk JS mengambil ID --}}
                        <div class="warga-card card-orange shadow-lg p-3" data-aos="fade-up">

                            <div class="text-center mt-3">
                                <div class="card-name">{{ $d->jenis_dokumen }}</div>
                                <div class="card-job">Dokumen</div>
                            </div>

                            <div class="warga-info mt-3">
                                <p><strong>Nomor:</strong> {{ $d->nomor }}</p>
                                <p><strong>Persil:</strong> {{ $d->persil->kode_persil ?? '-' }}</p>
                                <p><strong>Keterangan:</strong> {{ $d->keterangan ?? '-' }}</p>
                            </div>

                            <div class="d-flex justify-content-center gap-2 mt-3">
                                {{-- TOMBOL DETAIL BARU --}}
                                <button type="button" class="btn btn-info btn-sm px-3 btn-detail-dokumen"
                                        data-bs-toggle="modal" data-bs-target="#detailDokumenModal"
                                        data-id="{{ $d->dokumen_id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>

                                <a href="{{ route('dokumen.edit', $d->dokumen_id) }}" class="btn btn-edit btn-sm px-3">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('dokumen.destroy', $d->dokumen_id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus dokumen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-hapus btn-sm px-3">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Belum ada data dokumen.</p>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </section>

    {{-- MODAL DETAIL DOKUMEN --}}
    <div class="modal fade" id="detailDokumenModal" tabindex="-1" aria-labelledby="detailDokumenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailDokumenModalLabel"><i class="bi bi-file-earmark-text-fill me-2"></i> Detail Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="loading" class="text-center" style="display: none;">
                        <div class="spinner-border text-orange" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat data...</p>
                    </div>

                    <div id="dokumen-details">
                        <h4 class="fw-bold mb-3" id="detail-jenis"></h4>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Nomor Dokumen</th>
                                <td id="detail-nomor"></td>
                            </tr>
                            <tr>
                                <th>Kode Persil</th>
                                <td id="detail-persil"></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td id="detail-keterangan"></td>
                            </tr>
                        </table>

                        <h5 class="fw-bold mt-4 mb-3"><i class="bi bi-images me-1"></i> Media Terlampir</h5>
                        <div class="row row-cols-2 row-cols-md-3 g-3" id="media-list">
                            {{-- Konten media akan diisi oleh JS --}}
                        </div>
                        <p id="no-media-message" class="text-muted" style="display: none;">Tidak ada file media terlampir.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- END MODAL DETAIL DOKUMEN --}}

@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('.btn-detail-dokumen').on('click', function() {
            const dokumenId = $(this).data('id');
            const detailModal = $('#detailDokumenModal');

            // Tampilkan loading, sembunyikan detail
            $('#dokumen-details').hide();
            $('#loading').show();
            $('#media-list').empty(); // Kosongkan daftar media
            $('#no-media-message').hide();

            // Lakukan permintaan AJAX
            $.ajax({
                url: `/dokumen/${dokumenId}`, // Sesuaikan URL API jika perlu, asumsikan ini adalah route show
                method: 'GET',
                success: function(response) {
                    $('#loading').hide();
                    $('#dokumen-details').show();

                    // Isi data dokumen
                    $('#detail-jenis').text(response.jenis_dokumen);
                    $('#detail-nomor').text(response.nomor);
                    $('#detail-persil').text(response.persil ? response.persil.kode_persil : '-');
                    $('#detail-keterangan').text(response.keterangan || '-');

                    // Isi daftar media
                    if (response.media && response.media.length > 0) {
                        let mediaHtml = '';
                        response.media.forEach(function(media) {
                            const filePath = '{{ asset("storage/uploads/dokumen") }}/' + media.file_name;
                            const isImage = media.mime_type.startsWith('image/');

                            mediaHtml += `
                                <div class="col">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body p-2">
                                            <div class="text-center mb-2">
                                                ${isImage
                                                    ? `<img src="${filePath}" class="img-fluid rounded" style="height: 100px; width: 100%; object-fit: cover;" alt="Dokumen Media">`
                                                    : `<i class="bi bi-file-earmark-text display-4 text-secondary"></i>`
                                                }
                                            </div>
                                            <small class="d-block text-truncate text-center mb-2" title="${media.file_name}">${media.file_name}</small>
                                            <a href="${filePath}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                                <i class="bi bi-download"></i> Lihat File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        $('#media-list').html(mediaHtml);
                    } else {
                        $('#no-media-message').show();
                    }

                },
                error: function(xhr) {
                    $('#loading').hide();
                    alert('Gagal mengambil data dokumen.');
                    detailModal.modal('hide');
                }
            });
        });
    });
</script>
@endpush
