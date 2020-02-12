<script src="<?php echo base_url();?>assets/js/1.8.2.min.js"></script>
 
   <script>
  $( document ).ready(function() {
      loaddata();
  });
  </script>
  
   <script type="text/javascript">
$(document).ready(function(){
  $("#konsentrasi").change(function(){
      loaddata();    
  });
});
</script>
   <script type="text/javascript">
$(document).ready(function(){
  $("#tahun").change(function(){
      loaddata();    
  });
});
</script>
 <script type="text/javascript">
     
     function loaddata()
     {
         var konsentrasi=$("#konsentrasi").val();
         var tahun_akademik=$("#tahun").val();
         $.ajax({
        url:"<?php echo base_url();?>keuangan/loadlaporan",
        data:"tahun_angkatan=" + tahun_akademik +"&konsentrasi="+konsentrasi ,
                success: function(html)
                {
                    $("#table").html(html);
                    //$("#table").hide();
                }
            });
     }
 </script>

 <?php
 echo form_open('keuangan/cetak');
 ?>
 <div class="col-md-14">
     <div class="col-md-3">
         <table class="table table-bordered">
             <tr class='alert-info'><th colspan="2">Pilih Data</th></tr>
         <tr><td>
            <div class="col-sm-13">
                <select id="konsentrasi" name="konsentrasi" class="form-control">
                <?php
                foreach ($konsentrasi as $k)
                {
                    echo "<option value='$k->konsentrasi_id'>".strtoupper($k->nama_konsentrasi)."</option>";
                }
                ?>
            </select>
            </div>
            </td></tr>
        <tr><td>Angkatan
                <select name="tahun" id="tahun" class="form-control">
                    <?php
                    $data=$this->db->get('student_angkatan')->result();
                    foreach ($data as $d)
                    {
                        echo "<option value='$d->angkatan_id'>$d->keterangan</option>";
                    }
                    ?>
                    <option value="0">Semua Angkatan</option>
                </select>
                <?php //echo buatcombo('tahun', 'student_angkatan', '', 'keterangan', 'angkatan_id', '', array('id'=>'tahun'))?></td></tr>
        
    </table>
     </div>
     
         <div class="col-md-4">
     <table class="table table-bordered">
         <tr class='alert-info'><th colspan="2">Keterangan</th></tr>
         <tr><th>01</th><th>BIAYA YANG SUDAH DIBAYAR</th></tr>
         <tr><th>02</th><th>TUNGGAKAN</th></tr>
         <tr><td colspan="2">
            <input type="submit" class="btn btn-danger btn-sm" value="Cetak Laporan">
             <?php
             echo
             anchor('keuangan/sms','<span class="fa fa-send"></span> Kirim SMS',array('class'=>'btn btn-danger btn-sm','target'=>'new'));
             ?>
             </td></tr>
     </table>
     </div>
 </form>
     <div style="clear: both"></div><hr>
     
     <div id="table"></div>
    
 
 </div>
 
