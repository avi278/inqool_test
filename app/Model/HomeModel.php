<?php

declare(strict_types=1);

namespace App\Model;

use Nette;
use Nette\Application\UI\Form;


/**
 * Trida pro praci s databazi
*/
class HomeModel
{
    use Nette\SmartObject;

    public Nette\Database\Explorer $database;
    private $options = array('cost' => 11);


    public function __construct(Nette\Database\Explorer $database) {
        $this->database = $database;
    }

    /**
     * Funkce pro vlozeni noveho projektu do databaze
    */
    public function insertProj($proj_name,$proj_text,$proj_label) {
        $this->database->table('project')->insert([
            'proj_name'=> $proj_name,
            'proj_text'=> $proj_text,
            'proj_label'=> $proj_label,
        ]);

    }

    /**
     * Vyhledani zadaneho tagu v databazi
    */
    public function findTag($tag) {
        return $this->database->fetch('SELECT tag_name FROM tag wHERE tag_name = ?',$tag);
    }

    /**
     * Funkce pro ziskani prjektu z databaze v danem rozmezi
    */
    public function getProjects($min, $max) {
        $count = $this->getCountProject();

        return $this->database->fetchAll('SELECT * FROM project LIMIT ?,4', $min);
    }

    /**
     * Funkce pro ziskani poctu projektu v databazi
    */
    public function getCountProject() {
        return $this->database->fetchField('SELECT COUNT(*) FROM project');
    }

    /**
     * Funkce pro ziskani textu projektu z databaze
    */
    public function getTextProject($id) {
        return $this->database->fetchField('SELECT proj_text FROM project WHERE proj_id = ?', $id);
    }

    /**
     * Funkce pro ziskani jmena projektu z databaze
    */
    public function getNameProject($id) {
        return $this->database->fetchField('SELECT proj_name FROM project WHERE proj_id = ?', $id);
    }

    /**
     * Funkce pro odstraneni projektu z databaze
    */
    public function deleteProject($id) {
        return $this->database->table('project')
        ->where('proj_id', $id)
        ->delete();
    }
}