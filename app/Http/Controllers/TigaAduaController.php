<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TigaAduaController extends Controller
{
    public function index()
    {
        return view('/welcome')
            ->with('content', 'dashboard');
    }
    //***********************/
    public function mhsbaru(Request $r)
    {
        $datamhs = array(
            'nm_mhs' => $r->input('nm_mhs'),
            'nim' => $r->input('nim'),
            'jk' => $r->input('jk'),
            'id_fakultas' => $r->input('id_fakultas'),
            'id_prodi' => $r->input('id_prodi'),
            // 'id_matkul' => $r->input('id_matkul'),
            // 'matkul' => $r->input('matkul'),
        );

        $nim_count = DB::table('tb_mhs')->where('nim', '=', $r->input('nim'))->count();
        if ($nim_count == 0 and $r->input('nim') != "") {
            DB::table('tb_mhs')->insert($datamhs);

        } else {

            DB::table('tb_mhs')->where('nim', $r->input('nim'))->update($datamhs);
        }
        ;
        return view('/welcome')
            ->with('judul', 'TABEL MAHASISWA')
            ->with('nm_mhs', "")
            ->with('nim', "")
            ->with('jk', "")
            ->with('id_fakultas', "")
            ->with('id_prodi', "")
            // ->with('id_matkul', "")
            // ->with('matkul', "")
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'mahasiswabaru');
    }
    //***********************/
    public function editmhs($norec)
    {
        $getMhs = DB::table('tb_mhs')->where('norec', $norec)->first();
        $datamhs = array(
            'nm_mhs' => $getMhs->nm_mhs,
            'nim' => $getMhs->nim,
            'jk' => $getMhs->jk,
            'id_fakultas' => $getMhs->id_fakultas,
            'id_prodi' => $getMhs->id_prodi,
            // 'id_matkul' => $getMhs->id_matkul,
        );
        return view('/welcome', $datamhs)
            ->with('judul', 'EDIT FORMULIR MAHASISWA')
            ->with('pesan', 'Edit Data Mahasiswa')
            ->with('content', 'mahasiswabaru');
    }
    //***********************/
    public function hapusmhs($norec)
    {
        $getMhs = DB::table('tb_mhs')->where('norec', $norec)->delete();
        return view('/welcome')
            ->with('judul', 'HAPUS FORMULIR MAHASISWA')
            ->with('nm_mhs', "")
            ->with('nim', "")
            ->with('jk', "")
            ->with('id_fakultas', "")
            ->with('id_prodi', "")
            // ->with('id_matkul', "")
            // ->with('matkul', "")
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'mahasiswabaru');
    }

    //***********************/
    public function dsn(Request $r)
    {
        $datadsn = array(
            'nm_dsn' => $r->input('nm_dsn'),
            'nidn' => $r->input('nidn'),
            'jk' => $r->input('jk'),
            'id_fakultas' => $r->input('id_fakultas'),
            'id_prodi' => $r->input('id_prodi'),
            'matkul' => $r->input('matkul'),
        );

        $nidn_count = DB::table('tb_dosenn')->where('nidn', '=', $r->input('nidn'))->count();
        if ($nidn_count == 0 and $r->input('nidn') != "") {
            DB::table('tb_dosenn')->insert($datadsn);

        } else {

            DB::table('tb_dosenn')->where('nidn', $r->input('nidn'))->update($datadsn);
        }
        ;
        return view('/welcome')
            ->with('judul', 'TABEL DOSEN')
            ->with('nm_dsn', "")
            ->with('nidn', "")
            ->with('jk', "")
            ->with('id_fakultas', "")
            ->with('id_prodi', "")
            ->with('matkul', "")
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'dosen');
    }
    //***********************/
    public function editdsn($norec)
    {
        $getDsn = DB::table('tb_dosenn')->where('norec', $norec)->first();
        $datadsn = array(
            'nm_dsn' => $getDsn->nm_dsn,
            'nidn' => $getDsn->nidn,
            'jk' => $getDsn->jk,
            'id_fakultas' => $getDsn->id_fakultas,
            'id_prodi' => $getDsn->id_prodi,
            'matkul' => $getDsn->matkul,
        );
        return view('/welcome', $datadsn)
            ->with('judul', 'FORMULIR DOSEN')
            ->with('pesan', 'Edit Data Dosen')
            ->with('content', 'dosen');
    }
    //***********************/
    public function hapusdsn($norec)
    {
        $getDsn = DB::table('tb_dosenn')->where('norec', $norec)->delete();
        return view('/welcome')
            ->with('judul', 'FORMULIR DOSEN')
            ->with('nm_dsn', "")
            ->with('nidn', "")
            ->with('jk', "")
            ->with('id_fakultas', "")
            ->with('id_prodi', "")
            ->with('matkul', "")
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'dosen');
    }
    //***********************/
    public function fakultas()
    {
        return view('/welcome', )
            ->with('judul', 'TABEL FAKULTAS')
            ->with('fakultas', "")
            ->with('id_prodi', "")
            ->with('id_kaprodi', "")
            ->with('jenjang', "")
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'fakultas');
    }
    //***********************/
    public function addNewFakultas(Request $r)
    {
        $datafakultas = array(
            'fakultas' => $r->input('fakultas'),
            'id_prodi' => $r->input('id_prodi'),
            'id_kaprodi' => $r->input('id_kaprodi'),
            'jenjang' => $r->input('jenjang'),
        );

        if( $r->input('fakultasId') == ""  ){
            DB::table('tb_fakultas')->insert($datafakultas);            
        }else{          
            DB::table('tb_fakultas')->where('id', $r->input('fakultasId') )->update($datafakultas);
        }
        return redirect()->back();
    }
    //***********************/
    public function editfakultas($id)
    {
        $getFakultas = DB::table('tb_fakultas')->where('id', $id)->first();
        $datafakultas = array(
            'fakultas' => $getFakultas->fakultas,
            'id_prodi' => $getFakultas->id_prodi,
            'id_kaprodi' => $getFakultas->id_kaprodi,
            'jenjang' => $getFakultas->jenjang,
        );
        return view('/welcome', $datafakultas)
            ->with('judul', 'FAKULTAS')
            ->with('pesan', 'Edit Data Fakultas')
            ->with('content', 'fakultas');
    }
    //***********************/

    public function hapusfakultas($id)
    {
        $getFakultas = DB::table('tb_fakultas')->where('id', $id)->delete();
        return view('/welcome')
            ->with('judul', 'DATA FAKULTAS')
            ->with('fakultas', "")
            ->with('id_prodi', "")
            ->with('id_kaprodi', "")
            ->with('jenjang', "")
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'fakultas');
    }
    //***********************/
    public function prodi()
    {
        return view('/welcome', )
            ->with('judul', 'TABEL PROGRAM STUDI')
            ->with('idfak', "")
            ->with('kode', "")
            ->with('nm_prodi', "")
            ->with('id_kaprodi', "")
            ->with('id_jenjang', "")
            ->with('tglsk', "")
            ->with('akreditasi', "")
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'prodi');
    }
    //***********************/
    public function addNewProdi(Request $r)
    {
        $dataprodi = array(
            'idfak' => $r->input('idfak'),
            'kode' => $r->input('kode'),
            'nm_prodi' => $r->input('nm_prodi'),
            'id_kaprodi' => $r->input('id_kaprodi'),
            'id_jenjang' => $r->input('id_jenjang'),
            'tglsk' => $r->input('tglsk'),
            'akreditasi' => $r->input('akreditasi'),

        );
        if( $r->input('prodiId') == ""  ){
            DB::table('tb_prodi')->insert($dataprodi);            
        }else{          
            DB::table('tb_prodi')->where('id', $r->input('prodiId') )->update($dataprodi);
        }
        return redirect()->back();
    }

    //***********************/
    public function editprodi($id)
    {
        $getProdi = DB::table('tb_prodi')->where('id', $id)->first();
        $dataprodi = array(
            'idfak' => $getProdi->idfak,
            'kode' => $getProdi->kode,
            'nm_prodi' => $getProdi->nm_prodi,
            'id_kaprodi' => $getProdi->id_kaprodi,
            'id_jenjang' => $getProdi->id_jenjang,
            'tglsk' => $getProdi->tglsk,
            'akreditasi' => $getProdi->akreditasi,
        );
        return view('/welcome', $dataprodi)
            ->with('judul', 'PRODI')
            ->with('pesan', 'Edit Data Program Studi')
            ->with('content', 'prodi');
    }
    //***********************/
    public function hapusprodi($id)
    {
        $getProdi = DB::table('tb_prodi')->where('id', $id)->delete();
        return view('/welcome')
            ->with('judul', 'DATA PROGRAM STUDI')
            ->with('idfak', "")
            ->with('kode', "")
            ->with('nm_prodi', "")
            ->with('id_kaprodi', "")
            ->with('id_jenjang', "")
            ->with('tglsk', "")
            ->with('akreditasi', "")
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'prodi');
    }
    //***********************/

    public function thnakademik(Request $r)
    {
        $datathnakademik = array(
            'kode' => $r->input('kode'),
            'nama' => $r->input('nama'),
            'iddekan' => $r->input('iddekan'),
        );

        $nim_count = DB::table('thn_akademik')->where('kode', '=', $r->input('kode'))->count();
        if ($nim_count == 0 and $r->input('kode') != "") {
            DB::table('thn_akademik')->insert($datathnakademik);

        } else {

            DB::table('thn_akademik')->where('kode', $r->input('kode'))->update($datathnakademik);
        }
        ;
        return view('/welcome')
            ->with('judul', 'TAHUN AKADEMIK')
            ->with('kode', "")
            ->with('nama', "")
            ->with('iddekan', "")
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'thnakademik');
    }
    //***********************/
    public function editthnakademik($id)
    {
        $getthnakademik = DB::table('thn_akademik')->where('id', $id)->first();

        $datathnakademik = array(
            'kode' => $getthnakademik->kode,
            'nama' => $getthnakademik->nama,
            'iddekan' => $getthnakademik->iddekan,
        );

        return view('/welcome', $datathnakademik)
            ->with('judul', 'TAHUN AKADEMIK')
            ->with('pesan', 'Edit Data Mahasiswa')
            ->with('content', 'thnakademik');
    }
    //***********************/
    public function hapusthnakademik($id)
    {
        $getThn = DB::table('thn_akademik')->where('id', $id)->delete();
        return view('/welcome')
            ->with('judul', 'TAHUN AKADEMIK')
            ->with('kode', "")
            ->with('nama', "")
            ->with('iddekan', "")
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'thnakademik');
    }
    //***********************/


    public function transaksi(Request $r)
    {
        $datatransaksi = array(
            'nm_mhs' => $r->input('nm_mhs'),
            'nim' => $r->input('nim'),
            'id_prodi' => $r->input('id_prodi'),
            // 'id_matkul' => $r->input('id_matkul'),
        );

        $nim_count = DB::table('tb_mhs')->where('nim', '=', $r->input('nim'))->count();
        if ($nim_count == 0 and $r->input('nim') != "") {
            DB::table('tb_mhs')->insert($datatransaksi);

        } else {

            DB::table('tb_mhs')->where('nim', $r->input('nim'))->update($datatransaksi);
        }
        ;
        return view('/welcome')
            ->with('judul', 'FORMULIR TRANSAKSI')
            ->with('nmfak', "")
            ->with('nim', "")
            ->with('id_prodi', "")
            // ->with('id_matkul', "")
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'transaksi');
    }
    //***********************/
    public function edittransaksi($norec)
    {
        $getTransaksi = DB::table('tb_mhs')->where('norec', $norec)->first();
        $datatransaksi = array(
            'nama' => $getTransaksi->nama,
            'nim' => $getTransaksi->nim,
            'program' => $getTransaksi->program,
            // 'matkul' => $getTransaksi->matkul,
        );
        return view('/welcome', $datatransaksi)
            ->with('judul', 'FORMULIR TRANSAKSI')
            ->with('pesan', 'Edit Data Transaksi')
            ->with('content', 'transaksi');
    }
    //***********************/
    public function hapustransaksi($norec)
    {
        $getTransaksi = DB::table('tb_mhs')->where('norec', $norec)->delete();
        return view('/welcome')
            ->with('judul', 'FORMULIR TRANSAKSI')
            ->with('nama', "")
            ->with('nim', "")
            ->with('program', "")
            // ->with('matkul', "")
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'transaksi');
    }

    //***********************/

    public function jadwal()
    {
        return view('/welcome', )
            ->with('judul', 'TABEL JADWAL')
            ->with('hari', "")
            ->with('kelas', "")
            ->with('matkul', "")
            ->with('sks', "")
            ->with('ruang', "")
            ->with('dosen', "")
            ->with('prodi', "")
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'jadwal');
    }
    //***********************/
    public function addNewJadwal(Request $r)
    {
        $datajadwal = array(
            'hari' => $r->input('hari'),
            'kelas' => $r->input('kelas'),
            'matkul' => $r->input('matkul'),
            'sks' => $r->input('sks'),
            'ruang' => $r->input('ruang'),
            'dosen' => $r->input('dosen'),
            'prodi' => $r->input('prodi'),
        );
        DB::table('tb_jadwal')->insert($datajadwal);
        return redirect()->back();
    }
    //***********************/
    public function editjadwal($id)
    {
        $getJadwal = DB::table('tb_jadwal')->where('id', $id)->first();
        $datajadwal = array(
            'hari' => $getJadwal->hari,
            'kelas' => $getJadwal->kelas,
            'matkul' => $getJadwal->matkul,
            'sks' => $getJadwal->sks,
            'ruang' => $getJadwal->ruang,
            'dosen' => $getJadwal->dosen,
            'prodi' => $getJadwal->prodi,
        );
        return view('/welcome', $datajadwal)
            ->with('judul', 'FORMULIR JADWAL')
            ->with('pesan', 'Edit Data Jadwal')
            ->with('content', 'jadwal');
    }
    //***********************/
    public function hapusjadwal($id)
    {
        $getMhs = DB::table('tb_jadwal')->where('id', $id)->delete();
        return view('/welcome')
            ->with('judul', 'DATA JADWAL')
            ->with('hari', "")
            ->with('kelas', "")
            ->with('matkul', "")
            ->with('sks', "")
            ->with('ruang', "")
            ->with('dosen', "")
            ->with('prodi', "")
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'jadwal');
    }

    //***********************/
    public function hari(Request $r)
    {
        $datahari = array(
            'nm_hari' => $r->input('nm_hari'),
        );

        return view('/welcome', )
            ->with('judul', 'TABEL HARI')
            ->with('nm_hari', "")
            ->with('content', 'hari');
    }

    //***********************/
    public function jenjang(Request $r)
    {
        $datajenjang = array(
            'jenjang' => $r->input('jenjang'),
        );

        return view('/welcome', )
            ->with('judul', 'TABEL JENJANG')
            ->with('jenjang', "")
            ->with('content', 'jenjang');
    }

    //***********************/
    public function kelas(Request $r)
    {
        $datakelas = array(
            'kode' => $r->input('kode'),
            'nm_kls' => $r->input('nm_kls'),
        );

        return view('/welcome', )
            ->with('judul', 'TABEL KELAS')
            ->with('kode', "")
            ->with('nm_kls', "")
            ->with('content', 'kelas');
    }

    //***********************/
    public function ruang(Request $r)
    {
        $dataruang = array(
            'kode' => $r->input('kode'),
            'nm_ruang' => $r->input('nm_ruang'),
        );

        return view('/welcome', )
            ->with('judul', 'TABEL RUANG')
            ->with('kode', "")
            ->with('nm_ruang', "")
            ->with('content', 'ruang');
    }
    //***********************/
    public function matkul()
    {
        return view('/welcome', )
            ->with('judul', 'TABEL MATA KULIAH')
            ->with('id_fakultas', "")
            ->with('id_prodi', "")
            ->with('nm_matkul', "")
            ->with('kode', "")
            ->with('sks', "")
            ->with('id_dosen', '')
            ->with('pesan', 'Input Data Baru')
            ->with('content', 'matkul');

    }
    //***********************/
    public function addNewMatkul(Request $r)
    {
        $datamatkul = array(
            'id_fakultas' => $r->input('id_fakultas'),
            'id_prodi' => $r->input('id_prodi'),
            'nm_matkul' => $r->input('nm_matkul'),
            'kode' => $r->input('kode'),
            'sks' => $r->input('sks'),
            'id_dosen' => $r->input('id_dosen'),
        );
        DB::table('tb_matkull')->insert($datamatkul);
        return redirect()->back();
    }
    //***********************/
    public function editmatkul($norec)
    {
        $getMatkul = DB::table('tb_matkull')->where('norec', $norec)->first();
        $datamatkul = array(
            'id_fakultas' => $getMatkul->id_fakultas,
            'id_prodi' => $getMatkul->id_prodi,
            'nm_matkul' => $getMatkul->nm_matkul,
            'kode' => $getMatkul->kode,
            'sks' => $getMatkul->sks,
            'id_dosen' => $getMatkul->id_dosen,
        );
        return view('/welcome', $datamatkul)
            ->with('judul', 'MATA KULIAH')
            ->with('pesan', 'Edit Data Mata Kuliah')
            ->with('content', 'matkul');
    }
    //***********************/

    public function hapusmatkul($norec)
    {
        $getMatkul = DB::table('tb_matkull')->where('norec', $norec)->delete();
        return view('/welcome')
            ->with('judul', 'DATA MATA KULIAH')
            ->with('id_fakultas', "")
            ->with('id_prodi', "")
            ->with('nm_matkul', "")
            ->with('kode', "")
            ->with('sks', "")
            ->with('id_dosen', '')
            ->with('pesan', "1 Record dihapus")
            ->with('content', 'matkul');
    }

    public function perkalian()
    {
        return view('perkalian');
    }
    public function penjumlahan()
    {
        return view('penjumlahan');
    }
    public function daftarbarang()
    {
        return view('daftarbarang');
    }
    public function pmb()
    {
        return view('pmb');
    }

    public function perkalian2(Request $r)
    {
        $a = $r->a;
        $b = $r->b;
        $hasil = $a * $b;
        return view('perkalian')
            ->with('hasil', $hasil)
            ->with('a', $a)
            ->with('b', $b);
    }

    public function berita(Request $r)
    {
        $idberita = $r->idberita;
        $judul = $r->judul;

        return view('berita')
            ->with('idberita', $idberita)
            ->with('judul', $judul)
        ;
    }

    public function penjumlahan2(Request $r)
    {
        $a = $r->a;
        $b = $r->b;
        $hasil = $a + $b;
        return view('penjumlahan')
            ->with('hasil', $hasil)
            ->with('a', $a)
            ->with('b', $b);
    }

    public function pmb2(Request $r)
    {
        $now = Carbon::now();
        $hari = $now->day;
        $menit = $now->minute;
        $bulan = $now->month;
        $detik = $now->second;
        $tahun = $now->year;

        $nopendaftaran = $tahun . $bulan . $hari . $menit . $detik;
        $nama = $r->input('nama');
        $sekolah = $r->input('sekolah');
        $nilai = $r->input('nilai');
        $jurusan = $r->input('jurusan');

        return view('/datapmb', compact('nopendaftaran', 'nama', 'sekolah', 'nilai', 'jurusan'));
    }

    public function datapmb()
    {
        return view('datapmb');
    }

    // public function dosen(){
    //     $data = array( 
    //         "nama" => "",
    //         "nidn" => "", 
    //         "program" => "", 
    //         "matkul" => ""    
    //     ); 

    //   return view ('dosen',$data);
    // }


    // public function dosen2(Request $r)
    // {
    //     $nama="";
    //     $nidn="";
    //     $program="";
    //     $matkul="";

    //     return view('/dosen', compact('nama', 'nidn', 'program', 'matkul'));
    // }

    // public function datadosen(){
    //     return view ('datadosen');
    // }

    // public function store(Request $r)
    // {
    //     $x=array(
    //         'nama'=>$r->input('nama'),
    //         'nidn'=>$r->input('nidn'),
    //         'program'=>$r->input('program'),
    //         'matkul'=>$r->input('matkul'),
    //     );


    // $nidn_count = DB::table('tb_dosenn')
    //  ->where('nidn', '=', $r->input('nidn') )
    //  ->count();
    //      if($nidn_count == 0 and $r->input('nidn') != "" ){
    //         DB::table('tb_dosenn')->insertgetId($x); 

    //            }else{
    //                DB::table('tb_dosenn')->where('nidn', $r->input('nidn') )->update($x);  
    //            };

    //         return view ('/dosen')
    //             ->with('judul','Daftar Dosen')
    //             ->with('pesan','')
    //             ->with('nama','')
    //             ->with('nidn','')
    //             ->with('program','')
    //             ->with('matkul','')
    //             ;
    // }

    // public function editdosen( $norec)
    // {


    //    $getdosen =DB::table('tb_dosenn')->where('norec', $norec)->first();

    //     $x=array(
    //         'nama'=> $getdosen->nama,
    //         'nidn'=>$getdosen->nidn,
    //         'program'=>$getdosen->program,
    //         'matkul'=>$getdosen->matkul,
    //     );

    //         return view ('/dosen',$x)
    //         ->with('judul','FORMULIR DOSEN')
    //             ->with('pesan','Edit Data Dosen')
    //             ;
    // }

    // public function hapusdosen( $norec)
    // {
    //         $getMhs =DB::table('tb_dosenn')->where('norec', $norec)->delete();



    //         return view ('/dosen'  )
    //         ->with('judul','FORMULIR DOSEN')
    //         ->with('nama',"")
    //         ->with('nidn', "" )
    //         ->with('program',"")
    //         ->with('matkul', "" )
    //         ->with('pesan', "1 Record dihapus" )
    //        ;    
    // }

    // public function matkul(Request $r)
    // {
    //     $datamatkul = array(
    //         'nama' => $r->input('namamatkul'),
    //         'kode' => $r->input('kode'),
    //         'sks' => $r->input('sks'),
    //         'jurusan' => $r->input('jurusan'),
    //         'dsnpengampu' => $r->input('dsnpengampu'),
    //     );


    //     $kode_count = DB::table('tb_matkull')->where('kode', '=', $r->input('kode'))->count();
    //     if ($kode_count == 0 and $r->input('kode') != "") {
    //         DB::table('tb_matkull')->insert($datamatkul);

    //     } else {

    //         DB::table('tb_matkull')->where('kode', $r->input('kode'))->update($datamatkul);

    //     }
    //     ;

    //     return view('/matkul')
    //         ->with('judul', 'FORMULIR MATA KULIAH')
    //         ->with('pesan', 'Edit Data Mata Kuliah')
    //         ->with('nama', '')
    //         ->with('kode', '')
    //         ->with('sks', '')
    //         ->with('jurusan', '')
    //         ->with('dsnpengampu', '')
    //     ;
    // }

    // public function editmatkul($norec)
    // {


    //     $getMatkul = DB::table('tb_matkull')->where('norec', $norec)->first();

    //     $datamatkul = array(
    //         'nama' => $getMatkul->nama,
    //         'kode' => $getMatkul->kode,
    //         'sks' => $getMatkul->sks,
    //         'jurusan' => $getMatkul->jurusan,
    //         'dsnpengampu' => $getMatkul->dsnpengampu,
    //     );

    //     return view('/matkul', $datamatkul)
    //         ->with('judul', 'FORMULIR MATA KULIAH')
    //         ->with('pesan', 'Edit Data Mata Kuliah')
    //     ;
    // }

    // public function hapusmatkul($norec)
    // {
    //     $getMatkul = DB::table('tb_matkull')->where('norec', $norec)->delete();



    //     return view('/matkul')
    //         ->with('judul', 'FORMULIR MAHASISWA')
    //         ->with('nama', "")
    //         ->with('kode', "")
    //         ->with('sks', "")
    //         ->with('jurusan', "")
    //         ->with('dsnpengampu', "")
    //         ->with('pesan', "1 Record dihapus")
    //     ;
    // }



    public function show($norec)
    {

        return view('editdelete.formedit')
            ->with('judul', 'Form Edit Mahasiswa')
            ->with('id', $norec)
        ;
    }

    public function update(Request $r)
    {
        $x = array(
            'nim' => $r->nim,
            'nama' => $r->nama,
            'alamat' => $r->alamat,
            'nohp' => $r->nohp,
        );
        DB::table('tb_mhs')
            ->where('id', $r->norec)
            ->update($x);

        return view('mahasiswa.list')
            ->with('judul', 'Daftar Mahasiswa')
        ;
    }
}
