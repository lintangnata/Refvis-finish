<?php

namespace App\Controllers;
use App\Models\FotoModel;

class Home extends BaseController
{
    protected $FotoModel;

    public function __construct()
    {
        $this->FotoModel = new FotoModel();
    }

    public function home(): string
    {
        $foto = $this->FotoModel->orderBy('id_foto', 'RANDOM')->findAll();

        $data = [
            'foto' => $foto
        ];

        return view('start/home', $data);
    }

    public function login(): string
    {
        return view('start/login');
    }

    public function daftar(): string
    {
        return view('start/daftar');
    }

    public function lupapw(): string
    {
        return view('start/lupapw');
    }

}
