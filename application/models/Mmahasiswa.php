<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mmahasiswa extends CI_Model
{
    //Buat method untuk tampil data
    function get_data()
    {
        $this->db->select("id AS id_mhs,
        npm AS npm_mhs,
        nama AS nama_mhs,
        telepon AS telepon_mhs,
        jurusan AS jurusan_mhs");

        $this->db->from("tb_mahasiswa");
        $this->db->order_by("npm", "ASC");

        $query = $this->db->get()->result();
        return $query;
    }

    function delete_data($token)
    {
        //cek npm ada atau tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        //eksekusi query
        $query = $this->db->get()->result();

        if (count($query) == 1) {
            //Hapus data mahasiswa
            $this->db->where("TO_BASE64(npm) = '$token'");
            $this->db->delete("tb_mahasiswa");
            //kirim nilai hasil 1
            $hasil = 1;
        } else {
            //kirim nilai hasil 0
            $hasil = 0;
        }
        //kirm variable hasil ke controller mahasiswa
        return $hasil;
    }

    function save_data($npm, $nama, $telepon, $jurusan, $token)
    {
        //cek npm ada atau tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");
        //eksekusi query
        $query = $this->db->get()->result();
        //JIka Npm tidak ditemukan
        if (count($query) == 0) {
            //isi nilai untuk masing2 field
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "telepon" => $telepon,
                "jurusan" => $jurusan,
            );
            //Simpan data
            $this->db->insert("tb_mahasiswa", $data);
            $hasil = 0;
        }
        //JIka Npm ditemukan
        else {
            $hasil = 1;
        }
        return $hasil;
    }
}
