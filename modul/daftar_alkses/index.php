  <?php
  error_reporting(0); 
  $carikode = mysqli_query($konek, "select max(kode) from tbl_daftar") or die (mysql_error());
  $datakode = mysqli_fetch_array($carikode);
  if ($datakode) {
   $nilaikode = substr($datakode[0], 1);
   $kode = (int) $nilaikode;
   $kode = $kode + 1;
   $kode_otomatis = "A".str_pad($kode, 5, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "A00001";
  }



  ?>

           <!-- UNTUK MODAL -->
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button> <BR>
                <h4 class="modal-title">DAFTAR ALKES</h4>
              </div>
               <form class="form-horizontal" method="POST" action="">
              <div class="modal-body">
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kode</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="uraian" value="<?php echo $kode_otomatis ?>" name="txtkode" placeholder="Kode" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
                  <div class="col-sm-10">
                        <select name="cbjenis" class="form-control select2" style="width: 100%;">
                                    <?php
                                      $qry = mysqli_query($konek,"select * from tbl_jenis"); 
                                      while ($d=mysqli_fetch_array($qry)) { ?>
                                      <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['uraian']; ?>
                                      </option>
                                    <?php } ?>
                        </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Satuan</label>
                  <div class="col-sm-10">
                        <select name="cbsatuan" class="form-control select2" style="width: 100%;">
                                    <?php
                                      $qry = mysqli_query($konek,"select * from tbl_satuan"); 
                                      while ($d=mysqli_fetch_array($qry)) { ?>
                                      <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['uraian']; ?>
                                      </option>
                                    <?php } ?>
                        </select>
                  </div>
                </div>




                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Alkes</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="uraian" name="txturaian" placeholder="Uraian" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <input type="submit" name="btnsimpan" class="btn btn-primary pull-right" value="Simpan">
              </div>
            </div>
          </form>
          </div>
        </div>
                     <?php
                              if (isset($_POST["btnsimpan"])){
                                $txturaian =$_POST['txturaian'];
                                $txtkode =$_POST['txtkode'];
                                $cbsatuan =$_POST['cbsatuan'];
                                $cbjenis =$_POST['cbjenis'];

                                  $simpan = mysqli_query($konek,"INSERT INTO tbl_daftar (kode,uraian,kode_jenis,kode_satuan) VALUES ('$txtkode','$txturaian','$cbjenis','$cbsatuan')");
                                if ($simpan){
                                  ?>
                                  <script type="text/javascript">
                                    document.location.href="beranda.php?page=daftar_alkses";
                                  </script>
                                  <?php
                                }else{
                                 echo "<script>alert('Data Anda Gagal di simpan')</script>";
                                 echo "<meta http-equiv='refresh' content='0; url=?page=daftar_alkses'>";
                                }
                                }
                                ?>

  <div class="col-md-12">    
          <div class="box box-info">
            <div class="box-header with-border">
              <a class="btn btn-app"  data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-edit"></i>Tambah Data
              </a>
               <br>
                <h3 class="box-title">DAFTAR ALKES</h3>   
            </div>
               <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>NAMA ALKES</th>
                  <th>SATUAN</th>
                  <th>JENIS</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>

                  <?php
                            $no =1;
                              $qry = mysqli_query($konek,"select `tbl_daftar`.`uraian` AS `daftar`,`tbl_satuan`.`uraian` AS `satuan`,`tbl_jenis`.`uraian` AS `jenis`,`tbl_daftar`.`kode` AS `kode`,`tbl_daftar`.`kode_jenis` AS `kode_jenis`,`tbl_daftar`.`kode_satuan` AS `kode_satuan` from ((`tbl_daftar` join `tbl_satuan` on((`tbl_satuan`.`kode` = `tbl_daftar`.`kode_satuan`))) join `tbl_jenis` on((`tbl_jenis`.`kode` = `tbl_daftar`.`kode_jenis`)))");
                                while ($data=mysqli_fetch_array($qry)) {
                          ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['daftar']; ?></td>
                        <td><?php echo $data['satuan']; ?></td>
                        <td><?php echo $data['jenis']; ?></td>
                      
                       <td> <a href="beranda.php?page=edit_alkes&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-edit">Edit</a>
                       <a onClick="return confirm('Yakin Anda Menghapus ?')" href="beranda.php?page=daftar_alkses&hapus=<?php echo $data['kode']; ?>" class="fa fa-eraser">Hapus</a></td>
                    </tr>
                  <?php } ?>
                  </tfoot>
              </table>
                </div>
              </div>

    </div>
  </div>


<?php
if (isset($_GET[hapus])){
  $qry=mysqli_query($konek,"delete from tbl_daftar where kode='".$_GET["hapus"]."'");
  if ($qry){
    echo "<script>alert('Data Berhasil di Hapus')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=daftar_alkses'>";
    } else {
        Echo "Gagal di Hapus".mysqli_error();
        echo "<meta http-equiv='refresh' content='0; url=?page=daftar_alkses'>";
    }
  }
?>
