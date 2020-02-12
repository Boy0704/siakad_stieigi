<script src="<?php echo base_url()?>assets/js/jquery.min.js">
</script>
<script>
$(document).ready(function(){
    loadkonsentrasi();
});
</script>

<script>
$(document).ready(function(){
  $("#konsentrasi").change(function(){
      loadsemester();
  });
});
</script>

<script>
$(document).ready(function(){
  $("#prodi").change(function(){
      loadkonsentrasi();
  });
});
</script>
<script>
$(document).ready(function(){
  $("#semester").change(function(){
      tampilmakul();
  });
});
</script>

<script type="text/javascript">
function loadkonsentrasi()
{
    var prodi=$("#prodi").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilkonsentrasi",
    data:"prodi=" + prodi ,
    success: function(html)
    {
       $("#konsentrasi").html(html);
       loadsemester();
    }
          });
}

function hapus(id)
{
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/delete",
    data:"id=" + id ,
    success: function(html)
    {
       $("#hide"+id).hide(300);
    }
          });
}

function edit(id)
{
     window.location.href="<?php echo base_url() ?>matakuliah/edit/"+id;
}

function ubahstatus(id)
{
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/ubahstatus",
    data:"id=" + id ,
    success: function(html)
    {
        tampilmakul();
    }
          });
}
function loadsemester()
{
    var konsentrasi=$("#konsentrasi").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilsemester",
    data:"konsentrasi=" + konsentrasi ,
    success: function(html)
    {
       $("#semester").html(html);
       tampilmakul();
    }
          });

}


function tampilmakul()
{
    var konsentrasi=$("#konsentrasi").val();
    var semester=$("#semester").val();
    $.ajax({
    url:"<?php echo base_url();?>matakuliah/tampilmakul",
    data:"konsentrasi=" + konsentrasi +"&semester="+semester ,
    success: function(html)
    {
       $("#makul").html(html);

    }
          });

}
</script>

<?php
if($this->session->userdata('level') == 1 or $this->session->userdata('level') == 6)
{
    $param="";
}
else
{
    $param=array('prodi_id'=>$this->session->userdata('keterangan'));
}
?>
<div class="col-sm-3">
    <table class="table table-bordered">

    <tr><td>Jurusan <?php echo buatcombo('prodi', 'akademik_prodi', '', 'nama_prodi', 'prodi_id', $param, array('id'=>'prodi'))?></td></tr>
    <tr><td>Prodi <?php echo combodumy('konsentrasi', 'konsentrasi')?></td></tr>
    <tr><td>Semester <?php echo combodumy('semester', 'semester')?></td></tr>
    <tr><td><?php echo anchor('matakuliah/post','<span class="glyphicon glyphicon-plus"></span> Input Data',array('class'=>'btn btn-primary  btn-sm'));?>
        <?php //echo anchor('matakuliah/#','<span class="glyphicon glyphicon-print"></span> Cetak Data',array('class'=>'btn btn-primary  btn-sm'));?></td></tr>
    <tr>
      <td>
        <a id="btn_import" class="btn btn-primary">Import MK</a>
      </td>
    </tr>
</table>
</div>

<div class="col-sm-9">

    <table class="table table-bordered" id="makul">
        <!-- <tr><th width="5">No</th><th width="100">Kode</th><th width="50">Kelompok</th><th>Matakuliah</th><th width="40">SKS</th><th colspan="3">Operasi</th></tr> -->
    </table>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    
    $('#btn_import').click(function(event) {
    
      window.open('<?php echo base_url() ?>manual/import_mk/', '_blank', 'location=yes,height=570,width=800,scrollbars=yes,status=yes');
    });





  });
</script>
