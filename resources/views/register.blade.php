 <div class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1 class="m-0">{{ $judul }}</h1>
                 <h6><em>Registrasi Penguna Baru</em></h6>
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

         <div class="col-lg-4">
             <div class="card card-warning">
                 <div class="card-header">
                     <h3 class="card-title text-bold"><i class="fa fa-user-plus" aria-hidden="true"></i> {{ $pesan }}</h3>
                     <div class="card-tools">
                         <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                             <i class="fas fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                             <i class="fas fa-times"></i>
                         </button>
                     </div>

                 </div>
                 <form action="{{ url('/register') }}" method="post" id="formMahasiswa">
                     @csrf
                     <div class="card-body">

                         <table class="tabel table-sm" width="100%">

                             <tr>
                                 <th>Nama</th>
                                 <td><input type="text" placeholder="Input Nama" autocomplete="off" <?php if (  $name != '') { echo 'readonly'; } ?>
                                         class="form-control" name="name" required value="{{ $name }}"></td>
                             </tr>
                             
                             <tr>
                                <th>User email </th>
                                <td><input type="email" placeholder="Enter name@yahoo.com" autocomplete="off"
                                        class="form-control" name="email" required value="{{ $email }}"></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td><input type="password" placeholder="Enter password" autocomplete="off"
                                        class="form-control" name="password" required value="{{ $password }}" min="3"  minlength="3">
                                </td>
                            </tr>
                             <tr>
                                 <th>User Level</th>
                                 <td>
                                    <select name="user_level"  class="form-control" required>
                                        
                                        <option value="" disabled selected>--Pilih User--</option>
                                        <option value="Admin" <?php if (  $user_level == 'Admin') { echo 'selected'; } ?> >Admin</option>
                                        <option value="User" <?php if (  $user_level == 'User') { echo 'selected'; } ?> >User</option>
                                    </select>    
                                 </td>
                             </tr>
                             <tr>
                                <th>Aktif User</th>
                                <td><input type="radio" name="aktif" <?php if ( $aktif == 'Ya') { echo 'checked'; } ?>
                                        value="Ya ">&nbsp;&nbsp;Ya &nbsp;&nbsp;
                                    <input type="radio" name="aktif" <?php if ( $aktif != 'Ya') { echo 'checked'; } ?>
                                        value="Tidak">&nbsp;&nbsp;Tidak
                            </tr>
                         </table>
                     </div>
                     <div class="card-footer text-center">
                         <button class="btn btn-danger" type="submit">Simpan {{ $pesan }}</button>
                        <a class="btn btn-primary" href="{{ url('/register') }}">Refresh</a> 
                     </div>
                 </form>
             </div>
         </div>

         <div class="col-lg-8">
            <div class="card card-success">
                <div class="card-header">
                    <h2 class="card-title text-bold text-center"><i class="fa fa-user" aria-hidden="true"></i>
                         Tabel penguna aplikasi 
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
                    <table id="datauser" class="table  table-bordered  table-striped table-hover"
                        style="width: 100%">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama </th>
                                <th> email </th>
                                <th> User Level </th>
                                <th> Aktif</th>
                                <th> Tanggal Update </th>
                                <th width="130"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                              $no=1;
                             // $nay=;
                                       
                              foreach (DB::table('users')->get() as $key => $value) {
                          ?>
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->user_level }}</td>
                                <td>{{ $value->aktif }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>

                                    <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Edit {{ $value->id }}"
                                        href="{{ url('/edituser', $value->id) }}">Edit</a>
                                   
                                    <button <?php if($value->aktif == 'Ya') { echo 'disabled'; } ?> class="btn btn-danger btn-sm  " title="{{ $value->id }}"
                                        onclick= "if (confirm('Anda yakin hapus data ini?')){
                                        window.location.href = '{{URL::to('/hapususer', $value->id)}}';} ">Delete
                                    </button>
                                   
                                </td>
                            </tr>
                            <?php }  
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
 </div>