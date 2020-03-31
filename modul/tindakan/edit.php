<?php
error_reporting();
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek,"SELECT * FROM tbl_tindakan WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
?>
<div class="col-md-12">    
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data</h3>
            </div>
               <form class="form-horizontal" method="POST" action="">
               <div class="modal-body">
                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Uraian</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="uraian" name="txttindakan" value="<?php echo $data['uraian']; ?>" placeholder="Tanggal" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="uraian" name="txtjumlah" value="<?php echo $data['jumlah']; ?>" placeholder="Jumlah / Tindakan" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <input type="submit" name="btnedit" class="btn btn-primary pull-right" value="Simpan">
              </div>
            </div>
            </form>

         <?php
          if (isset($_POST["btnedit"])){
                                    $txttindakan =$_POST['txttindakan'];
                                    $txtjumlah =$_POST['txtjumlah'];

            $edit = mysqli_query($konek,"UPDATE  tbl_tindakan SET harga='$txtjumlah',uraian='$txttindakan' WHERE kode='$id'");
            if ($edit)
            {
              ?>
              <script type="text/javascript">
                document.location.href="beranda.php?page=tindakan";
              </script>
              <?php
            }else{
             echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=tindakan'>";
            }
          }
        ?>
          </div>
    </div>
