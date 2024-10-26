<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Empleado> $empleado
 */
?>
<div class="empleado index content">
    <?= $this->Html->link(__('Nuevo Empleado'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <?= $this->Html->link(__('Generar PDF de Empleados'), ['action' => 'generateEmployeePdf'], ['class' => 'button float-right', 'style' => 'margin-right: 10px;']) ?>
    <?= $this->Html->link(__('Generar PDF de Tienda'), ['action' => 'generateSalaryPdf'], ['class' => 'button float-right', 'style' => 'margin-right: 10px;']) ?>
    <h3><?= __('Empleados') ?></h3>
    <div class="table-responsive">
        <table class="wide-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('ID' . "\n" . 'Empleado') ?></th>
                    <th><?= $this->Paginator->sort('Fotografia') ?></th>
                    <th><?= $this->Paginator->sort('Nombre Completo') ?></th>
                    <th><?= $this->Paginator->sort('Fecha' . "\n" . 'Nacimiento') ?></th>
                    <th><?= $this->Paginator->sort('Puesto') ?></th>
                    <th><?= $this->Paginator->sort('Tienda') ?></th>
                    <th><?= $this->Paginator->sort('Salario') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?= $this->Number->format($empleado->idEmpleado) ?></td>
                    <td><?php if ($empleado->fotografia): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode(stream_get_contents($empleado->fotografia)) ?>" alt="Fotografía de <?= h($empleado->nombres) ?>" style="max-width: 100px; max-height: 100px;" />
                        <?php else: ?>
                            <span><?= __('No disponible') ?></span>
                        <?php endif; ?></td>
                    <td><?= h($empleado->nombres . ' ' . $empleado->apellidos) ?></td>
                    <td><?= h($empleado->fecha_nacimiento) ?></td>
                    <td><?= h($empleado->puesto->nombrePuesto) ?></td>
                    <td><?= h($empleado->tienda->nombreTienda) ?></td>
                    <td><?= $this->Number->format($empleado->salario) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $empleado->idEmpleado]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $empleado->idEmpleado]) ?>
                        <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $empleado->idEmpleado], ['confirm' => __('¿Estas seguro de eliminar el empleado # {0}?', $empleado->idEmpleado)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="total-salary">
        <h4><?= __('Total Salario: ') . $this->Number->format($totalSalario) ?></h4>
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

