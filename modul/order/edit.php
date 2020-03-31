<?php
error_reporting();
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek,"SELECT * FROM tbl_permintaan WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
$daftar=$data['kode_alkes'];
?>
<div class="col-md-12">    
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Data</h3>
            </div>
               <form class="form-horizontal" method="POST" action="">
               <div class="modal-body">
                

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="uraian" name="txttanggal" value="<?php echo $data['tanggal']; ?>" placeholder="Tanggal" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="uraian" name="txtjumlah" value="<?php echo $data['jumlah']; ?>" placeholder="Jumlah" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>





                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Alkes</label>
                  <div class="col-sm-10">
                        <select name="cbalkes" class="form-control select2" style="width: 100%;">
                      <?php
                        $qry = mysqli_query($konek,"SELECT * from tbl_daftar"); 
                        while ($data=mysqli_fetch_array($qry)) 
                        {
                        ?>
                        <option class="form-control" value="<?php echo $data["kode"]; ?>" <?php 
                            if($daftar==$data['kode']){echo "selected";} ?>> <?php echo $data['uraian']; ?></option><?php
                        }
                      ?>
                        </select>
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
                                  $cbalkes =$_POST['cbalkes'];
                                    $txttanggal =$_POST['txttanggal'];
                                      $txtjumlah =$_POST['txtjumlah'];

            $edit = mysqli_query($konek,"UPDATE  tbl_permintaan SET jumlah='$txtjumlah',tanggal='$txttanggal',kode_alkes='$cbalkes' WHERE kode='$id'");
            if ($edit)
            {
              ?>
              <script type="text/javascript">
                document.location.href="beranda.php?page=order";
              </script>
              <?php
            }else{
             echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=order'>";
            }
          }
        ?>
          </div>
    </div>
