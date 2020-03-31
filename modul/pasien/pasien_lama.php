<?php
  error_reporting(0); 
  $carikode = mysqli_query($konek, "select max(kode) from tbl_kunjungan") or die (mysql_error());
  $datakode = mysqli_fetch_array($carikode);
  if ($datakode) {
   $nilaikode = substr($datakode[0], 1);
   $kode = (int) $nilaikode;
   $kode = $kode + 1;
   $kode_otomatis = "K".str_pad($kode, 5, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "K00001";
  }
  ?>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">REGISTRASI KUNJUNGAN PASIEN</h4>
              </div>
           <form class="form-horizontal" method="POST" action="">
              <div class="modal-body">
                <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <!-- <li class="active"><a href="#tab_1" data-toggle="tab">FORM KUNJUNGAN</a></li> -->
             
            </ul>
            <div class="tab-content">
              <!-- Tab I -->
              <div class="tab-pane active" id="tab_1">
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No.Kunjungan</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="uraian" value="<?php echo $kode_otomatis ?>"  name="txtkode" onkeypress="return hanyaAngka(event)" placeholder="Rekam Medis" required oninvalid="this.setCustomValidity('No.Registrasi Ini tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Pasien</label>
                  <div class="col-sm-10">
                        <select name="cbpasien" class="form-control select2" style="width: 100%;">
                                    <?php
                                      $qry = mysqli_query($konek,"select * from tbl_pasien"); 
                                      while ($d=mysqli_fetch_array($qry)) { ?>
                                      <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['kode']; ?> | <?php echo $d['nama']; ?>
                                      </option>
                                    <?php } ?>
                        </select>
                  </div>
                </div>


                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Dokter</label>
                  <div class="col-sm-10">
                        <select name="cbdokter" class="form-control select2" style="width: 100%;">
                                    <?php
                                      $qry = mysqli_query($konek,"select `tbl_pegawai`.`kode` AS `kode`,`tbl_pegawai`.`kode_spesialis` AS `kode_spesialis`,`tbl_pegawai`.`kode_pekerjaan` AS `kode_pekerjaan`,`tbl_pegawai`.`kode_pendidikan` AS `kode_pendidikan`,`tbl_pegawai`.`kode_jabatan` AS `kode_jabatan`,`tbl_pegawai`.`nip` AS `nip`,`tbl_pegawai`.`nama` AS `nama`,`tbl_pegawai`.`tempat_lahir` AS `tempat_lahir`,`tbl_pegawai`.`tgl_lahir` AS `tgl_lahir`,`tbl_pegawai`.`jenis_kelamin` AS `jenis_kelamin`,`tbl_pegawai`.`email` AS `email`,`tbl_pegawai`.`handphone` AS `handphone`,`tbl_pegawai`.`password` AS `password`,`tbl_pegawai`.`keterangan` AS `keterangan`,`tbl_pegawai`.`gambar` AS `gambar`,`tbl_pegawai`.`hari_senin` AS `hari_senin`,`tbl_pegawai`.`hari_selasa` AS `hari_selasa`,`tbl_pegawai`.`hari_rabu` AS `hari_rabu`,`tbl_pegawai`.`hari_kamis` AS `hari_kamis`,`tbl_pegawai`.`hari_jumat` AS `hari_jumat`,`tbl_pegawai`.`hari_sabtu` AS `hari_sabtu`,`tbl_pegawai`.`hari_minggu` AS `hari_minggu`,`tbl_pegawai`.`tgl_update` AS `tgl_update`,`tbl_pekerjaan`.`uraian` AS `pekerjaan`,`tbl_pendidikan`.`uraian` AS `pendidikan`,`tbl_spesialis`.`uraian` AS `spesialis`,`tbl_jabatan`.`uraian` AS `jabatan` from ((((`tbl_jabatan` join `tbl_pegawai` on((`tbl_pegawai`.`kode_jabatan` = `tbl_jabatan`.`kode`))) join `tbl_pendidikan` on((`tbl_pegawai`.`kode_pendidikan` = `tbl_pendidikan`.`kode`))) join `tbl_pekerjaan` on((`tbl_pegawai`.`kode_pekerjaan` = `tbl_pekerjaan`.`kode`))) join `tbl_spesialis` on((`tbl_pegawai`.`kode_spesialis` = `tbl_spesialis`.`kode`))) where ((`tbl_jabatan`.`uraian` = 'Dokter Umum') or (`tbl_jabatan`.`uraian` = 'Dokter Spesialis')) order by `tbl_pegawai`.`kode` desc"); 
                                      while ($d=mysqli_fetch_array($qry)) { ?>
                                      <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['nama']; ?> | <?php echo $d['spesialis']; ?>
                                      </option>
                                    <?php } ?>
                        </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">C.Bayar</label>
                  <div class="col-sm-10">
                        <select name="cbcarabayar" class="form-control select2" style="width: 100%;">
                                    <?php
                                      $qry = mysqli_query($konek,"select * from tbl_cara_bayar"); 
                                      while ($d=mysqli_fetch_array($qry)) { ?>
                                      <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['uraian']; ?> 
                                      </option>
                                    <?php } ?>
                        </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tgl.Kunjungan</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="uraian" name="txttanggal" placeholder="Tgl Kunjungan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Keluhan</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="txtkeluhan" placeholder="Keluhan Pasien"></textarea>
                  </div>
                </div>
              </div>

              
              </div>
            
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary right" data-dismiss="modal">Close</button>
                <input type="submit" name="btnsimpan" class="btn btn-primary pull-right" value="Simpan">
              </div>
            </div>
          </form>
          </div>
        </div>
      <!-- AKHIR MODAL -->
                     <?php
                            if (isset($_POST["btnsimpan"])){
                                $txtkode =$_POST['txtkode'];
                                $cbpasien =$_POST['cbpasien'];
                                $cbdokter =$_POST['cbdokter'];
                                $cbcarabayar =$_POST['cbcarabayar'];
                                $txttanggal =$_POST['txttanggal'];
                                $txtkeluhan =$_POST['txtkeluhan'];
                                $txtkode =$_POST['txtkode'];
                                // $tgl_registrasi = date("Y-m-d H:i:s"); 

                          $cek_user = mysqli_num_rows(mysqli_query($konek,"select * from tbl_kunjungan where kode = '$txtkode'"));
                          if ($cek_user > 0) {
                            echo "<script>alert('Maaf Kode Kunjungan Sudah di Gunakan')</script>";
                          }else {
                      $simpan = mysqli_query($konek,"INSERT INTO tbl_kunjungan (kode,kode_pasien,kode_dokter,kode_bayar,tgl_kunjungan,keluhan) VALUES ('$txtkode','$cbpasien','$cbdokter','$cbcarabayar','$txttanggal','$txtkeluhan')");
                       if ($simpan){
                          ?>
              <script type="text/javascript">
                document.location.href="beranda.php?page=pasien_lama";
              </script>
                          <?php
                          }else{
                         echo "<script>alert('Gagal di simpan)</script>";
                        }
                      }
                    } 
                      ?>
<!-- Untuk Tabel  -->
      <div class="col-md-12">    
          <div class="box box-info">
            <div class="box-header with-border">
              <a class="btn btn-app"  data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-edit"></i>Tambah
              </a>

              <a href="beranda.php?page=pasien_lama" class="btn btn-app">
                <i class="fa fa-repeat"></i>Refresh
              </a>

              <a href="beranda.php?page=beranda" class="btn btn-app">
                <i class="fa fa-home"></i>Beranda
              </a>

            </div>
           
      </div>
    </div>
  </div>

<!--AWAL UNTUK DATA TABEL  -->
<div class="box">
            <div class="box-header">
              <h3 class="box-title">DAFTAR KUNJUNGAN PASIEN</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <!-- <div class="box-body table-responsive no-padding"> -->
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>TGL KUNJUNGAN</th>
                  <th>RM</th>
                  <th>NAMA PASIEN</th>
                  <th>NAMA DOKTER</th>
                  <th align="right">ACTION</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    // $no =1;
                    $qry = mysqli_query($konek,"select `tbl_kunjungan`.`kode` AS `kode`,`tbl_kunjungan`.`kode_pasien` AS `kode_pasien`,`tbl_kunjungan`.`kode_dokter` AS `kode_dokter`,`tbl_kunjungan`.`kode_bayar` AS `kode_bayar`,`tbl_kunjungan`.`tgl_kunjungan` AS `tgl_kunjungan`,`tbl_kunjungan`.`keluhan` AS `keluhan`,`tbl_kunjungan`.`verifikasi` AS `verifikasi`,`tbl_pasien`.`nama` AS `nama`,`tbl_pegawai`.`nama` AS `dokter` from ((`tbl_kunjungan` join `tbl_pasien` on((`tbl_pasien`.`kode` = `tbl_kunjungan`.`kode_pasien`))) join `tbl_pegawai` on((`tbl_pegawai`.`kode` = `tbl_kunjungan`.`kode_dokter`))) order by `tbl_kunjungan`.`tgl_kunjungan`");
                    while ($data=mysqli_fetch_array($qry)) {
                ?>
                <tr>
                  <!-- <td><?php echo $no++; ?></td> -->
                  <td><?php echo $data['tgl_kunjungan'];?></td>
                   <td><?php echo $data['kode'];?>  </td> 
                    <!-- <a class="btn btn-danger btn-xs"><?php echo $data['nik_ktp'];?></a> -->
                  <td><?php echo $data['nama'];?></td>
                  <td><?php echo $data['dokter'];?></td>
                  <td align="right">  
                   
                    <a href="beranda.php?page=edit_lama&id=<?php echo base64_encode($data['kode']); ?>"><button  class="btn btn-primary fa fa-edit"> Edit</button></a>
                    <a  onClick="return confirm('Yakin Anda Menghapus ?')" href="beranda.php?page=pasien_lama&hapus=<?php echo $data['kode']; ?>"><button  class="btn btn-primary fa fa-cut"> Hapus</button></a>

                     <!-- <a href="beranda.php?page=detail_jadwal&id=<?php echo base64_encode($data['kode']); ?>"><button  class="btn btn-primary fa fa-print"> Cetak</button></a> -->


                </tr>
              <?php } ?>
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
<?php
if (isset($_GET[hapus])){
  $qry=mysqli_query($konek,"delete from tbl_kunjungan where kode='".$_GET["hapus"]."'");
  if ($qry){
    echo "<script>alert('Data Berhasil di Hapus')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=pasien_lama'>";
    } else {
        Echo "Gagal di Hapus".mysqli_error();
        echo "<meta http-equiv='refresh' content='0; url=?page=pasien_lama'>";
    }
  }
?>
