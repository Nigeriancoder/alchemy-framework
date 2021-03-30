<?php


namespace app\classes\controllers;
use app\engine\Controller;

class AppController extends  Controller
{
    public function default(): string
    {
        return $this->render('home', [
            'name' => 'Alchemy Framework'
        ]);
    }
}