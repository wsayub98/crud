<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function home()
    {
        $data = [
            'title'   => 'Home | AMS',
        ];

        return view('pages/home', $data);
    }

    public function about()
    {
        $data = [
            'title'   => 'About us | AMS',
            'vehicle' => [
                'type' => 'lorry',
                'tyre' => '6',
                'door' => 'two'
            ],
            [
                'type' => 'car',
                'tyre' => '4',
                'door' => '4'
            ]
        ];

        return view('pages/about', $data);
    }
}
