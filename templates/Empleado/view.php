<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado $empleado
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Nuevo Empleado'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Editar Empleado'), ['action' => 'edit', $empleado->idEmpleado], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Eliminar Empleado'), ['action' => 'delete', $empleado->idEmpleado], ['confirm' => __('¿Estas seguro de eliminar el empleado # {0}?', $empleado->idEmpleado), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista Empleados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="empleado view content">
            <h3><?= $this->Number->format($empleado->idEmpleado) ?> - <?= h($empleado->nombres. ' ' .$empleado->apellidos) ?></h3>
            <table>
                <tr>
                    <th><?= __('ID Empleado') ?></th>
                    <td><?= $this->Number->format($empleado->idEmpleado) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombres') ?></th>
                    <td><?= h($empleado->nombres) ?></td>
                </tr>
                <tr>
                    <th><?= __('Apellidos') ?></th>
                    <td><?= h($empleado->apellidos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Puesto') ?></th>
                    <td><?= h($empleado->puesto->nombrePuesto ?? 'No disponible') ?></td>
                </tr>
                <tr>
                    <th><?= __('Tienda') ?></th>
                    <td><?= h($empleado->tienda->nombreTienda ?? 'No disponible') ?></td>
                </tr>
                <tr>
                    <th><?= __('Salario') ?></th>
                    <td><?= $this->Number->format($empleado->salario) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fecha Nacimiento') ?></th>
                    <td><?= h($empleado->fecha_nacimiento) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fotografía') ?></th>
                    <td>
                        <?php if ($empleado->fotografia): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode(stream_get_contents($empleado->fotografia)) ?>" alt="Fotografía de <?= h($empleado->nombres) ?>" style="max-width: 100px; max-height: 100px;" />
                        <?php else: ?>
                            <span><?= __('No disponible') ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
