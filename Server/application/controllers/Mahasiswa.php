<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."libraries/Server.php";

class Mahasiswa extends Server {

    //buat fungsi "GET"
    function service_get()
{
    //panggil model "Mahasiswa"
    $this->load->model("Mmahasiswa","mdl",TRUE);

    //panggil fungsi "get data"
    $hasil = $this->mdl->get_data();

    $this->response(array("Mahasiswa" => $hasil),200);
}

    //buat fungsi "POST"
    function service_post()
{
    // Panggil Model "Mmahasiswa"
    $this->load->model("Mmahasiswa","mdl",TRUE);
    // AMbil Paramter data yang akan diisi
    $data = array(
        "npm" => $this->post("npm"),
        "nama" => $this->post("nama"),
        "telepon" => $this->post("telepon"),
        "jurusan" => $this->post("jurusan"),
        "token" => base64_encode($this->post("npm")),
    );

    //panggil Method "Save Data"
    $hasil = $this->mdl->save_data($data["npm"],$data["nama"],$data["telepon"],$data["jurusan"],$data["token"]);
    //jika hasil = 0
    if($hasil == 0)
    {
        $this->response(array("Status" => "Data Mahasiswa Berhasil Disimpan"), 200);
    }
    //jika hasil !=0
    else
    {
        $this->response(array("Status" => "Data Mahasiswa Gagal Disimpan"), 200);
    }
}

    //buat fungsi "PUT"
    function service_put()
{

}

    //buat fungsi "DELETE"
    function service_delete()
{
    //panggil model "Mmahasiswa"
    $this->load->model("Mmahasiswa","mdl",TRUE);

    //ambil parameter token - NPM
    $token = $this->delete("npm");

    //panggil fungsi "delete_data"
    //Base4_encode untuk memberi informasi ke Frontend
    $hasil = $this->mdl->delete_data(base64_encode($token));

    //jika proses berhasil
    if($hasil == 1) {
        $this->response(array("Status" => "Data Mahasiswa Berhasil Dihapus"), 200);
    }else{
        $this->response(array("Status" => "Data Mahasiswa Gagal Dihapus"), 200);
    }
}
    }