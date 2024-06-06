@extends('layouts.backend.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $judul }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $pesan }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <hr style="margin-top:-20px">
    <div class="container-fluid">
        <div class="row">
            <hr>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h2 class="card-title text-bold text-center">
                                    <center>DAFTAR BARANG</center>
                                </h2>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        onclick="$('#formBarang')[0].reset();;" data-target="#popUpEditTambah">
                                        Tambah Data Baru
                                    </button>
                                </div>

                                <div class="card-body">
                                    <table id="dataBarang"
                                        class="table  table-bordered  table-striped table-hover text-center"
                                        style="width: 100%">
                                        <thead>

                                            <tr>
                                                <th> No </th>
                                                <th> Kode </th>
                                                <th> Nama </th>
                                                <th> Kategori </th>
                                                <th> Harga Jual </th>
                                                <th> Foto </th>
                                                <th> Aksi </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no=1;
                                                $data = DB::table ('barangs')
                                                        ->leftjoin ('kategoris', 'kategoris.id', '=', 'barangs.id_kategori')
                                                        ->select ('barangs.*', 'kategoris.nama as nama_kategori', 'kategoris.id as id_kategori')
                                                        ->get();
                                                foreach ($data as $key => $value) {
                                            ?>
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $value->kode }}</td>
                                                <td>{{ $value->nama }}</td>
                                                <td>{{ $value->nama_kategori }}</td>
                                                <td>{{ $value->harga_jual }}</td>
                                                <td>
                                                    <div class="d-flex" style="gap: 4px">
                                                        @foreach (json_decode($value->foto) as $item)
                                                            <a href="{{ Storage::url($item) }}" target="_blank"
                                                                rel="noopener noreferrer">
                                                                <img src="{{ Storage::url($item) }}" alt=""
                                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td width="130">

                                                    <button type="button" class="btn btn-warning  btn-sm editbarangDialog"
                                                        title="{{ $value->id }}"
                                                        onclick=" passingEditData(`{{ $value->id }}`,`{{ $value->kode }}`,`{{ $value->nama }}`,`{{ $value->id_kategori }}`,`{{ $value->harga_jual }}`,`{{ $value->foto }}`)"
                                                        data-toggle="modal" data-target="#popUpEditTambah"> Edit</button>

                                                    <a class="btn btn-danger btn-sm  " title="{{ $value->id }}"
                                                        onclick= "if (confirm('Anda yakin hapus data ini?')){
                                                                  window.location.href = '{{ URL::to('/barang', $value->id) }}';} ">Delete</a>
                                                </td>
                                            </tr>


                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="popUpEditTambah">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $pesan }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/barang') }}" method="POST" id="formBarang" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="barangId" id="barangId" value="">
                        <table>
                            <tr>
                                <th width="120">Kode</th>
                                <td width="320">
                                    <input type="number" class="form-control " placeholder="Input Kode..." name="kode"
                                        id="kode" value="" required>

                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td width="320">
                                    <input type="text" class="form-control " placeholder="Input Nama Barang..."
                                        name="nama" id="nama" value="" required>

                                </td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        <option value="" disabled selected>-- Pilih --</option>
                                        @foreach (DB::table('kategoris')->get() as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Harga Jual</th>
                                <td width="320">
                                    <input type="text" class="form-control " placeholder="Input Harga Jual..."
                                        name="harga_jual" id="harga_jual" value="" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td width="320">
                                    <div class="d-flex mt-3 mb-2" style="gap: 4px" id="previewContainer">
                                        <img class="img-thumbnail mx-auto d-block" id="previewImage" alt="Preview"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <input type="file" class="form-control" placeholder="Input Foto.." name="foto[]"
                                        multiple id="foto" value="">
                                </td>
                            </tr>
                        </table>
                    </div>



                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">Simpan</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function passingEditData(id, kode, nama, id_kategori, harga_jual, foto) {
            $('#barangId').val(id);
            $('#kode').val(kode);
            $('#nama').val(nama);
            $('#id_kategori').val(id_kategori);
            $('#harga_jual').val(harga_jual);

            let fotoArray = JSON.parse(foto);
            let newFotoArray = fotoArray.map(function(f) {
                return f.replace(/^public\//, 'storage/');
            });
            $('#previewContainer').empty();
            newFotoArray.forEach(function(newPath, index) {
                // Membuat elemen gambar baru
                let imgElement = $('<img>')
                    .addClass('img-thumbnail mx-auto d-block')
                    .attr('id', 'previewImage' + index)
                    .attr('alt', 'Preview ' + index)
                    .attr('src', newPath)
                    .css({
                        'width': '50px',
                        'height': '50px',
                        'object-fit': 'cover'
                    });
                $('#previewContainer').append(imgElement);
            });
        }
    </script>
    {{-- <script>
        $(function() {

            $('.id_kategori').val('<?= $id_kategori ?>');
        })

        var table = $('#dataBarang').DataTable();
    </script> --}}
@endsection
