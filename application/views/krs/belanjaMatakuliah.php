<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
<script>
function ambil(jadwal_id,mahasiswa_id)
{
  $.ajax({
	url:"<?php echo base_url();?>krs/post",
	data:"jadwal_id=" + jadwal_id+"&mahasiswa_id="+mahasiswa_id,
  dataType: "JSON",
	success: function(data)
	{
    if (data.status=='0') {
      alert("INFO: SKS Lebih Dari "+data.max_sks+" SKS !!");
      location.reload();
    }else {
      $("#hide"+jadwal_id).hide(300);
    }
	}
	});

}
</script>

<div class="row">
	<div class="col-md-12">
		<table class='table table-bordered'>
            <tr class='alert-info'><th colspan=5>DAFTAR MATAKULIAH</th><th colspan=2><a href="<?php echo base_url('krs'); ?>" class="btn btn-primary"><i class="fa fa-mail-reply-all"></i> Kembali</a></th></tr>
            <tr class='alert-info'><th width=10>No</th><th width=20>Kode</th>
                <th>Nama Matakuliah</th>
                <th>Dosen</th>
                <th width=60>SKS</th><th width=60>JAM</th><th>Ambil</th>
            </tr>
            <?php
                if ($this->session->userdata('konsentrasi_id')) {
                    echo "";
                }
                else
                {
                    echo"<tr>
                            <td colspan='7' style='text-align:center;font-size:18px;'><i class='fa fa-info' style='font-size:60px;'></i><br>OPS DATA TIDAK DITEMUKAN</td>
                        </tr>";
                }

            $thn            =  get_tahun_ajaran_aktif('tahun_akademik_id');
            $mahasiswa_id = $this->session->userdata('keterangan');
            $nim=  getField('student_mahasiswa', 'nim', 'mahasiswa_id', $mahasiswa_id);
            $semester_aktif=  getField('student_mahasiswa', 'semester_aktif', 'mahasiswa_id', $mahasiswa_id);
            $max_sks = $this->Import_mhs->cek_sks_old($nim,$semester_aktif);
            $krs            =   "SELECT sum(mm.sks) as sks
                                FROM makul_matakuliah as mm,akademik_jadwal_kuliah as jk,akademik_krs as ak WHERE jk.makul_id=mm.makul_id and jk.jadwal_id=ak.jadwal_id and ak.nim=$nim";

            $data           =  $this->db->query($krs)->result();
            // print_r($data->sks);
            $sksbatas = 0;
            foreach ($data as $r)
            {
               $sksbatas = $r->sks;
            }

            $kon = $this->session->userdata('konsentrasi_id');
            $data=  $this->db->get_where('akademik_konsentrasi',array('konsentrasi_id'=>$kon))->row_array();
        	$jmlSemester=$data['jml_semester'];
            for($i=1;$i<=$jmlSemester;$i++)
            {
                echo"<tr class='warning'><td colspan=9>Semester $i</td></tr>";
                $query = "SELECT jk.makul_id, mm.kode_makul,mm.sks,mm.jam,mm.nama_makul,mm.sks,jk.jadwal_id,ds.nama_lengkap FROM akademik_jadwal_kuliah as jk, makul_matakuliah as mm, app_dosen as ds WHERE mm.makul_id=jk.makul_id and mm.konsentrasi_id=$kon and mm.semester=$i and tahun_akademik_id='$thn' and ds.dosen_id=jk.dosen_id and jk.jadwal_id not in(select jadwal_id from akademik_krs where nim='$nim')";
                $makul = $this->db->query($query)->result();
                $no=1;

                foreach ($makul as $m)
                {
                    echo"<tr id='hide$m->jadwal_id'><td>$no</td>
                        <td>".  strtoupper($m->kode_makul)."</td>
                        <td>".  strtoupper($m->nama_makul)."</td>
                        <td>".  strtoupper($m->nama_lengkap)."</td>
                        <td>$m->sks SKS</td>
                        <td>$m->jam Jam</td>";
                        // if ($sksbatas>=$max_sks) {
                        //      echo "<td width='10' id='ambil' align='center'><span class='btn btn-sm btn-primary disabled' title='SKS MAKSIMUM'>Ambil</span></td>";
                        // }
                        // else{
                        //      echo "<td width='10' id='ambil' align='center'><span class='btn btn-sm btn-primary' onclick='ambil($m->jadwal_id,$mahasiswa_id)' title='Ambil Matakuliah'>Ambil</span></td>";
                        // }
                        echo "<td width='10' id='ambil' align='center'><span class='btn btn-sm btn-primary' onclick='ambil($m->jadwal_id,$mahasiswa_id)' title='Ambil Matakuliah'>Ambil</span></td>";
                        echo "</tr>";
                    $no++;
                }

            }
        ?>
        </table>
	</div>
</div>
