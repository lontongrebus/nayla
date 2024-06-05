 
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
                                <center>FAKULTAS-FAKULTAS YANG ADA DI UNIVERSITAS</center>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#formFakultas')[0].reset();;"
                                    data-target="#popUpEditTambah">
                                    Tambah Data Baru
                                </button>
                            </div>

                            <div class="card-body">
                                <table id="dataFakultas" class="table  table-bordered  table-striped table-hover text-center"
                                    style="width: 100%">
                                    <thead>
                                       
                                        <tr>
                                            <th> No </th>
                                            <th> Kode </th>
                                            <th> Fakultas </th>
                                            <th> Dekan </th>
                                            {{-- <th> Dekan </th>
                                            <th> Jenjang </th> --}}
                                            <th> Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                        $no=1;
                        $data = DB::table ('tb_fakultas as t1') 
                            //    ->join('tb_prodi as t2', 't2.id', '=', 't1.id_prodi')
                            //    ->join('tb_jenjang as t3', 't3.id', '=', 't1.jenjang')
                               ->join('tb_dosenn as t4', 't4.id', '=', 't1.id_dekan')
                               ->select('t1.*', 't4.nm_dsn', 't4.id as idkaprodi')
                               ->get();
                            //    , 't2.nm_prodi', 't2.id as idprodi', 't3.jenjang', 't3.id as idjenjang'
                        foreach ($data as $key => $value) {
                            
                    ?>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $value->kode }}</td>
                                            <td>{{ $value->fakultas }}</td>
                                            {{-- <td>{{ $value->nm_prodi }}</td> --}}
                                            <td>{{ $value->nm_dsn }}</td>
                                            {{-- <td>{{ $value->jenjang }}</td> --}}
                                            <td width="130">
                                                
                                                <button type="button"
                                                    class="btn btn-warning  btn-sm editfakultasDialog"
                                                    title="{{ $value->id }}"
                                                    onclick=" passingEditData(`{{ $value->id }}`,`{{ $value->kode }}`,`{{ $value->fakultas }}`,`{{ $value->idkaprodi }}`)" 
                                                    data-toggle="modal" data-target="#popUpEditTambah"> Edit</button>

                                                <a class="btn btn-danger btn-sm  " title="{{ $value->id }}"
                                                    onclick= "if (confirm('Anda yakin hapus data ini?')){
                                                                  window.location.href = '{{URL::to('/hapusfakultas', $value->id)}}';} ">Delete</a>
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
    function passingEditData(id,kode,fak,iddekan){
        $('#fakultasId').val(id);  
        $('#kode').val(kode);  
        $('#fakultas').val(fak);
        $('#id_dekan').val(iddekan);
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
            <form action="{{ url('/addNewFakultas') }}" method="get" id="formFakultas">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="fakultasId" id="fakultasId" value="">
                    <table>
                        <tr>
                            <th width="120">Kode</th>
                            <td width="320">
                                <input type="number" class="form-control " placeholder="Input Kode..."
                                    name="kode" id="kode" value="" required>

                            </td>
                        </tr>
                        <tr>
                            <th>Fakultas</th>
                            <td width="320">
                                <input type="text" class="form-control " placeholder="Input Fakultas..."
                                    name="fakultas" id="fakultas" value="" required>

                            </td>
                        </tr>
                        <tr>
                            <th>Dekan</th>
                            <td><select name="id_dekan" id="id_dekan" class="form-control" required>
                                <option value="" disabled selected>-- Pilih --</option>
                                <?php foreach (DB::table('tb_dosenn')->get() as $key => $row) {
                                    echo '<option value="' . $row->id . '" >' . $row->nm_dsn . '</option>';
                                } ?>
                            </select>
                            </td>
                        </tr>
                        {{-- <tr>
                            <th>Dekan</th>
                            <td>
                                <select name="id_kaprodi" id="id_kaprodi" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <?php foreach (DB::table('tb_dosenn')->get() as $key => $row) {
                                        echo '<option value="' . $row->id . '" >' . $row->nm_dsn . '</option>';
                                    } ?>
                                </select>
                            </td>
                        </tr> --}}
                        {{-- <tr>
                            <th>Jenjang</th>
                            <td>
                                <select name="jenjang" id="jenjang" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <?php foreach (DB::table('tb_jenjang')->get() as $key => $row) {
                                        echo '<option value="' . $row->id . '" >' . $row->jenjang . '</option>';
                                    } ?>
                                </select>
                            </td>
                        </tr> --}}
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

        $('.id_dekan').val('<?= $id_dekan ?>');
    })

    var table = $('#dataFakultas').DataTable();
</script>
