<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . "libraries/server.php";

class Mahasiswa extends Server
{
	//Buat fungsi "GET"
	function service_get()
	{
		//Panggil model mahasiswa
		$this->load->model("Mmahasiswa", "mdl", TRUE);
		//Panggil fungsi "get_data"
		$hasil = $this->mdl->get_data();
		$this->response($hasil, 200);
	}

	//Buat fungsi "POST"
	function service_post()
	{
		//Panggil model mahasiswa
		$this->load->model("Mmahasiswa", "mdl", TRUE);
		//Ambil parameter yang akan di isi
		$data = array(
			"npm" => $this->post("npm"), //$data[0]
			"nama" => $this->post("nama"), //$data[1]
			"telepon" => $this->post("telepon"), //$data[2]
			"jurusan" => $this->post("jurusan"), //$data[3]
			"token" => base64_encode($this->post("npm")), //$data[4]
		);
		//Panggil method "Save Data"
		$hasil = $this->mdl->save_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);
		//Jika hasil = 0
		if ($hasil == 0) {
			$this->response(array("status" => "Data Mahasiswa Berhasil Disimpan"), 200);
		}
		//Jika hasil !=0
		else {
			$this->response(array("status" => "Data Mahasiswa Gagal Disimpan !"), 200);
		}
	}

	//Buat fungsi "PUT"
	function service_put()
	{
	}

	//Buat fungsi "DELETE"
	function service_delete()
	{
		//Panggil model mahasiswa
		$this->load->model("Mmahasiswa", "mdl", TRUE);
		//Panggil fungsi "delete_data"
		$token = $this->delete("npm");
		//Panggil fungsi "get_data"
		$hasil = $this->mdl->delete_data(base64_encode($token));

		if ($hasil == 1) {
			$this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"), 200);
		} else {
			$this->response(array("status" => "Data Mahasiswa Gagal Dihapus!"), 200);
		}
	}
}
