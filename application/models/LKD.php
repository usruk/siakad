<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LKD extends CI_Model {
  function __construct(){
      parent::__construct();
      // $this->db1 = $this->load->database('db1', TRUE);
      $this->tablekategori = 't_kategori_kegiatan_lkd';
      $this->tablekegiatan = 't_kegiatan_lkd';
      $this->db->query("set lc_time_names='id_ID'");
    }
  public function insertKategori($arraydata = array() )
  {
    $this->db->insert($this->tablekategori, $arraydata);
    $last_recore = $this->db->insert_id();
    return $last_recore;
  }
  public function updateKategori($parameterfilter=array(), $arraydata=array() )
    {
        $this->db->where($parameterfilter);
        $this->db->update($this->tablekategori, $arraydata);
        return $this->db->affected_rows();
    }
    public function deleteKategori($parameter=array())
    {
        $this->db->delete($this->tablekategori, $parameter );
        return $this->db->affected_rows();
    }
    public function getKategori($parameterfilter=array()){
      return $this->db->get_where($this->tablekategori, $parameterfilter);
    }
     public function insertKegiatan($arraydata = array() )
  {
    $this->db->insert($this->tablekegiatan, $arraydata);
    $last_recore = $this->db->insert_id();
    return $last_recore;
  }
  public function updateKegiatan($parameterfilter=array(), $arraydata=array() )
    {
        $this->db->where($parameterfilter);
        $this->db->update($this->tablekegiatan, $arraydata);
        return $this->db->affected_rows();
    }
    public function deleteKegiatan($parameter=array())
    {
        $this->db->delete($this->tablekegiatan, $parameter );
        return $this->db->affected_rows();
    }
    public function getKegiatan($parameterfilter=array()){
      return $this->db->get_where($this->tablekegiatan, $parameterfilter);
    }


    public function getJabatan($parameter=array()){
      $this->db->select('*');
      $this->db->from('m_jabatan_dosen');
      $this->db->order_by('id','ASC');
      if($parameter!=null)
        $this->db->where($parameter);
      return $this->db->get('');
    }
    public function insertConfig($arraydata = array() )
 {
   $this->db->insert('t_config_lkd', $arraydata);
   $last_recore = $this->db->insert_id();
   return $last_recore;
 }
    public function getConfig($id_jabatan){
      $this->db->select('*');
      $this->db->from('t_config_lkd');
      $this->db->where('id_jabatan',$id_jabatan);
      $this->db->order_by('id_kategori','ASC');
      return $this->db->get();
    }
    public function getKategoriSorted(){
      $this->db->select('*');
      $this->db->from($this->tablekategori);
      $this->db->order_by('id','ASC');
      return $this->db->get('');
    }
    public function update($tablename,$parameterfilter=array(), $arraydata=array() )
      {
          $this->db->where($parameterfilter);
          $this->db->update($tablename, $arraydata);
          return $this->db->affected_rows();
      }


    /*
    public function getUnitKerja(){
      return $this->db->get('m_unit_kerja');
    }
    public function getTipe(){
      return $this->db->get('m_tipe_dosen');
    }
    */
    public function cekPeriode($date){
        $this->db->select('id');
        $this->db->from('t_periode_lkd p');
        $this->db->where("('$date' BETWEEN p.tanggal_awal AND p.tanggal_akhir)");
        $query = $this->db->get();
        if($query->num_rows()>0){
          return $query->row()->id;
        }
        return 0;
    }

    public function cekPengajuan($date,$id_dosen){
        $query = $this->db->query("select t.id from t_pengajuan_lkd t join t_periode_lkd p on t.id_periode = p.id where t.id_dosen = $id_dosen AND ('$date' BETWEEN p.tanggal_awal AND p.tanggal_akhir)");

        if($query->num_rows()>0){
          return $query->row()->id;
        }
        return 0;
    }
    public function cekHarian($parameter=array()){
        $this->db->select('id');
        $this->db->from('t_lkd_harian t');
        $this->db->where($parameter);
        $query = $this->db->get();
        if($query->num_rows()>0){
          return $query->row()->id;
        }
        return 0;
    }
    public function cekKegiatan($jam_awal,$jam_akhir,$id_harian){
      $query = $this->db->query("select * from t_detail_lkd t where t.id_lkd_harian = $id_harian AND ((('$jam_awal' BETWEEN t.jam_awal AND t.jam_akhir OR '$jam_akhir' BETWEEN t.jam_awal AND t.jam_akhir) and '$jam_akhir' != t.jam_awal AND '$jam_awal' != t.jam_akhir) OR ((t.jam_awal BETWEEN '$jam_awal' AND '$jam_akhir' OR t.jam_akhir BETWEEN '$jam_awal' AND '$jam_akhir') and t.jam_akhir != '$jam_awal' AND t.jam_awal  != '$jam_akhir'))");
      return $query->num_rows();
    }
    public function insertPeriode($tanggal)
 {
   $this->db->query("INSERT INTO t_periode_lkd(tanggal_awal,tanggal_akhir) VALUES ((SELECT DATE_ADD('$tanggal', INTERVAL - WEEKDAY('$tanggal') DAY)),(SELECT DATE_ADD('$tanggal', INTERVAL - WEEKDAY('$tanggal')+6 DAY)))");
   $last_recore = $this->db->insert_id();
   return $last_recore;
 }

 public function updatePeriode($parameterfilter=array(), $arraydata=array() )
   {
       $this->db->where($parameterfilter);
       $this->db->update('t_periode_lkd', $arraydata);
       return $this->db->affected_rows();
   }
   public function deletePeriode($parameter=array())
   {
       $this->db->delete('t_periode_lkd', $parameter );
       return $this->db->affected_rows();
   }
   public function getPeriode($parameterfilter=array()){
     return $this->db->get_where('t_periode_lkd', $parameterfilter);
   }
   public function insertPengajuan($arraydata = array() )
{
  $this->db->insert('t_pengajuan_lkd', $arraydata);
  $last_recore = $this->db->insert_id();
  return $last_recore;
}
 public function updatePengajuan($parameterfilter=array(), $arraydata=array() )
   {
       $this->db->where($parameterfilter);
       $this->db->update('t_pengajuan_lkd', $arraydata);
       return $this->db->affected_rows();
   }
   public function updatePengajuanTotal($id_pengajuan)
     {
         $query = $this->db->query("update t_pengajuan_lkd t set t.total = (select sum(ROUND(TIME_TO_SEC(TIMEDIFF(td.jam_akhir,td.jam_awal))/3600,1)) from t_detail_lkd td join t_lkd_harian th on td.id_lkd_harian = th.id and th.id_pengajuan = $id_pengajuan) where t.id=$id_pengajuan");
         return $query;
     }
     public function accSemuaDekan($id_periode,$id_fakultas)
       {
         if($id_periode!=0){
          $query = $this->db->query("update t_pengajuan_lkd t join t_dosen d on t.id_dosen = d.id set t.status_pengajuan = 1 where d.id_fakultas = $id_fakultas AND t.id_periode = $id_periode AND t.status_pengajuan=0");
        }else {
           $query = $this->db->query("update t_pengajuan_lkd t join t_dosen d on t.id_dosen = d.id set t.status_pengajuan = 1 where d.id_fakultas = $id_fakultas AND t.status_pengajuan=0");
         }
         return $query;
       }
   public function deletePengajuan($parameter=array())
   {
       $this->db->delete('t_pengajuan_lkd', $parameter );
       return $this->db->affected_rows();
   }
   public function getPengajuan($parameterfilter=array()){
     return $this->db->get_where('t_pengajuan_lkd', $parameterfilter);
   }

   public function getPengajuanMingguan($id_dosen){
     return $this->db->query("select p.id, DATE_FORMAT(tanggal_awal, '%d/%m/%Y') as tanggal_awal, DATE_FORMAT(tanggal_akhir, '%d/%m/%Y') as tanggal_akhir, MONTH(tanggal_akhir) as bulan, YEAR(tanggal_akhir) as tahun from t_pengajuan_lkd p join t_periode_lkd pe on p.id_periode = pe.id where id_dosen=$id_dosen ORDER BY pe.tanggal_akhir DESC LIMIT 10");
   }
   public function getPengajuanFakultas(){
     return $this->db->query("select id, DATE_FORMAT(tanggal_awal, '%d/%m/%Y') as tanggal_awal, DATE_FORMAT(tanggal_akhir, '%d/%m/%Y') as tanggal_akhir, MONTH(tanggal_akhir) as bulan, YEAR(tanggal_akhir) as tahun from t_periode_lkd pe ORDER BY pe.tanggal_akhir DESC LIMIT 10");
   }
   public function getPeriodeByKode($bulan,$tahun){
     return $this->db->query("select id, DATE_FORMAT(tanggal_awal, '%d/%m/%Y') as tanggal_awal, DATE_FORMAT(tanggal_akhir, '%d/%m/%Y') as tanggal_akhir, MONTH(tanggal_akhir) as bulan, YEAR(tanggal_akhir) as tahun from t_periode_lkd pe where MONTH(pe.tanggal_akhir)='$bulan' AND YEAR(pe.tanggal_akhir)='$tahun' ORDER BY pe.tanggal_akhir");
   }

 public function updatePengajuanBulanan($parameterfilter=array(), $arraydata=array() )
   {
     if($parameterfilter!=null)
       $this->db->where($parameterfilter);
       $this->db->update('t_pengajuan_bulanan_lkd', $arraydata);
       return $this->db->affected_rows();
   }

   public function deletePengajuanBulanan($parameter=array())
   {
       $this->db->delete('t_pengajuan_bulanan_lkd', $parameter );
       return $this->db->affected_rows();
   }
   public function getPengajuanBulanan($parameterfilter=array()){
     return $this->db->get_where('t_pengajuan_bulanan_lkd', $parameterfilter);
   }
   public function getPengajuanBulananDosen($id_fakultas,$kode_bulan){
     $this->db->select("t.*");
     $this->db->from('t_pengajuan_bulanan_lkd t');
     $this->db->join('t_dosen d','d.id = t.id_dosen');
     $this->db->where(array('t.kode_bulan'=>$kode_bulan,'d.id_fakultas'=>$id_fakultas));
     return $this->db->get();
   }
   public function insertPengajuanBulanan($arraydata = array() )
{
  $this->db->insert('t_pengajuan_bulanan_lkd', $arraydata);
  $last_recore = $this->db->insert_id();
  return $last_recore;
}



   public function insertHarian($arraydata = array() )
{
  $this->db->insert('t_lkd_harian', $arraydata);
  $last_recore = $this->db->insert_id();
  return $last_recore;
}
public function updateHarian($parameterfilter=array(), $arraydata=array() )
  {
      $this->db->where($parameterfilter);
      $this->db->update('t_lkd_harian', $arraydata);
      return $this->db->affected_rows();
  }
  public function deleteHarian($parameter=array())
  {
      $this->db->delete('t_lkd_harian', $parameter );
      return $this->db->affected_rows();
  }
  public function getHarian($parameterfilter=array()){
    return $this->db->get_where('t_lkd_harian', $parameterfilter);
  }

  public function insertDetail($arraydata = array() )
{
 $this->db->insert('t_detail_lkd', $arraydata);
 $last_recore = $this->db->insert_id();
 return $last_recore;
}
public function updateDetail($parameterfilter=array(), $arraydata=array() )
 {
     $this->db->where($parameterfilter);
     $this->db->update('t_detail_lkd', $arraydata);
     return $this->db->affected_rows();
 }
 public function deleteDetail($parameter=array())
 {
     $this->db->delete('t_detail_lkd', $parameter );
     return $this->db->affected_rows();
 }
 public function getDetail($parameterfilter=array()){
   return $this->db->get_where('t_detail_lkd', $parameterfilter);
 }
 public function getPengajuanEncrypted($encrypted_id){
   $this->db->select('*');
   $this->db->from('t_pengajuan_lkd');
   $this->db->where("MD5(id) = '$encrypted_id'");
   return $this->db->get();
 }
 public function getPengajuanBulananEncrypted($encrypted_id){
   $this->db->select('*');
   $this->db->from('t_pengajuan_bulanan_lkd');
   $this->db->where("MD5(id) = '$encrypted_id'");
   return $this->db->get();
 }
 public function getHarianEncrypted($encrypted_id){
   $this->db->select('id, DATE_FORMAT(tanggal, "%m/%d/%Y") as tanggal');
   $this->db->from('t_lkd_harian td');
   $this->db->where("MD5(id) = '$encrypted_id'");
   return $this->db->get();
 }

 public function getDetailEncrypted($encrypted_id){
   $this->db->select('*');
   $this->db->from('t_detail_lkd td');
   $this->db->where("MD5(id_lkd_harian) = '$encrypted_id'");
   return $this->db->get();
 }

function getDetailLKD($id_pengajuan){



  $this->db->select('td.*, ROUND(TIME_TO_SEC(TIMEDIFF(td.jam_akhir,td.jam_awal))/3600,1) as selisih,tk.nama as kegiatan , tk.id_kategori as id_kategori, DATE_FORMAT(th.tanggal, "%W %e %M %Y") as tanggal, th.tanggal as tgl');
  $this->db->from('t_detail_lkd td');
  $this->db->join('t_lkd_harian th','td.id_lkd_harian = th.id');
  $this->db->join('t_kegiatan_lkd tk','td.id_kegiatan = tk.id');
  $this->db->where('th.id_pengajuan',$id_pengajuan);
  $this->db->order_by('tgl, jam_awal','ASC');
  return $this->db->get();
}
function getBulanPengajuan(){
  $this->db->select("distinct concat(MONTH(t.tanggal_akhir),'-',YEAR(t.tanggal_akhir)) as kode,
  concat(MONTHNAME(t.tanggal_akhir),' ', YEAR(t.tanggal_akhir)) as bulan");
  $this->db->from("t_periode_lkd t");
  $this->db->order_by('t.tanggal_akhir','DESC');
  return $this->db->get();
}
function getBulanData($id_dosen,$bulan,$tahun){
  return $this->db->query("select pe.*, p.id as id_pengajuan,p.status_pengajuan,p.total from t_periode_lkd pe left join t_pengajuan_lkd p on pe.id = p.id_periode and p.id_dosen=$id_dosen where MONTH(pe.tanggal_akhir)=$bulan AND YEAR(pe.tanggal_akhir)=$tahun ORDER by tanggal_awal asc");

}


    function jsonKategori() {
        $this->datatables->select('kt.id, kt.nama, kt.alias');
        $this->datatables->from($this->tablekategori.' kt');
        $this->datatables->add_column('view', '<center><button class=\'btn btn-success btn-xs\' value=\'$1\' onclick=\'editkt(this.value)\' title=\'Edit Data\' data-toggle="modal"><span class=\'glyphicon glyphicon-edit\'></span></button> <button class=\'btn btn-danger btn-xs\' value=\'$1\' onclick=\'hapuskt(this.value)\' title=\'Hapus Data\' data-toggle="modal"><span class=\'glyphicon glyphicon-remove\'></span></button></center>', 'id');
        return $this->datatables->generate();
    }
    function jsonKegiatan() {
        $this->datatables->select('kg.id, kg.nama, kt.nama as kategori');
        $this->datatables->from($this->tablekegiatan.' kg');
        $this->datatables->join($this->tablekategori.' kt', 'kg.id_kategori = kt.id','left');
        $this->datatables->add_column('view', '<center><button class=\'btn btn-success btn-xs\' value=\'$1\' onclick=\'editkg(this.value)\' title=\'Edit Data\' data-toggle="modal"><span class=\'glyphicon glyphicon-edit\'></span></button> <button class=\'btn btn-danger btn-xs\' value=\'$1\' onclick=\'hapuskg(this.value)\' title=\'Hapus Data\' data-toggle="modal"><span class=\'glyphicon glyphicon-remove\'></span></button></center>', 'id');
        return $this->datatables->generate();
    }
    function jsonDekan($param=array(),$id_fakultas) {
        $this->datatables->select("p.id, pg.nip, pg.nama, CONCAT(DATE_FORMAT(pe.tanggal_awal,'%d/%m/%Y'),' - ',DATE_FORMAT(pe.tanggal_akhir,'%d/%m/%Y')) as periode, DATE_FORMAT(p.waktu_pengajuan,'%d/%m/%Y %H:%i:%s') as waktu_pengajuan, s.nama as status");
        $this->datatables->from('t_pengajuan_lkd p');
        $this->datatables->join('t_periode_lkd pe', 'p.id_periode = pe.id');
        $this->datatables->join('t_status_lkd s', 'p.status_pengajuan = s.id');
        $this->datatables->join('t_dosen d', 'p.id_dosen = d.id');
        $this->datatables->join('t_pegawai pg', 'd.id_pegawai = pg.id');
        $this->datatables->where('d.id_fakultas',$id_fakultas);
        //$this->db->order_by('waktu_pengajuan','DESC');
        if($param['pe.id']!=null){
          $this->datatables->where('pe.id',$param['pe.id']);
        }
        else if($param['bulan']!=null){

          $bulan = $param['bulan'][0];
          $tahun = $param['bulan'][1];
          $this->datatables->where("MONTH(pe.tanggal_akhir)='$bulan' AND YEAR(pe.tanggal_akhir)='$tahun'");
        }
        if($param['status']!=-2)
        $this->datatables->where('p.status_pengajuan',$param['status']);
        $this->datatables->add_column('view', '<center><button class=\'btn btn-warning btn-xs\' value=\'$1\' onclick=\'aksi(this.value)\' title=\'Edit Data\' data-toggle="modal" data-target="#myModalEdit"><span class=\'glyphicon glyphicon-edit\'></span></button></center>', 'id');
        return $this->datatables->generate();
    }
    function jsonRektor($param=array()) {
        $this->datatables->select("p.id, pg.nip, pg.nama, p.kode_bulan as bulan, DATE_FORMAT(p.waktu_pengajuan,'%d/%m/%Y %H:%i:%s') as waktu_pengajuan, s.nama as status");
        $this->datatables->from('t_pengajuan_bulanan_lkd p');
        $this->datatables->join('t_status_lkd s', 'p.status_pengajuan = s.id');
        $this->datatables->join('t_dosen d', 'p.id_dosen = d.id');
        $this->datatables->join('t_pegawai pg', 'd.id_pegawai = pg.id');
        if($param['kode_bulan']!=null)
        $this->datatables->where('kode_bulan',$param['kode_bulan']);
        if($param['id_fakultas']!=null)
        $this->datatables->where('d.id_fakultas',$param['id_fakultas']);
        $this->datatables->add_column('view', '<center><button class=\'btn btn-warning btn-xs\' value=\'$1\' onclick=\'aksi(this.value)\' title=\'Edit Data\' data-toggle="modal" data-target="#myModalEdit"><span class=\'glyphicon glyphicon-edit\'></span></button></center>', 'id');
        return $this->datatables->generate();
    }
}
