  <?php
  error_reporting(0); 
  $carikode = mysqli_query($konek, "select max(kode) from tbl_permintaan") or die (mysql_error());
  $datakode = mysqli_fetch_array($carikode);
  if ($datakode) {
   $nilaikode = substr($datakode[0], 1);
   $kode = (int) $nilaikode;
   $kode = $kode + 1;
   $kode_otomatis = "P".str_pad($kode, 5, "0", STR_PAD_LEFT);
  } else {
   $kode_otomatis = "P00001";
  }
  ?>
           <!-- UNTUK MODAL -->
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button> <BR>
                <h4 class="modal-title">DAFTAR PERMINTAAN ALKES</h4>
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Alkes</label>
                  <div class="col-sm-10">
                        <select name="cbalkes" class="form-control select2" style="width: 100%;">
                                    <?php
                                      $qry = mysqli_query($konek,"select * from tbl_daftar"); 
                                      while ($d=mysqli_fetch_array($qry)) { ?>
                                      <option class="form-control" value="<?php echo $d["kode"]; ?>"><?php echo $d['uraian']; ?>
                                      </option>
                                    <?php } ?>
                        </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="uraian" name="txttaggal"  required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="uraian" name="txtjumlah" placeholder="Jumlah" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
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
                                $txtkode =$_POST['txtkode'];
                                  $cbalkes =$_POST['cbalkes'];
                                    $txttaggal =$_POST['txttaggal'];
                                      $txtjumlah =$_POST['txtjumlah'];

                                  $simpan = mysqli_query($konek,"INSERT INTO tbl_permintaan (kode,kode_alkes,tanggal,jumlah) VALUES ('$txtkode','$cbalkes','$txttaggal','$txtjumlah')");
                                if ($simpan){
                                  ?>
                                  <script type="text/javascript">
                                    document.location.href="beranda.php?page=order";
                                  </script>
                                  <?php
                                }else{
                                 echo "<script>alert('Data Anda Gagal di simpan')</script>";
                                 echo "<meta http-equiv='refresh' content='0; url=?page=order'>";
                                }
                                }
                                ?>

  <div class="col-md-12">    
          <div class="box box-info">
            <div class="box-header with-border">
              <a class="btn btn-app"  data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-edit"></i>Add Permintaan
              </a>
               <br>
                <h3 class="box-title">DAFTAR PERMINTAAN ALKES (LOGISTIK)</h3>   
            </div>
               <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>URAIAN PERMINTAAN</th>
                  <th>JUMLAH</th>
                  <th>TANGGAL</th>
                  <th>ACTION</th>
                </tr>
                </thead>
                <tbody>

                  <?php
                            $no =1;
                              $qry = mysqli_query($konek,"select `tbl_permintaan`.`kode` AS `kode`,`tbl_permintaan`.`kode_alkes` AS `kode_alkes`,`tbl_permintaan`.`tanggal` AS `tanggal`,`tbl_permintaan`.`jumlah` AS `jumlah`,`tbl_daftar`.`uraian` AS `uraian` from (`tbl_permintaan` join `tbl_daftar` on((`tbl_daftar`.`kode` = `tbl_permintaan`.`kode_alkes`)))");
                                while ($data=mysqli_fetch_array($qry)) {
                          ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['uraian']; ?></td>
                        <td><?php echo $data['jumlah']; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                      
                       <td> <a href="beranda.php?page=edit_order&id=<?php echo base64_encode($data['kode']); ?>" class="fa fa-edit">Edit</a>
                       <a onClick="return confirm('Yakin Anda Menghapus ?')" href="beranda.php?page=order&hapus=<?php echo $data['kode']; ?>" class="fa fa-eraser">Hapus</a></td>
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
  $qry=mysqli_query($konek,"delete from tbl_permintaan where kode='".$_GET["hapus"]."'");
  if ($qry){
    echo "<script>alert('Data Berhasil di Hapus')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=order'>";
    } else {
        Echo "Gagal di Hapus".mysqli_error();
        echo "<meta http-equiv='refresh' content='0; url=?page=order'>";
    }
  }
?>
