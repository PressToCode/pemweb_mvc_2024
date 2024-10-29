<?php

require "config.php";
require "controller.php";
require "Database.php";
require "model.php";
class Boot {
    protected $controller = 'index';
    protected $action = 'index';
    protected $params = [];

    // Contruct
    public function __construct() {
        // echo "booting sukses";

        // Ambil data get URL
        // untuk routing aplikasi
        // Controller/Action/Param1/Param2
        $url = $_GET['r'];
        $url = $this->parseURL($url);

        // Jika file controller yang diminta ada
        // maka controller akan digunakan
        // dan unset element array ke-1
        if(file_exists('apps/controllers/'. $url[0] .'.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // Replace controller with actual controller
        require('apps/controllers/'. $this->controller .'.php');
        $this->controller = new $this->controller;

        // Jika method yang diminta ada
        // maka method akan digunakan
        // dan unset element array ke-2
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->action = $url[1];
                unset($url[1]);
            }
        }

        // Check if there is params
        if(!empty($url)) {
            $this->params = array_values($url);
        }

        // Call method
        call_user_func_array([$this->controller, $this->action],$this->params);

        // Untuk tampilan
        // echo "<br>";
        // var_dump($url);
    }

    public function parseURL($url) {
        if(isset($_GET['r'])) {
            // Hapus tanda '/' jika ada di akhir
            $url = rtrim($_GET['r'],'/');

            // Sanitasi URL, Prevent Malicious Strings
            $url = filter_var($url, FILTER_SANITIZE_URL);

            // Memecah string menjadi array
            $url = explode('/', $url);

            return $url;
        }
    }
}