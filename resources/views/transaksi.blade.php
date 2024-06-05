<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $judul }}</h1>
                <h6><em>Formulir Transaksi</em></h6>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard v3</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<hr style="margin-top:-20px">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title text-bold">{{ $pesan }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ url('/transaksi') }}" method="post" id="formTransaksi">
                    @csrf
                    <div class="card-body">

                        <table class="tabel table-sm" width="100%">

                            <tr>
                                <th>Nama Fakultas</th>
                                <td>
                                    <select class="form-control" name="nmfak">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                        $query_fak = DB::table('tb_fakultas')->get();
                                        foreach ($query_fak as $row) {
                                            echo '<option value="id" >' . $row->fakultas . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                                <th>Program Studi</th>
                                <td>
                                    <select class="form-control" name="nmfak">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                        $query_pro = DB::table('tb_prodi')->get();
                                        foreach ($query_pro as $row) {
                                            echo '<option value="id" >' . $row->nm_prodi . '</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Ketua Program Studi</th>
                                <td> <select class="form-control" name="nmfak">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                        $query_prodi = DB::table('tb_prodi')->get();
                                        foreach ($query_prodi as $row) {
                                            echo '<option value="id" >' . $row->nm_prodi . '</option>';
                                        }
                                        ?>
                                    </select>
                                <th>Jenjang</th>
                                <td><select name="jenjang" id="jenjang" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih --</option>
                                    <?php foreach (DB::table('tb_jenjang')->get() as $key => $row) {
                                        echo '<option value="' . $row->id . '" >' . $row->jenjang . '</option>';
                                    } ?>
                                </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-danger" type="submit">Simpan</button>
                        <a class="btn btn-primary   " href="{{ url('/transaksi') }}">Tambah Data</a>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card card-info">
                <div class="card-header">
                    <h2 class="card-title text-bold text-center">
                        <center> Data Transaksi Universitas</center>
                    </h2>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table  table-bordered  table-striped table-hover" style="width: 100%" id="myTable">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> NIM </th>
                                <th> Program Studi </th>
                                <th width="130"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                              $no=1;
                              $rec=DB::table('tb_transaksi')->get();
            
                              foreach ($rec as $key => $value) {
                          ?>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->nm_prodi }}</td>
                                <td>{{ $value->nim }}</td>
                                <td>{{ $value->id_prodi }}</td>
                                <td>{{ $value->matkul }}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Edit {{ $value->id }}"
                                        href="{{ url('/edittransaksi', $value->id) }}">Edit</a>
                                    <a class="btn btn-danger btn-sm  "
                                        href="{{ url('/hapustransaksi', $value->id) }}">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        <?php }  
                             ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>