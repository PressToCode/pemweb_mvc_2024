<?php

class DaftarBarang extends model {
    private $daftar = [];

    // public function __construct() {
    //     $this->daftar = [
    //         [
    //             'id' => 'B02',
    //             'nama' => 'Minyak Goreng',
    //             'qty' => '100'
    //         ],
    //         [
    //             'id' => 'B03',
    //             'nama' => 'Gula',
    //             'qty' => '50'
    //         ],
    //         [
    //             'id' => 'B04',
    //             'nama' => 'Kopi',
    //             'qty' => '500'
    //         ]
    //     ];
    // }

    public function getDataAll() {
        // return $this->daftar;

        $stmt = "select * from daftarbarang";
        $query = $this->db->query($stmt);
        $data = [];

        while($result = $this->db->fetch_array($query)) {
            $data[] = $result;
        }

        return $data;
    }

    public function getDataById($id) {
        $stmt = "select * from daftarbarang where id = $id";
        $query = $this->db->query($stmt);
        $data = [];
        $data = $this->db->fetch_array($query);

        return $data;
    }

    public function tambahBarang($param) {
        $stmt = "insert into daftarbarang (nama, qty) values (:nama, :qty)";
        $query = $this->db->query($stmt, $param);

        if($this->db->last_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBarang($param) {
        $stmt = "update daftarbarang set nama = :nama, qty = :qty where id = :id";
        $query = $this->db->query($stmt, $param);

        if($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusBarang($id) {
        $stmt = "delete from daftarbarang where id = :id";
        $query = $this->db->query($stmt, $id);

        if($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}