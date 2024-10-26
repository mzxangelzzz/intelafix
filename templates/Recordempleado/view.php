<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recordempleado $recordempleado
 * @var \App\Model\Entity\Empleado $empleado
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Nuevo Record Empleado'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Editar Record Empleado'), ['action' => 'edit', $recordempleado->idRecord], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Eliminar Record Empleado'), ['action' => 'delete', $recordempleado->idRecord], ['confirm' => __('¿Estas seguro de eliminar el record # {0}?', $recordempleado->idRecord), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista Record Empleados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="recordempleado view content">
            <h3><?= h($recordempleado->idRecord) ?> - <?= h($recordempleado->empleado->nombres . ' ' . $recordempleado->empleado->apellidos) ?></h3>
            <table>
                <tr>
                    <th><?= __('No.Record') ?></th>
                    <td><?= $this->Number->format($recordempleado->idRecord) ?></td>
                </tr>
                <tr>
                    <th><?= __('Codigo y Nombre Empleado') ?></th>
                    <td>
                        <?= h($recordempleado->idEmpleado) ?> - 
                        <?= h($recordempleado->empleado->nombres . ' ' . $recordempleado->empleado->apellidos) ?>
                    </td>
                </tr>
                <tr>
                    <th><?= __('Fecha Ocurrencia') ?></th>
                    <td><?= h($recordempleado->fecha_ocurrencia->format('d/m/Y')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Logro Positivo') ?></th>
                    <td><?= $recordempleado->tipo_logro ? __('SI') : __('NO'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Descripcion') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($recordempleado->descripcion)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>