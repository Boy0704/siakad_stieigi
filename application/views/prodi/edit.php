<?php
echo form_open($this->uri->segment(1).'/edit');
echo "<input type='hidden' name='id' value='$r[prodi_id]'>";
?>
 <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Record</h3>
  </div>
  <div class="panel-body">
<table class="table table-bordered">
   
    <tr>
    <td width="150">Nama Prodi</td><td>
        <?php echo inputan('text', 'nama','col-sm-4','Nama prodi ..', 1, $r['nama_prodi'],'');?>
    </td>
    </tr>
    <tr>
    <td width="150">Ketua</td><td>
        <?php //echo inputan('text', 'ketua','col-sm-4','Ketua ..', 0, $r['ketua'],'');?>
        <select name="ketua" class="form_control select2">
            <option value="<?php echo $r['ketua'] ?>"><?php echo $r['ketua'] ?></option>
            <?php 
            foreach ($this->db->get('app_dosen')->result() as $rw) {
             ?>
            <option value="<?php echo $rw->nama_lengkap ?>"><?php echo $rw->nama_lengkap ?></option>
            <?php } ?>
        </select>
    </td>
    </tr>
    <tr>
    <td width="150">No Izin</td><td>
        <?php echo inputan('text', 'izin','col-sm-4','No Izin ..', 0, $r['no_izin'],'');?>
    </td>
    </tr>
    <tr>
         <td></td><td colspan="2"> 
            <input type="submit" name="submit" value="simpan" class="btn btn-danger  btn-sm">
            <?php echo anchor($this->uri->segment(1),'kembali',array('class'=>'btn btn-danger btn-sm'));?>
        </td></tr>
    
</table>
  </div></div>
</form>