<?php
error_reporting(0);
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek,"SELECT * FROM v_photo WHERE kode='$id'");
$data  = mysqli_fetch_array($sqlku);
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
               <a href="beranda.php?page=dGFtcGlscmFkaW9sb2dpZGVsaXM="> <button class="btn btn-primary large fa fa-home"> Back</button></a>

                 <button class="btn btn-primary large fa fa-print" onclick="printContent('cetak_report')"> Print</button>

                <!-- <h4 class="modal-title">Hasil Radiologi</h4> -->
              </div>

               <form class="form-horizontal"   method="POST" enctype="multipart/form-data" action="">
              
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
                <center><H3> HASIL PEMERIKSAAN RADIOLOGI  <br> RS MUJI RAHAYU </H3></center>

                <table id="customers" width="100%" border="1">
                  <tr>
                    <th width="20%">Tindakan</th>
                    <th> <?php echo $data['tindakan']; ?>   Tanggal :         <?php echo $data['tanggal']; ?> </th>
                  </tr>
                  <tr>
                    <td>Rekam Medis (RM) </td>
                    <td><?php echo $data['kode_pasien']; ?></td>
                  </tr>

                  <tr>
                    <td>Nama Pasien  </td>
                    <td><?php echo $data['pasien']; ?></td>
                  </tr>
                  <tr>
                    <td>J. Kelamin & Umur</td>
                    <td><?php echo $data['jenis_kelamin']; ?> & <?php echo $data['umur']; ?></td>
                  </tr>

                  <!--  <tr>
                    <td>Jenis Rawat</td>
                    <td><?php echo $data['jenis_rawat']; ?></td>
                  </tr> -->


                  <tr>
                    <td>Ruangan</td>
                    <td><?php echo $data['ruangan']; ?></td>
                  </tr>

                  <tr>
                    <td>Dokter</td>
                    <td><?php echo $data['dokter']; ?></td>
                  </tr> 
                      <tr>
                      </tr>

                  <tr>
                    <td>Keterangan</td>
                    <td><?php echo $data['keterangan']; ?></td>
                  </tr> 

                  <tr>
                    <td>Kesimpulan</td>
                    <td><?php echo $data['kesimpulan']; ?></td>
                  </tr> 

                </table>


               
                
                  <p align="right">
                    <td></td>
                    <td>Diketahui Oleh <br> Dokter Radiologi
                    <br><br><br><br>
                    <?php echo $data['dokter']; ?> <br>
                    <?php echo $data['nik_ktp']; ?>
                    </td>
                 
                 
                </p>
              </div>
             
            </div>
          </form>
            </div>
      <!-- </div> -->
          </div>
    </div>

