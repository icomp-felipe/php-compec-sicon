<div class="yiiForm">

    <h3>==> Campos com <span class="required">*</span> são de preenchimento obrigatório.</h3>

    <h2>Identificação</h2>

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <!-- Número da Ficha (id do Colaborador) -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'Nº da Ficha'); ?>
        <?php echo CHtml::activeTextField($model,'idColaborador',array('size'=>8,'maxlength'=>10, 'disabled'=>'disabled')); ?>
    </div>

    <!-- Nome -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'nome'); ?>
        <?php echo CHtml::activeTextField($model,'nome',array('size'=>50,'maxlength'=>60)); ?>
    </div>

    <!-- CPF e Data de Nascimento -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'cpf'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'cpf',
            'mask'=>'999.999.999-99',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>11,
                'maxlength'=>11,
            )
        )); ?>

        Dt. Nasc.:

        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'data_nascimento',
            'mask'=>'99/99/9999',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>8,
                'maxlength'=>8,
            )
        )); ?>&nbsp;Ex: 30/10/2010
        
    </div>

    <!-- Sexo -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'sexo'); ?>
        <?php echo CHtml::activeDropDownList($model,'sexo',
												            colaborador::model()->sexoOptions,
												            array('empty'=>'Selecione')); ?>
    </div>

    <!-- Escolaridade -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'idescolaridade'); ?>
        <?php echo CHtml::activeDropDownList($model, 'idescolaridade', 
									CHtml::listData(escolaridade::model()->findAll(),'idescolaridade','descricao'),
									array('empty'=>'Selecione')) ?>
    </div>

    <!-- PIS -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'pispasep'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'pispasep',
            'mask'=>'999.99999.99-9',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>11,
                'maxlength'=>11,
            )
        )); ?>
    </div>

    <!-- Dados do RG -->
    <div class="simple">

        <?php echo CHtml::activeLabelEx($model,'doc_identidade'); ?>
        <?php echo CHtml::activeTextField($model,'doc_identidade',array('size'=>20,'maxlength'=>20)); ?>

        Órgão Emissor

        <?php echo CHtml::activeTextField($model,'orgao_identidade',array('size'=>5,'maxlength'=>10)); ?>

    </div>

    <h2>Endereço</h2>

    <!-- Logradouro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'Rua/Av'); ?>
        <?php echo CHtml::activeTextField($model,'logradouro',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <!-- Número Logradouro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'Número'); ?>
        <?php echo CHtml::activeTextField($model,'numero_endereco',array('size'=>5,'maxlength'=>5)); ?>
    </div>

    <!-- Bairro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'Bairro'); ?>
        <?php echo CHtml::activeTextField($model,'bairro',array('size'=>50,'maxlength'=>80)); ?>
    </div>

    <!-- Município -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'Município'); ?>
        <?php echo CHtml::activeDropDownList($model, 'idmunicipio', 
									CHtml::listData(municipio::model()->findAll(),'idmunicipio','nome'),
									array('empty'=>'Selecione')) ?>
    </div>

    <!-- CEP -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'cep'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'cep',
            'mask'=>'99999-999',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>9,
                'maxlength'=>9,
            )
        )); ?>
    </div>

    <!-- Complemento de Endereço -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'complemento'); ?>
        <?php echo CHtml::activeTextField($model,'complemento',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <h2>Contatos</h2>

    <!-- Celular -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'celular'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'celular',
            'mask'=>'(99) 99999-9999',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>15,
                'maxlength'=>15,
            )
        )); ?>
        
    </div>

    <!-- e-mail -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'email'); ?>
        <?php echo CHtml::activeTextField($model,'email',array('size'=>50,'maxlength'=>60)); ?>
    </div>

    <h2>Informações Bancárias</h2>

    <!-- Nome do Banco -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'banco'); ?>
        <?php echo CHtml::activeTextField($model,'banco',array('size'=>50,'maxlength'=>100)); ?>
    </div>
    
    <!-- Número da Agência -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'agencia'); ?>
        <?php echo CHtml::activeTextField($model,'agencia',array('size'=>10,'maxlength'=>10)); ?>
    </div>

    <!-- Número da Conta -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'contacorrente'); ?>
        <?php echo CHtml::activeTextField($model,'contacorrente',array('size'=>20,'maxlength'=>20)); ?>
    </div>

    <h2>Informações Cadastrais</h2>

    <!-- Tipo de Vínculo com a UFAM -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'tipo_vinculo'); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipo_vinculo', 
									CHtml::listData(tipovinculo::model()->findAll(),'idtipovinculo','nome'),
									array('empty'=>'Selecione')) ?>
    </div>

    <!-- Status do Cadastro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'status_cadastro'); ?>
        <?php echo CHtml::activeDropDownList($model,'status_cadastro',
												            colaborador::model()->statusOptions,
												            array('empty' => 'Selecione', 'disabled' => 'disabled')); ?>
    </div>

    <!-- Observações -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx ($model,'observacoes'); ?>
        <?php echo CHtml::activeTextArea($model,'observacoes', array('rows' => 8, 'cols' => 55, 'disabled' => 'disabled')); ?>
    </div>

    <!-- Fim dos campos de dados -->
    <br>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->