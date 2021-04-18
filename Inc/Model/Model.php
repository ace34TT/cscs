<?php
class Model
{
    // Nous déclarons une méthode dont le seul but est d'afficher un texte.

    public function __construct()
    {

        try {
            $bdd = new PDO(
                'mysql:host=localhost;dbname=cscs_v2;charset=utf8',
                'root',
                'root'
            );
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
