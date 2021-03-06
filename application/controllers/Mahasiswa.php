<?php

class Mahasiswa extends CI_Controller{
    // make menthod index
    public function index(){ 
        // akses model mahasiswa
        $this->load->model('mahasiswa_model');
        $mahasiswa = $this->mahasiswa_model->getALL();
        $data['mahasiswa'] = $mahasiswa;

        $this->load->view('layouts/header');
        $this->load->view('mahasiswa/index', $data);
        $this->load->view('layouts/footer');
    }

    public function detail($id) {
        // akses model mahasiswa
        $this->load->model('mahasiswa_model');
        $siswa = $this->mahasiswa_model->getById($id);
        $data['siswa'] = $siswa;

        $this->load->view('layouts/header');
        $this->load->view('mahasiswa/detail', $data);
        $this->load->view('layouts/footer');
    }

    public function form(){
        // render view
        $this->load->view('layouts/header');
        $this->load->view('mahasiswa/form');
        $this->load->view('layouts/footer');
    }

    public function save() {
        // akses model mahasiswa
        $this->load->model('mahasiswa_model', 'mahasiswa');
        $_nim = $this->input->post('nim');
        $_nama = $this->input->post('nama');
        $_gender = $this->input->post('gender');
        $_tmp_lahir = $this->input->post('tmp_lahir');
        $_tgl_lahir = $this->input->post('tgl_lahir');
        $_ipk = $this->input->post('ipk');

        $data_mahasiswa['nim'] = $_nim; // 2
        $data_mahasiswa['nama'] = $_nama; 
        $data_mahasiswa['gender'] = $_gender; 
        $data_mahasiswa['tmp_lahir'] = $_tmp_lahir;
        $data_mahasiswa['tgl_lahir'] = $_tgl_lahir; 
        $data_mahasiswa['ipk'] = $_ipk; 

        if((!empty($_idedit))){ 
            $data_mahasiswa['id'] = $_idedit;
            $this->mahasiswa->update($data_mahasiswa);
        }else{
            $this->mahasiswa->simpan($data_mahasiswa);
        }
        redirect('mahasiswa'. 'refresh');
    }

    public function edit($id){
        // akses model mahasiswa
        $this->load->model('mahasiswa_model', 'mahasiswa');
        $obj_mahasiswa = $this->mahasiswa->getById($id);
        $data['obj_mahasiswa'] = $obj_mahasiswa;

        $this->load->view('layouts/header');
        $this->load->view('mahasiswa/edit', $data);
        $this->load->view('layouts/footer');
    }
    
    public function delete($id){
        $this->load->model('mahasiswa_model', 'mahasiswa');
        // cek data berdasarkan id
        $data_mahasiswa['id'] = $id;
        $this->mahasiswa->delete($data_mahasiswa);
        redirect('mahasiswa', 'refresh');
    }
}
?>