<?php

/** Controlador da view de documentos.
 *  Revisado em: 10/05/2021
 *  Felipe André - felipeandresouza@hotmail.com */
class DocumentosController extends CController {

	/** Comportamento da homepage */
	public function actionIndex() {
		
		$docs = arquivo::model()->findAll(array('condition' => 'arq_tipo <> 4', 'order' => 'arq_conc_id desc, arq_tipo'));

		// Renderizando o index
		$this->render('lista', array('docs' => $docs));

	}

}