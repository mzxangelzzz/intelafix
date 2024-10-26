<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Puesto> $puesto
 */
?>
<div class="puesto index content">
    <?= $this->Html->link(__('Nuevo Puesto'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Puesto') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID Puesto') ?></th>
                    <th><?= $this->Paginator->sort('Nombre del Puesto') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($puesto as $puesto): ?>
                <tr>
                    <td><?= $this->Number->format($puesto->idPuesto) ?></td>
                    <td><?= h($puesto->nombrePuesto) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $puesto->idPuesto]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $puesto->idPuesto]) ?>
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $puesto->idPuesto], ['confirm' => __('¿Estas seguro de eliminar el puesto # {0}?', $puesto->idPuesto)]) ?>
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