<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Recordempleado> $recordempleado
 */
?>
<div class="recordempleado index content">
    <?= $this->Html->link(__('Nuevo Record de Empleado'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('Generar PDF'), ['action' => 'generatePdf'], ['class' => 'button float-right', 'style' => 'margin-right: 10px;']) ?>
    <h3><?= __('Record Empleado') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('No.Record') ?></th>
                    <th><?= $this->Paginator->sort('Nombre del Empleado') ?></th>
                    <th><?= $this->Paginator->sort('Logro Positivo') ?></th>
                    <th><?= $this->Paginator->sort('Fecha Ocurrencia') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recordempleado as $recordempleado): ?>
                <tr>
                    <td><?= $this->Number->format($recordempleado->idRecord) ?></td>
                    <td>
                        <?= $recordempleado->empleado ? h($recordempleado->empleado->nombres . ' ' . $recordempleado->empleado->apellidos) : __('Empleado no asignado') ?>
                    </td>
                    <td>
                    <?= $recordempleado->tipo_logro ? __('SI') : __('NO'); ?>
                    </td>
                    <td><?= h($recordempleado->fecha_ocurrencia->format('d/m/Y')) ?></td>
                       <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $recordempleado->idRecord]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $recordempleado->idRecord]) ?>
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $recordempleado->idRecord], ['confirm' => __('¿Estas seguro de eliminar el record # {0}?', $recordempleado->idRecord)]) ?>
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