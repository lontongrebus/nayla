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
                        $data = DB::table ('tbstok')
                                  ->leftjoin ('tbkategori', 'tbkategori.id', '=', 'tbstok.idkategori')
                                  ->select ('tbstok.*', 'tbkategori.nm_kat', 'tbkategori.id as idkategori')
                                  ->get();
                        foreach ($data as $key => $value) {                           
                    ?>
                                         <tr>
                                             <td>{{ $no++ }}</td>
                                             <td>{{ $value->kode }}</td>
                                             <td>{{ $value->nm_brg }}</td>
                                             <td>{{ $value->idkategori }}</td>
                                             <td>{{ $value->hargajual }}</td>
                                             <td><img src="{{ asset('images/' . $value->foto) }}"
                                                     alt=""style="width: 100px;"></td>
                                             <td width="130">

                                                 <button type="button" class="btn btn-warning  btn-sm editbarangDialog"
                                                     title="{{ $value->id }}"
                                                     onclick=" passingEditData(`{{ $value->id }}`,`{{ $value->kode }}`,`{{ $value->nm_brg }}`,`{{ $value->idkategori }}`,`{{ $value->hargajual }}`,`{{ $value->foto }}`)"
                                                     data-toggle="modal" data-target="#popUpEditTambah"> Edit</button>

                                                 <a class="btn btn-danger btn-sm  " title="{{ $value->id }}"
                                                     onclick= "if (confirm('Anda yakin hapus data ini?')){
                                                                  window.location.href = '{{ URL::to('/hapusbarang', $value->id) }}';} ">Delete</a>
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
     function passingEditData(id, kode, nm_brg, idkategori, hargajual, foto) {
         $('#barangId').val(id);
         $('#kode').val(kode);
         $('#nm_brg').val(nm_brg);
         $('#idkategori').val(idkategori);
         $('#hargajual').val(hargajual);
         $('#foto').val(foto);



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
             <form action="{{ url('/addNewBarang') }}" method="get" id="formBarang">
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
                                     name="nm_brg" id="nm_brg" value="" required>

                             </td>
                         </tr>
                         <tr>
                             <th>Kategori</th>
                             {{-- <td width="320">
                                 <input type="text" class="form-control " placeholder="Input Kategori..."
                                     name="idkategori" id="idkategori" value="" required>

                             </td> --}}
                             <td><select name="idkategori" id="idkategori" class="form-control" required>
                                <option value="" disabled selected>-- Pilih --</option>
                                <?php foreach (DB::table('tbkategori')->get() as $key => $row) {
                                    echo '<option value="' . $row->id . '" >' . $row->nm_kat . '</option>';
                                } ?>
                            </select>
                            </td>
                         </tr>
                         <tr>
                             <th>Harga Jual</th>
                             <td width="320">
                                 <input type="text" class="form-control " placeholder="Input Harga Jual..."
                                     name="hargajual" id="hargajual" value="" required>
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
 <script>
     $(function() {

         $('.idkategori').val('<?= $idkategori ?>');
     })

     var table = $('#dataBarang').DataTable();
 </script>
