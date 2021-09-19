<?php

class InscricaoConsultaController extends CController {

    public $defaultAction = 'identificacao';

    function getSessionForm() {

		$session = Yii::app()->getSession();

		$form = new FormInscricaoConsulta();

		$form->cpf         = $session["cpf"];
        $form->colaborador = $session["colaborador"];
        $form->concurso    = $session["concurso"];
				
		return $form;
	}

	function setSessionForm($form)	{

		$session = Yii::app()->getSession();

		$session["cpf"]         = $form->cpf;
        $session["colaborador"] = $form->colaborador;
        $session["concurso"]    = $form->concurso;

	}

    public function actionIdentificacao() {

		$form = new FormInscricaoConsulta;
		$this->setSessionForm($form);

		if(isset($_POST['FormInscricaoConsulta'])) {

			$form->attributes = $_POST['FormInscricaoConsulta'];
			
			if ($form->validate('identificacao')){

				$this->setSessionForm($form);
				$this->actionSelecionarConcurso();
				
				return;
			}

		}

		$this->render('identificacao', array('form' => $form));
	}

    public function actionSelecionarConcurso() {
			
		$form = $this->getSessionForm();
		
		if (!isset($form, $form->colaborador)) {
			$this->render('erro',array('form' => $form, 'mensagem' => 'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));
			return;
		}
		
		if(isset($_GET['id'])) {

            $inscricao = $this->loadInscricao($form->colaborador->colab_id_pk, $_GET['id']);

            if (!isset($inscricao))
                $this->render('erro', array('form' => $form, 'mensagem' => 'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));
            else
                $this->render('inscricao', array('inscricao' => $inscricao));

            return;

		}		

		if (isset($form->colaborador)) {

            $concursos = $this->getConcursosColaborador($form->colaborador);

			$this->render('concursos', array('concursos' => $concursos, 'form' => $form));
		}

	}

    public function getConcursosColaborador($colaborador) {
	
		$data = array(
			    'order'     => 'idconcurso desc',
			    'condition' => 'idconcurso in (select distinct(idconcurso) from inscricao where idColaborador = ' . $colaborador->colab_id_pk . ')'
			);


		$criteria = new CDbCriteria($data);

		return concurso::model()->findAll($criteria);
	}

    public function loadConcurso($id) {
		return concurso::model()->findbyPk($id);
	}

    public function loadInscricao($idColaborador, $idconcurso) {
        return inscricao::model()->findByAttributes(array('idColaborador' => $idColaborador, 'idconcurso' => $idconcurso));
    }

}