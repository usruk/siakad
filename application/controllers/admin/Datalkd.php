<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datalkd extends CI_Controller {

	public function index()
	{
		$this->load->model(array('LKD'));
		$cek = $this->session->userdata('status');
		if ($cek == 'admin'){
			$array=array('page'=>5);
		$data['kategori'] = $this->LKD->getKategori();
		$this->load->view('header_v',$array);
		$this->load->view('admin/datalkd_v',$data);
		$this->load->view('footer_v');
		}else{
			header("location:".base_url());
		}
	}
	function jsonKategori() {
			$this->load->library('datatables');
			$this->load->model(array('LKD'));
	        header('Content-Type: application/json');
	        echo $this->LKD->jsonKategori();
	    }
    function jsonKegiatan() {
			$this->load->library('datatables');
			$this->load->model(array('LKD'));
	        header('Content-Type: application/json');
	        echo $this->LKD->jsonKegiatan();
	    }
	function getKategori(){
		$this->load->model(array('LKD'));
		$id = $_POST['id'];
		$kategori = $this->LKD->getKategori(array('id'=>$id));
		echo json_encode($kategori->row());
	}
	function insertKategori(){
		$this->load->model(array('LKD'));
		$id = $this->input->post('id');


		$data = array(
			'nama' => $this->input->post('nama'),
			'alias' => $this->input->post('alias'),
		);

		if(trim($data['nama'])=='' || trim($data['alias'])==''){
			echo json_encode(array('status'=>'gagal','message'=>'Data tidak boleh kosong!'));
		}
		else{
			$cek = $this->LKD->insertKategori($data);
			$jabatan = $this->LKD->getJabatan(null);
			foreach ($jabatan->result() as $row) {
				$this->LKD->insertConfig(array('id_jabatan'=>$row->id,'id_kategori'=>$cek,'jam'=>0));
			}
			echo json_encode(array('status'=>'berhasil','message'=>'Input berhasil!'));
		}
	}

	function updateKategori(){
		$this->load->model(array('LKD'));
		$id = $this->input->post('id');


		$data = array(
			'nama' => $this->input->post('nama'),
			'alias' => $this->input->post('alias'),
		);
		if(trim($data['nama'])=='' || trim($data['alias'])==''){
			echo json_encode(array('status'=>'gagal','message'=>'Data tidak boleh kosong!'));
		}
		else{
			$cek = $this->LKD->updateKategori(array('id'=>$id),$data);
			echo json_encode(array('status'=>'berhasil','message'=>'Update berhasil!'));
		}
	}
	function getKegiatan(){
		$this->load->model(array('LKD'));
		$id = $_POST['id'];
		$kegiatan = $this->LKD->getKegiatan(array('id'=>$id));
		echo json_encode($kegiatan->row());
	}
	function insertKegiatan(){
		$this->load->model(array('LKD'));
		$id = $this->input->post('id');



		$data = array(
			'nama' => $this->input->post('nama'),
			'id_kategori' => $this->input->post('kategori'),
		);
		if(trim($data['nama'])=='' || trim($data['id_kategori'])==''){
			echo json_encode(array('status'=>'gagal','message'=>'Data tidak boleh kosong!'));
		}
		else{
			$cek = $this->LKD->insertKegiatan($data);
			echo json_encode(array('status'=>'berhasil','message'=>'Input berhasil!'));
		}
	}

	function updateKegiatan(){
		$this->load->model(array('LKD'));
		$id = $this->input->post('id');



		$data = array(
			'nama' => $this->input->post('nama'),
			'id_kategori' => $this->input->post('kategori'),
		);
		if(trim($data['nama'])=='' || trim($data['id_kategori'])==''){
			echo json_encode(array('status'=>'gagal','message'=>'Data tidak boleh kosong!'));
		}
		else{
			$kegiatan = $this->LKD->getKegiatan(array('id'=>$id));
			if($kegiatan->row()!=null && $kegiatan->row()->id_status==0){
				$cek = $this->LKD->updateKegiatan(array('id'=>$id),$data);
				echo json_encode(array('status'=>'berhasil','message'=>'Update berhasil!'));
			}
			else if($kegiatan->row()!=null){
				echo json_encode(array('status'=>'gagal','message'=>"Kegiatan ".$kegiatan->row()->nama." tidak dapat diubah!"));
			}
		}
	}
	
	function deleteKategori(){
		$this->load->model(array('LKD'));
		$data = array(
			'id' => $_POST['id']
		);
		$cek = $this->LKD->deleteKategori($data);
		if($cek){
			echo json_encode(array('status'=>'berhasil','message'=>'Delete berhasil!'));
		}
		else{
			echo json_encode(array('status'=>'gagal','message'=>"Delete gagal!"));
		}
	}
}
