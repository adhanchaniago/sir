<?php
 error_reporting(0);
?>

<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>


<div class="col-md-12">    
          <div class="box box-info">
            <!-- <div class="box-header with-border"> -->
              <div class="modal-content">
              <div class="modal-header">
               <a href="beranda.php?page=lap_radiologi"> <button class="btn btn-primary large fa fa-refresh"> Refresh</button></a>

                 <button class="btn btn-primary large fa fa-print" onclick="printContent('cetak_report')"> Print</button>

                <!-- <h4 class="modal-title">Hasil Radiologi</h4> -->
              </div>

<div class="well well-sm noprint">
  <form class="form-inline" role="form" method="post" action="">
    <div class="form-group">
      <label class="sr-only" for="tgl1">Mulai</label>
      <input type="date" class="form-control" id="tgl1" name="tgl1" required>
    </div>
    <div class="form-group">
      <label class="sr-only" for="tgl2">Hingga</label>
      <input type="date" class="form-control" id="tgl2" name="tgl2" required>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Tampilkan</button>
  </form>
  </div>


              
              <div class="modal-body" id="cetak_report">
                       <style type="text/css">
                      #customers {
                        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                      }

                      #customers td, #customers th {
                        border: 1px solid #ddd;
                        padding: 8px;
                      }

                      #customers tr:nth-child(even){background-color: #f2f2f2;}

                      #customers tr:hover {background-color: #ddd;}

                      #customers th {
                        padding-top: 12px;
                        padding-bottom: 12px;
                        text-align: left;
                        background-color: #4CAF50;
                        color: white;
                      }
                      </style>
                </style>
                <center><H3> LAPORAN PERMINTAAN ALKES <br> RS MUJI RAHAYU </H3></center>




                   <table id="customers" width="100%" border="1">
                  <tr>
                    <th width="4%" align="center">NO</th>
                    <th width="8%" align="center">KODE PERMINTAAN</th>
                    <th width="5%" align="center">KODE ALKES</th>
                    <th align="center">PERMINTAAN</th>
                    <th width="5%" align="center">JUMLAH</th>
                    <th width="10%" align="center">TANGGAL</th>
                  </tr>


                <?php
                $no = 1;
                  if(isset($_REQUEST['submit'])){
                   $submit = $_REQUEST['submit'];
                   $tgl1 = $_REQUEST['tgl1'];
                   $tgl2 = $_REQUEST['tgl2'];
                      $select = mysqli_query($konek, "select `tbl_permintaan`.`kode` AS `kode`,`tbl_permintaan`.`kode_alkes` AS `kode_alkes`,`tbl_permintaan`.`tanggal` AS `tanggal`,`tbl_permintaan`.`jumlah` AS `jumlah`,`tbl_daftar`.`uraian` AS `uraian` from (`tbl_permintaan` join `tbl_daftar` on((`tbl_daftar`.`kode` = `tbl_permintaan`.`kode_alkes`))) WHERE tanggal BETWEEN '$tgl1' AND '$tgl2'");

                        }else {
                           $select = mysqli_query($konek,"select `tbl_permintaan`.`kode` AS `kode`,`tbl_permintaan`.`kode_alkes` AS `kode_alkes`,`tbl_permintaan`.`tanggal` AS `tanggal`,`tbl_permintaan`.`jumlah` AS `jumlah`,`tbl_daftar`.`uraian` AS `uraian` from (`tbl_permintaan` join `tbl_daftar` on((`tbl_daftar`.`kode` = `tbl_permintaan`.`kode_alkes`)))");
                           }
                         
                        if(mysqli_num_rows($select)){
                            while ($data=mysqli_fetch_array($select)){
                    ?>


                  


                  <tr>
                    <td align="center"><?php echo $no++; ?></td>
                    <td align="center"><?php echo $data['kode']; ?></td>
                    <td align="center"><?php echo $data['kode_alkes']; ?></td>
                    <td><?php echo $data['uraian']; ?></td>
                    <td align="center"><?php echo $data['jumlah']; ?></td>
                    <td align="center"><?php echo $data['tanggal']; ?></td>
                  
                  </tr>
             


                 <?php }}else{
        echo "Tidak di temukan";}
    ?>
       </table>

    <!-- <small><?php echo $tgl1; ?> & <?php echo $tgl2; ?> </small></h2><hr> -->

               
                  <BR>
                  <bR>
                  <p align="right">
                    <td></td>
                    <td>Diketahui Oleh <br> Pimpinan RS MUJI RAHAYU
                    <br><br><br><br>
                    
                    ________________________
                    </td>
                 
                 
                </p>
              </div>
             
            </div>
       
            </div>
      <!-- </div> -->
          </div>
    </div>

