 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">{{ $judul }}</h1>
                 <h5 class="m-0">{{ $pesan }}</h5>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Dashboard v3</li>
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
                                 <center>DAFTAR KATEGORI</center>
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
                                     onclick="$('#formKategori')[0].reset();;" data-target="#popUpEditTambah">
                                     Tambah Data Baru
                                 </button>
                             </div>

                             <div class="card-body">
                                 <table id="dataKategori"
                                     class="table  table-bordered  table-striped table-hover text-center"
                                     style="width: 100%">
                                     <thead>

                                         <tr>
                                             <th> No </th>
                                             <th> Nama Kategori </th>
                                             <th> Foto </th>
                                             <th> Keterangan </th>
                                             <th> Aksi </th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php 
                        $no=1;
                        $data = DB::table ('tbkategori')
                                //   ->join ('tbkategori', 'tbkategori.id', '=', 'tbstok.idkategori')
                                //   ->select ('tbstok.*', 'tbkategori.nm_kat', 'tbkategori.id as idkategori')
                                  ->get();
                        foreach ($data as $key => $value) {                           
                    ?>
                                         <tr>
                                             <td>{{ $no++ }}</td>
                                             <td>{{ $value->nm_kat }}</td>
                                             <td><img src="{{ asset('images/' . $value->foto) }}"
                                                     alt=""style="width: 100px;"></td>
                                             <td>{{ $value->ket }}</td>
                                             <td width="130">

                                                 <button type="button" class="btn btn-warning  btn-sm editkategoriDialog"
                                                     title="{{ $value->id }}"
                                                     onclick=" passingEditData(`{{ $value->id }}`,`{{ $value->nm_kat }}`,`{{ $value->foto }}`,`{{ $value->ket }}`)"
                                                     data-toggle="modal" data-target="#popUpEditTambah"> Edit</button>

                                                 <a class="btn btn-danger btn-sm  " title="{{ $value->id }}"
                                                     onclick= "if (confirm('Anda yakin hapus data ini?')){
                                                                  window.location.href = '{{ URL::to('/hapuskategori', $value->id) }}';} ">Delete</a>
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

 <script>
     function passingEditData(id, nm_kat, foto, ket,) {
         $('#kategoriId').val(id);
         $('#nm_kat').val(nm_kat);
         $('#foto').val(foto);
         $('#ket').val(ket);



     }
 </script>

 <div class="modal" tabindex="-1" role="dialog" id="popUpEditTambah">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">{{ $pesan }}</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="{{ url('/addNewKategori') }}" method="get" id="formKategori">
                 @csrf
                 <div class="modal-body">
                     <input type="hidden" name="kategoriId" id="kategoriId" value="">
                     <table>
                         <tr>
                             <th>Nama Kategori</th>
                             <td width="320">
                                 <input type="text" class="form-control " placeholder="Input Nama Kategori..."
                                     name="nm_kat" id="nm_kat" value="" required>

                             </td>
                         </tr>
                         <tr>
                             <th>Foto</th>
                             <td width="320">
                                 <?php
                                 // $data = DB::table ('tbstok')
                                 //           ->select ('tbstok.foto')
                                 //           ->first();
                                 ?>
                                 <img class="img-thumbnail mx-auto d-block" id="previewImage" {{-- src="{{ asset('images/'.$value->foto) }}"  --}}
                                 alt="Preview" style="max-width: 100%; max-height: 200px;">
                                 {{-- <?php ?> --}}
                                 <input type="file" class="form-control" placeholder="Input Foto.."
                                 name="foto" id="foto" value="" required>
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td width="320">
                                    <input type="text" class="form-control " placeholder="Input Keterangan..."
                                        name="ket" id="ket" value="" required>
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
 <script src="{{ url('lte/plugins/jquery/jquery.min.js') }}"></script>
 <script src="{{ url('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

