<?php

class Home extends controller {
    private $dt;
    private $df;

    public function __construct() {
        // echo "Anda berada pada controller home! <br>";
        $this->dt = $this->loadmodel("barang");
        $this->df = $this->loadmodel("daftarBarang");
    }

    public function index() {
        echo "Anda memanggil method index() dari controller home <br>";
    }

    public function home($data1, $data2) {
        echo "Anda memanggil method home() dari controller home <br> dengan data1 = $data1 dan data = $data2 <br>";
    }

    public function lihatdata($id) {
        // $data = $this->dt->getDataOne();
        $data = $this->df->getDataById($id);

        $this->loadview('templates/header',['title'=>'Detail Barang']);
        $this->loadview('home/detailbarang', $data);
        $this->loadview('templates/footer');
    }

    public function listbarang() {
        $data = $this->df->getDataAll();

        $this->loadview('templates/header',['title'=>'List Barang']);
        $this->loadview('home/listbarang', $data);
        $this->loadview('templates/footer');
    }

    public function insertbarang() {
        if(!empty($_POST)) {
            if($this->df->tambahBarang($_POST)) {
                header('Location: '.BASE_URL.'index.php?r=home/listbarang');
                exit;
            }
        }

        $this->loadview('templates/header',['title'=>'Insert Barang']);
        $this->loadview('home/insert');
        $this->loadview('templates/footer');
    }

    public function updatebarang($id) {
        $data = $this->df->getDataById($id);

        if(!empty($_POST)) {
            if($this->df->updateBarang($_POST)) {
                header('Location: '.BASE_URL.'index.php?r=home/listbarang');
                exit;
            }
        }

        $this->loadview('templates/header',['title'=>'Update Barang']);
        $this->loadview('home/update', $data);
        $this->loadview('templates/footer');
    }

    public function deletebarang($id) {
        $data = $this->df->getDataById($id);

        if($this->df->hapusBarang($id)) {
            header('Location: '.BASE_URL.'index.php?r=home/listbarang');
            exit;
        }
    }
}