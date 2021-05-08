<div class="yiiForm">

<p>
Arquivos com <span class="required">*</span> s&atilde;o de preenchimento obrigat&oacute;rio.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idescolaridade'); ?>
<?php echo CHtml::activeTextField($model,'idescolaridade'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'iduf_identidade'); ?>
<?php echo CHtml::activeTextField($model,'iduf_identidade'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idmunicipio'); ?>
<?php echo CHtml::activeTextField($model,'idmunicipio'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'nome'); ?>
<?php echo CHtml::activeTextField($model,'nome',array('size'=>60,'maxlength'=>60)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'sexo'); ?>
<?php echo CHtml::activeTextField($model,'sexo',array('size'=>1,'maxlength'=>1)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'data_nascimento'); ?>
<?php echo CHtml::activeTextField($model,'data_nascimento'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'doc_identidade'); ?>
<?php echo CHtml::activeTextField($model,'doc_identidade',array('size'=>20,'maxlength'=>20)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'orgao_identidade'); ?>
<?php echo CHtml::activeTextField($model,'orgao_identidade',array('size'=>10,'maxlength'=>10)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'logradouro'); ?>
<?php echo CHtml::activeTextField($model,'logradouro',array('size'=>50,'maxlength'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'numero_endereco'); ?>
<?php echo CHtml::activeTextField($model,'numero_endereco',array('size'=>5,'maxlength'=>5)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'bairro'); ?>
<?php echo CHtml::activeTextField($model,'bairro',array('size'=>60,'maxlength'=>80)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cep'); ?>
<?php echo CHtml::activeTextField($model,'cep',array('size'=>8,'maxlength'=>8)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'ddd'); ?>
<?php echo CHtml::activeTextField($model,'ddd',array('size'=>2,'maxlength'=>2)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'telefone'); ?>
<?php echo CHtml::activeTextField($model,'telefone',array('size'=>14,'maxlength'=>14)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'celular'); ?>
<?php echo CHtml::activeTextField($model,'celular',array('size'=>14,'maxlength'=>14)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'email'); ?>
<?php echo CHtml::activeTextField($model,'email',array('size'=>60,'maxlength'=>60)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cpf'); ?>
<?php echo CHtml::activeTextField($model,'cpf',array('size'=>11,'maxlength'=>11)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipo_cadastro'); ?>
<?php echo CHtml::activeTextField($model,'tipo_cadastro'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'status_cadastro'); ?>
<?php echo CHtml::activeTextField($model,'status_cadastro'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipo_vinculo'); ?>
<?php echo CHtml::activeTextField($model,'tipo_vinculo'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'anoatualgraduacao'); ?>
<?php echo CHtml::activeTextField($model,'anoatualgraduacao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'matriculaufam'); ?>
<?php echo CHtml::activeTextField($model,'matriculaufam'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cursoufam'); ?>
<?php echo CHtml::activeTextField($model,'cursoufam',array('size'=>60,'maxlength'=>100)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'matriculaservidor'); ?>
<?php echo CHtml::activeTextField($model,'matriculaservidor'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'orgaoservidor'); ?>
<?php echo CHtml::activeTextField($model,'orgaoservidor',array('size'=>60,'maxlength'=>100)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'observacoes'); ?>
<?php echo CHtml::activeTextArea($model,'observacoes',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'banco'); ?>
<?php echo CHtml::activeTextField($model,'banco',array('size'=>60,'maxlength'=>100)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'contacorrente'); ?>
<?php echo CHtml::activeTextField($model,'contacorrente',array('size'=>20,'maxlength'=>20)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'agencia'); ?>
<?php echo CHtml::activeTextField($model,'agencia',array('size'=>10,'maxlength'=>10)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'pispasep'); ?>
<?php echo CHtml::activeTextField($model,'pispasep',array('size'=>18,'maxlength'=>18)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipo_vinculo_old'); ?>
<?php echo CHtml::activeTextField($model,'tipo_vinculo_old'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->