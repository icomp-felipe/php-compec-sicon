<h2>Lista de Documentos por Concurso</h2>

<table class="dataGrid">

    <thead>
        <tr>
            <th>Nome do Concurso</th>
            <th>Documento</th>
        </tr>
    </thead>

    <tbody>

        <?php $index = 0; $concurso = null; ?>

        <?php foreach($docs as $n=>$doc): ?>

            <?php if ($concurso != $doc->concurso): ?>
                <?php $index = $index + 1; ?>
                <?php $concurso = $doc->concurso; ?>
            <?php endif; ?>

            <tr class="<?php echo $index % 2 ? 'even' : 'odd';?>">

                <td>
                    <?php echo CHtml::encode($doc->concurso->conc_nome); ?>
                </td>

                <td>
                    <a href="<?php echo $doc->arq_caminho; ?>" target="_blank" rel="noopener noreferrer"><?php echo $doc->arq_nome; ?></a>
                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>