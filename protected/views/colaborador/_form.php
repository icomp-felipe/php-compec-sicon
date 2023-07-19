<div class="yiiForm">

    <h3>==> Campos com <span class="required">*</span> são de preenchimento obrigatório.</h3>

    <h2>Identificação</h2>

    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <!-- Número da Ficha (id do Colaborador) -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_id_pk'); ?>
        <?php echo CHtml::activeTextField($model,'colab_id_pk',array('size'=>8,'maxlength'=>10, 'disabled'=>'disabled')); ?>
    </div>

    <!-- Nome -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_nome'); ?>
        <?php echo CHtml::activeTextField($model,'colab_nome',array('size'=>50,'maxlength'=>60)); ?>
    </div>

    <!-- CPF e Data de Nascimento -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_cpf'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'colab_cpf',
            'mask'=>'999.999.999-99',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>11,
                'maxlength'=>11,
            )
        )); ?>
        
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_nascimento'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'colab_nascimento',
            'mask'=>'99/99/9999',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>8,
                'maxlength'=>8,
            )
        )); ?>
    </div>

    <!-- Sexo -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_sexo'); ?>
        <?php echo CHtml::activeDropDownList($model,'colab_sexo',
												            colaborador::model()->sexoOptions,
												            array('empty'=>'Selecione')); ?>
    </div>

    <!-- PIS -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_pis'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'colab_pis',
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

        <?php echo CHtml::activeLabelEx($model,'colab_rg'); ?>
        <?php echo CHtml::activeTextField($model,'colab_rg',array('size'=>20,'maxlength'=>20)); ?>

        Órgão Emissor

        <?php echo CHtml::activeTextField($model,'colab_rg_orgao',array('size'=>5,'maxlength'=>10)); ?>

    </div>

    <h2>Endereço</h2>

    <!-- Logradouro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_logradouro'); ?>
        <?php echo CHtml::activeTextField($model,'colab_logradouro',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <!-- Número Logradouro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_logradouro_numero'); ?>
        <?php echo CHtml::activeTextField($model,'colab_logradouro_numero',array('size'=>5,'maxlength'=>5)); ?>
    </div>

    <!-- Bairro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_bairro'); ?>
        <?php echo CHtml::activeTextField($model,'colab_bairro',array('size'=>50,'maxlength'=>80)); ?>
    </div>

    <!-- Município -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_municipio_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'colab_municipio_id', 
									CHtml::listData(municipio::model()->findAll(),'muni_id_pk','muni_nome'),
									array('empty'=>'Selecione')) ?>
    </div>

    <!-- CEP -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_cep'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'colab_cep',
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
        <?php echo CHtml::activeLabelEx($model,'colab_complemento'); ?>
        <?php echo CHtml::activeTextField($model,'colab_complemento',array('size'=>50,'maxlength'=>50)); ?>
    </div>

    <h2>Contatos</h2>

    <!-- Celular -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_celular_1'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'colab_celular_1',
            'mask'=>'99 99999-9999',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>15,
                'maxlength'=>15,
            )
        )); ?>
        
    </div>

    <!-- e-mail -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_email'); ?>
        <?php echo CHtml::activeTextField($model,'colab_email',array('size'=>50,'maxlength'=>60)); ?>
    </div>

    <h2>Informações Bancárias</h2>

    <!-- Banco -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_banco_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'colab_banco_id', 
									CHtml::listData(banco::model()->findAll(),'banco_id_pk','bancoComCodigo'),
									array('empty'=>'Selecione')) ?>
    </div>
    
    <!-- Número da Agência -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_agencia'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'colab_agencia',
            'mask'=>'9999',
            'placeholder'=>'_',
            'htmlOptions'=>array(
                'size'=>20,
                'maxlength'=>20,
            )
        )); ?>
    </div>

    <!-- Número da Conta -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_conta'); ?>
        <?php echo CHtml::activeTextField($model,'colab_conta',array('size'=>20,'maxlength'=>20)); ?>
    </div>

    <!-- Dígito da Conta -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_conta_dv'); ?>
        <?php echo CHtml::activeTextField($model,'colab_conta_dv',array('size'=>1,'maxlength'=>1)); ?>
    </div>

    <h2>Informações Cadastrais</h2>

    <!-- Tipo de Vínculo com a UFAM -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_categoria_id'); ?>
        <?php echo CHtml::activeDropDownList($model, 'colab_categoria_id', 
									CHtml::listData(categoria::model()->findAll(),'categ_id_pk','categ_nome'),
									array('empty' => 'Selecione')) ?>
    </div>

    <!-- Status do Cadastro -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_status'); ?>
        <?php echo CHtml::activeDropDownList($model,'colab_status',
												            colaborador::model()->statusOptions,
												            array('empty' => 'Ativado', 'disabled' => 'disabled')); ?>
    </div>

    <!-- Fim dos campos de dados -->
    <br>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->