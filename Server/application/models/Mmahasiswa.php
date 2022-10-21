<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Mmahasiswa extends CI_Model {

    // BUAT METHOD UNTUK TAMPIL DATA
    function get_data()
    {
        $this->db->select("id AS id_mhs,
        npm AS npm_mhs,
        nama AS nama_mhs,
        telepon AS telepon_mhs,
        jurusan AS jurusan_mhs");
        $this->db->from("tb_mahasiswa");
        $this->db->order_by("npm","ASC");

        $query = $this->db->get()->result();
        return $query;
    }
    function insert_data($data)
    {

    }


    #Delete Dtaa
    function delete_data($token)
    {
        //Cek Apakah npm ada atau tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");

        //Eksekusi Query
        $query = $this->db->get()->result();
        //jika npm ditemukan
        if(count($query) == 1)
        {
            //Hapus Data Mahasiswa
            $this->db->where("TO_BASE64(npm) = '$token'");
            $this->db->delete("tb_mahasiswa");
            //kirim hasil = 1
            $hasil = 1;
        }
        //jika npm tidak ditemukan
        else
        {
            //kirim hasil = 0
            $hasil = 0;
        }
        //kirim variabel hasil ke 'controller' Mahasiswa
        return $hasil;
    }
        // membuat fungsi untuk simpan data
        function save_data($npm,$nama,$telepon,$jurusan,$token)
        {
             //Cek Apakah npm ada atau tidak
        $this->db->select("npm");
        $this->db->from("tb_mahasiswa");
        $this->db->where("TO_BASE64(npm) = '$token'");

        //Eksekusi Query
        $query = $this->db->get()->result();
        //jika npm tidak ditemukan
        if(count($query) == 0)
        {
            // isi nilai untuk masing2 field
            $data = array(
                "npm" => $npm,
                "nama" => $nama,
                "telepon" => $telepon,
                "jurusan" => $jurusan,
            );

            // simpan data
            $this->db->insert("tb_mahasiswa",$data);
            $hasil = 0;
        }
        //jika npm ditemukan
        else
        {
            $hasil = 1;
        }
        return $hasil;
}
}