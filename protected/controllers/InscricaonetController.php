<?php

class InscricaonetController extends CController
{

	public $defaultAction='cpfForm';

	function getSessionForm()
	{
		$form = new CpfForm();
		$session=Yii::app()->getSession();
		$form->cpf = $session["cpf"];
		$form->colaborador = $session["colaborador"];
		$form->concurso = $session["concurso"];
		$form->etapa = $session["etapa"];
		$form->instituicao = $session["instituicao"];
		$form->funcao = $session["funcao"];
		$form->banco = $form->colaborador->banco;
		$form->agencia = $form->colaborador->agencia;
		$form->contacorrente = $form->colaborador->contacorrente;
		$form->pispasep = $form->colaborador->pispasep;	
		$form->doc_identidade = $form->colaborador->doc_identidade;	
				
		return $form;
	}

	function setSessionForm($form)
	{
		$session=Yii::app()->getSession();
		$session["cpf"] = $form->cpf;
		$session["colaborador"] = $form->colaborador;
		$session["concurso"] = $form->concurso;
		$session["etapa"] = $form->etapa;
		$session["instituicao"] = $form->instituicao;
		$session["funcao"] = $form->funcao;		
	}
	
	function getUsuario()
	{
	
		$session=Yii::app()->getSession();
		return $session["usuario"];
	
	}

	
	/**
	 * Displays the CPF (Identificação do Contribuinte) page
	 */
	public function actionCpfForm()
	{
		$form=new CpfForm;
		$this->setSessionForm($form);
		// collect user input data
		if(isset($_POST['CpfForm']))
		{
			$form->attributes=$_POST['CpfForm'];
			// validate 
			if($form->validate('cpf')){

				$this->setSessionForm($form);
				
				$this->actionSelecionarConcurso();
				
				return;
			}
		}
		$this->render('cpf',array('form'=>$form));
	}
	
	/**
	 * Exibe a página de seleção do concurso
	 */
	
	public function actionSelecionarConcurso()
	{
			
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if(!isset($form,$form->colaborador))
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
			return;	
		}
		
		if(isset($_GET['idetapa']))
		{
			$form->etapa = $this->loadEtapa($_GET['idetapa']);
			$form->concurso = $form->etapa->concurso;			

			if($form->validate("selecionarConcurso"))
			{						
				$this->setSessionForm($form);			
				$this->actionSelecionarInstituicao();
				return;
			}
		}		

		if(isset($form->cpf))
		{
			$models=$this->getConcursosEmAndamento();

			$this->render('concurso_etapa',array(
				'models'=>$models,
				'form'=>$form,
			));
		}

	}
	
	public function actionSelecionarInstituicao()
	{

		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if(!isset($form,$form->concurso,$form->etapa,$form->colaborador))
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
			return;	
		}
		
		// consulta instituições disponíveis no processo
		$models = $this->getInstituicoesDisponiveis($form->etapa->idetapa);	

		if (count($models) > 0) // há vagas
			// exibe a página de seleção de instituições
			$this->render('instituicao',array(
				'models'=>$models,
				'form'=>$form,
			));
		else
			$this->render('nao_ha_vagas',array('form'=>$form));		
		
	}	
	
	public function actionConfirmacao()
	{
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if(isset($_GET['id']))
		{
			$form->instituicao = $this->loadinstituicao();
		}
		else
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
			return;	
		}
		
		$this->setSessionForm($form);		
		
		// exibe a página de confirmação
		$this->render('confirmacao',array(
			'form'=>$form,
		));
	}	
	
	public function actionConfirmar()
	{
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if (isset($_POST))
		{
		
			$inscricao = new inscricao();
			$inscricao->idinstituicaoopcao1 = $form->instituicao->idinstituicao;
			$inscricao->idconcurso 			= $form->etapa->idconcurso;
			$inscricao->idetapa 			= $form->etapa->idetapa;
			$inscricao->idColaborador		= $form->colaborador->idColaborador;
			$inscricao->selecionado			= 'N';
			//$inscricao->codinscricao		= 'N';
			$inscricao->tipoinscricao		= 1;
			$inscricao->candidatociente		= 'N';		
			$inscricao->idFuncao			= 1;
			$inscricao->dt_hr				= date('Y-m-d H:i:s',time());
		
			if($inscricao->save())
			{
			
				$colaborador = $this->loadcolaborador($inscricao->idColaborador);
				$colaborador->banco = $_POST['CpfForm']['banco'];
				$colaborador->agencia = $_POST['CpfForm']['agencia'];
				$colaborador->contacorrente = $_POST['CpfForm']['contacorrente'];
				$colaborador->pispasep = $_POST['CpfForm']['pispasep'];
				$colaborador->doc_identidade = $_POST['CpfForm']['doc_identidade'];
		
				if ($colaborador->save(false))
				{
					$form->colaborador->banco = $colaborador->banco;
					$form->colaborador->agencia = $colaborador->agencia;
					$form->colaborador->contacorrente = $colaborador->contacorrente;
					$form->colaborador->pispasep = $colaborador->pispasep;
					$form->colaborador->doc_identidade = $colaborador->doc_identidade;
				}
				else
				{									
					$inscricao->delete();
					$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
					return;	
				}	

			}
			else
			{											
				$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
				return;	
			}	
			// redireciona
			$this->redirect(array('confirmado'));
		}
	}	
	
	public function actionConfirmado()
	{
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		$this->render('confirmado',array('form'=>$form));
		
	}		
	
	
	public function loadetapa($id=null)
	{
		if($id!==null || isset($_GET['id']))
			return etapa::model()->findbyPk($id!==null ? $id : $_GET['id']);

		return null;
	}
	public function loadinstituicao($id=null)
	{
		if($id!==null || isset($_GET['id']))
			return instituicao::model()->findbyPk($id!==null ? $id : $_GET['id']);

		return null;
	}
	
	public function loadcolaborador($id)
	{
		return colaborador::model()->findbyPk($id!==null ? $id : $_GET['id']);
	}	
	
	function getCondicaoUsuarioInterno()
	{
		$condicao_usuario_interno='';
		if(UserIdentity::isUsuarioInterno())
			$condicao_usuario_interno = ' || emteste = 1';
		return $condicao_usuario_interno;
	}
	
	public function getConcursosEmAndamento($id=null)
	{
	
	
			$data = array(
					'order'=>'idconcurso desc',
					'condition'=>'datainicioinscricao <= curdate() and datafiminscricao >= curdate() '. $this->getCondicaoUsuarioInterno(),
					);


		$criteria=new CDbCriteria($data);

		return concurso::model()->findAll($criteria);
	}
	
	public function getInstituicoesDisponiveis($idetapa)
	{
		$data = array(
					'order'=>'grupoinstituicao.nome, cod_interno desc',
					'condition'=>' idinstituicao in 
										(select idinstituicao from config_concurso cc1
												where idetapa  = :idetapa 
												  and idfuncao = 1 /*fiscal*/
												  and vagasofertadasnormal > (select count(*) 
												  								from inscricao i1
																			   where cc1.idetapa  = i1.idetapa
																				 and cc1.idfuncao = i1.idfuncao
																				 and cc1.idinstituicao =
																				     i1.idinstituicaoopcao1
																				 and tipoinscricao = 1 /*internet*/))',
					'params'=>array('idetapa'=>$idetapa),
				 );

		$criteria=new CDbCriteria($data);

		return instituicao::model()->with('grupoinstituicao')->findAll($criteria);
	}	
}
