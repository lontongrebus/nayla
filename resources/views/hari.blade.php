<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $judul }}</h1>
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
            <div class="card card-info">
                <div class="card-header">
                    <h2 class="card-title text-bold text-center">
                        <center> HARI</center>
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
                    <table class="table  table-bordered  table-striped table-hover text-center" style="width: 100%" id="myTable">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Hari </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                              $no=1;
                              $rec=DB::table('tb_hari')->get();
            
                              foreach ($rec as $key => $value) {
                          ?>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->nm_hari }}</td>
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