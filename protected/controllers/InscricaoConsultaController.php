<?php

class InscricaoConsultaController extends CController {

    public $defaultAction = 'identificacao';

    function getSessionForm() {

		$session = Yii::app()->getSession();

		$form = new FormInscricaoConsulta();

		$form->colab_cpf         = $session["colab_cpf"];
        $form->colaborador = $session["colaborador"];
        $form->concurso    = $session["concurso"];
				
		return $form;
	}

	function setSessionForm($form)	{

		$session = Yii::app()->getSession();

		$session["colab_cpf"]         = $form->colab_cpf;
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
			$funcaoConcurso = funcao_concurso::model()->findByPk($inscricao->mapa->mapa_fconc_id);
			$arquivo = arquivo::model()->findByAttributes(array('arq_conc_id' => $funcaoConcurso->fconc_conc_id, 'arq_tipo' => 4));

            if (!isset($inscricao))
                $this->render('erro', array('form' => $form, 'mensagem' => 'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));
            else
                $this->render('inscricao', array('inscricao' => $inscricao, 'funcaoConcurso' => $funcaoConcurso, 'arquivo' => $funcaoConcurso->fconc_func_id == 1 ? $arquivo : null));

            return;

		}		

		if (isset($form->colaborador)) {

            $concursos = $this->getConcursosColaborador($form->colaborador);

			$this->render('concursos', array('concursos' => $concursos, 'form' => $form));
		}

	}

    public function getConcursosColaborador($colaborador) {
	
		$data = array(
				'join' => 'join funcao_concurso fc on concurso.conc_id_pk = fc.fconc_conc_id
						   join mapa m on fc.fconc_id_pk = m.mapa_fconc_id
						   join inscricao i on m.mapa_id_pk = i.insc_mapa_id',
			    'order' => 'conc_id_pk desc',
			    'condition' => 'insc_ativa and insc_colab_id = :colaborador',
				'params'=>array('colaborador' => $colaborador->colab_id_pk)
			);

		$criteria = new CDbCriteria($data);

		return concurso::model()->findAll($criteria);
	}

    public function loadConcurso($id) {
		return concurso::model()->findbyPk($id);
	}

    public function loadInscricao($idColaborador, $idconcurso) {
        return inscricao::model()->load($idColaborador, $idconcurso);
    }

}