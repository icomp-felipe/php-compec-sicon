<?php
/*header('Content-type: application/xls');
header('Content-Disposition: attachment; filename="downloaded.xls"');*/
?>

<table width="100%">
	<tr>
		<td width="25%">
			<?php echo CHtml::image("images/logo.png", "Logo COMPEC",array("width"=>"60%","heigth"=>"60%"));?>				
		</td>
		<td>
			UNIVERSIDADE FEDERAL DO AMAZONAS<br/>
			COMISS&Atilde;O PERMANENTE DE CONCURSOS - COMPEC
		</td>				
  </tr>
</table>
		


<h2>Registro de Entrega de Folder - <?=$descricaoConcursoSelecionado?></h2>
<h4><?php echo $model->nome; ?> - <?php echo $model->logradouro . (isset($model->numero_endereco)?(", ".$model->numero_endereco):" "). (isset($model->bairro->nome)?(", ".$model->bairro->nome):" "); ?> </h4>
<table class="dataGrid" border="1" cellspacing="0" width="100%">
  <thead>
  <tr>
	<th class="label" colspan="11">REGISTROS DE ENTREGA DE FOLDER </th>
  </tr>  
  <tr>
    <th colspan="2">Colaborador</th>
    <th>Fun&ccedil;&atilde;o</th>
    <th>Tipo Insc.</th>
    <th>CPF</th>	
    <th>Banco</th>	
    <th>Ag&ecirc;ncia</th>
	<th>C.C.</th>
    <th>Recebido</th>	
    <th>Dt. Recebimento</th>			
    <th>Assinatura</th>			
  </tr>
  </thead>
  <tbody>


<?php 
	foreach($inscricoes as $n=>$inscricao): 
?>
  <tr>
    <td style="font-size:smaller"><?=$inscricao->colaborador->idColaborador;?></td>
    <td style="font-size:smaller"><?php echo $inscricao->colaborador->nome; ?></td>
    <!--td style="font-size:smaller;padding-left:10;padding-right:10" align="center"><rr?$inscricao->colaborador->getCodigoBarras2();?></td-->	
    <td style="font-size:smaller" align="center"><?php echo $inscricao->funcao->descricao; ?></td>	
    <td style="font-size:smaller" align="center"><?php echo $inscricao->tipoinscricaoText; ?></td>
    <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->cpf;?>&nbsp;</td>		
    <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->banco;?>&nbsp;</td>		
    <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->agencia; ?>&nbsp;</td>
    <td style="font-size:smaller" align="center"><?php echo $inscricao->colaborador->contacorrente; ?>&nbsp;</td>
    <td style="font-size:smaller" align="center"><?php echo CHtml::image("images/circulo.gif", "O");?></td>			
    <td style="font-size:smaller" align="center">&nbsp;</td>				
    <td style="font-size:smaller;padding:5; height:35px; vertical-align:middle" align="center" width="300px">&nbsp;</td>	
  </tr>
<?php endforeach; ?>
  </tbody>
</table>

