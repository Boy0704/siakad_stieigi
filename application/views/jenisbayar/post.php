<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Entry Record</h3>
  </div>
  <div class="panel-body">
    <?php
echo form_open_multipart($this->uri->segment(1).'/post');
?>
<table class="table table-bordered">
    
    <tr>
    <td width="150">Jenis Bayar</td><td>
        <?php echo inputan('text', 'jenis','col-sm-8','Jenis Pembayaran ..', 1, '','');?>
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