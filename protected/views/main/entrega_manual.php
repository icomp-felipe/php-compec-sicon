<table width="100%">
	<tr>
		<td width="25%">
			<?php echo CHtml::image("images/logo.png", "Logo COMPEC",array("width"=>"60%","heigth"=>"60%"));?>				
		</td>
		<td>
			UNIVERSIDADE FEDERAL DO AMAZONAS<br/>
			COMISSÃO PERMANENTE DE CONCURSOS - COMPEC
		</td>				
    </tr>
</table>

<h2>Lista de Entrega de Manual - <?=$descricaoConcursoSelecionado?></h2>
<h4><?php echo $model->nome; ?> - <?php echo $model->logradouro . (isset($model->numero_endereco)?(", ".$model->numero_endereco):" "). (isset($model->bairro->nome)?(", ".$model->bairro->nome):" "); ?> </h4>

<table class="dataGrid" border="1" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th>#</th>
            <th>Nome Completo</th>
            <th>Função</th>
            <th>Origem</th>
            <th>CPF</th>
            <th>Banco</th>
            <th>Ag&ecirc;ncia</th>
	        <th>Conta</th>
            <th>Recebido</th>
            <th>Dt. Recebimento</th>
            <th>Assinatura</th>	
        </tr>
    </thead>

    <tbody>

        <?php foreach($inscricoes as $n=>$inscricao): ?>

            <tr>
                <td style="font-size:smaller" align="center"><?=$inscricao->colaborador->idColaborador;?></td>
                <td style="font-size:smaller"><?php echo $inscricao->colaborador->nome; ?></td>
                <td style="font-size:smaller" align="center"><?php echo $inscricao->funcao->descricao; ?></td>	
                <td style="font-size:smaller" align="center"><?php echo $inscricao->tipoinscricaoText; ?></td>
                <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->cpf;?>&nbsp;</td>		
                <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->banco->banco_nome;?>&nbsp;</td>		
                <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->agencia; ?>&nbsp;</td>
                <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->contacorrente; ?>&nbsp;</td>
                <td style="font-size:smaller" align="center"><?php echo CHtml::image("images/circulo.gif", "O");?></td>			
                <td style="font-size:smaller" align="center">&nbsp;</td>				
                <td style="font-size:smaller;padding:5; height:35px; vertical-align:middle" align="center" width="300px">&nbsp;</td>	
            </tr>

        <?php endforeach; ?>

    </tbody>
    
</table>