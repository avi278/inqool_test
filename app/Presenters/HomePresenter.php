<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\HomeModel;

use Nette;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Nette\Application\UI\Presenter
{
	private HomeModel $model;
	private $min;
	private $max;

    private $options = array('cost' => 11);

    public function __construct(Nette\Database\Explorer $database) {
        $this->model = new HomeModel($database);
		if (session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_DISABLED)
		{
			session_start();
			$_SESSION['num'] = 0;
		}
    }



    public function beforeRender() : void
    {
        $this->redrawControl('projslider');
		$this->redrawControl('addform');
		$this->redrawControl('portfolio');

    }

	/**
     * Vykreslovaci funkce
    */
	public function renderDefault($num) : void
	{
		$this->template->num = $this->model->getCountProject();
		$this->template->project = $this->model->getProjects($_SESSION['num'],$_SESSION['num']+4);
	}

	/**
     * Formular pro vytvoreni noveho projektu
    */
    protected function createComponentProjInsertForm(): Form
	{
		$labels = [
			1 => 'IT',
			2 => 'Art',
			3 => 'Free time',
			4 => 'Games',
		];
				
		$form = new Form;
		$form->addText('name')->setRequired();

		$form->addTextArea('text')->setRequired()
				->addRule($form::MaxLength, 'Description is too long', 60);
		
		$form->addSelect('label', "Label: ",$labels)
				->setDefaultValue(1);


		$form->addSubmit('send');

		$form->onSuccess[] = [$this, 'ProjFormSucceeded'];
		return $form;
	}

    /**
     * Zpracovani vytvoreni noveho projektu po stiknuti "Create"
    */
	public function ProjFormSucceeded(Form $form, \stdClass $data): void
	{
        $this->model->insertProj($data->name,$data->text,$data->label);
		$this->redrawControl('addform');

	}




	/**
     * Formular pro vyhledavani na strance podle tagu
    */
	protected function createComponentSearchForm(): Form
	{
		$form = new Form;
		$form->addText('tag')->setRequired();

		$form->addSubmit('send');

		$form->onSuccess[] = [$this, 'SearchFormSucceeded'];
		return $form;
	}

    /**
     * Zpracovani vyhledavani po stiknuti lupy
    */
	public function SearchFormSucceeded(Form $form, \stdClass $data): void
	{

        $tag = $this->model->findTag($data->tag);

		if ($tag == NULL)
		{
			$this->flashMessage('Nesprávné údaje');
			$this->redrawControl('flashMessage');
			$this->redrawControl('content');
		}
		else
		{
			$redirect = 'http://localhost:8000/#'.$tag->tag_name;
			$this->redirectUrl($redirect);
		}
	}

	/**
     * Funkce pro posunuti slideru doprava 
    */
	public function handleNext() 
	{
		if ($this->isAjax())
        {
			$_SESSION['num']++;
			$this->redrawControl('projslider');
		}
	}

	/**
     * Funkce pro posunuti slideru doleva 
    */
	public function handlePrev() 
	{
		if ($this->isAjax())
        {
			$_SESSION['num']--;
			$this->redrawControl('projslider');
		}	
	}

	/**
     * Funkce pro odstraneni projektu
    */
	public function handleDelete($id) 
	{
		if ($this->isAjax())
        {
			if ($_SESSION['num'] > 1) {
				$_SESSION['num']--;
			}

			$this->model->deleteProject($id);
			$this->redrawControl('projslider');
		}	
	}


}
