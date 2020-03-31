<?php
error_reporting();
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek,"SELECT * FROM tbl_daftar WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
$jenis=$data['kode_jenis'];
$satuan=$data['kode_satuan'];
?>
<div class="col-md-12">    
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Satuan</h3>
            </div>
               <form class="form-horizontal" method="POST" action="">
               <div class="modal-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Uraian</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="uraian" name="txturaian" value="<?php echo $data['uraian']; ?>" placeholder="Uraian" required oninvalid="this.setCustomValidity('Tidak Boleh Kosong')" oninput="setCustomValidity('')" />
                  </div>
                </div>


                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Satuan</label>
                  <div class="col-sm-10">
                        <select name="cbsatuan" class="form-control select2" style="width: 100%;">
                      <?php
                        $qry = mysqli_query($konek,"SELECT * from tbl_satuan"); 
                        while ($data=mysqli_fetch_array($qry)) 
                        {
                        ?>
                        <option class="form-control" value="<?php echo $data["kode"]; ?>" <?php 
                            if($satuan==$data['kode']){echo "selected";} ?>> <?php echo $data['uraian']; ?></option><?php
                        }
                      ?>
                        </select>
                  </div>
                </div>


                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
                  <div class="col-sm-10">
                        <select name="cbjenis" class="form-control select2" style="width: 100%;">
                      <?php
                        $qry = mysqli_query($konek,"SELECT * from tbl_jenis"); 
                        while ($data=mysqli_fetch_array($qry)) 
                        {
                        ?>
                        <option class="form-control" value="<?php echo $data["kode"]; ?>" <?php 
                            if($jenis==$data['kode']){echo "selected";} ?>> <?php echo $data['uraian']; ?></option><?php
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
            $txturaian =$_POST['txturaian'];
             $cbjenis =$_POST['cbjenis'];
             $cbsatuan =$_POST['cbsatuan'];
            $edit = mysqli_query($konek,"UPDATE  tbl_daftar SET uraian='$txturaian',kode_satuan='$cbsatuan',kode_jenis='$cbjenis' WHERE kode='$id'");
            if ($edit)
            {
              ?>
              <script type="text/javascript">
                document.location.href="beranda.php?page=daftar_alkses";
              </script>
              <?php
            }else{
             echo "<script>alert('Terjadi Kesalahan Inputan')</script>";
        echo "<meta http-equiv='refresh' content='0; url=?page=daftar_alkses'>";
            }
          }
        ?>
          </div>
    </div>
