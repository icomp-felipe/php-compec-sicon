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

    <h2>Contatos</h2>

    <!-- Celular -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'colab_celular'); ?>
        <?php $this->widget('CMaskedTextField',array(
            'model'=>$model,
            'attribute'=>'colab_celular',
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

    <!-- Fim dos campos de dados -->
    <br>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->