<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Tienda> $tienda
 */
?>
<div class="tienda index content">
    <?= $this->Html->link(__('Nueva Tienda'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('Generar PDF de Tienda'), ['action' => 'generateSalaryPdf'], ['class' => 'button float-right', 'style' => 'margin-right: 10px;']) ?>
    <h3><?= __('Tienda') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID Tienda') ?></th>
                    <th><?= $this->Paginator->sort('Nombre de la Tienda') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tienda as $tienda): ?>
                <tr>
                    <td><?= $this->Number->format($tienda->idTienda) ?></td>
                    <td><?= h($tienda->nombreTienda) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $tienda->idTienda]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $tienda->idTienda]) ?>
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $tienda->idTienda], ['confirm' => __('¿Estas seguro de eliminar la tienda # {0}?', $tienda->idTienda)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>