<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Puesto $puesto
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Nuevo Puesto'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Editar Puesto'), ['action' => 'edit', $puesto->idPuesto], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Eliminar Puesto'), ['action' => 'delete', $puesto->idPuesto], ['confirm' => __('¿Estas seguro de eliminar el puesto # {0}?', $puesto->idPuesto), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista Puestos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="puesto view content">
            <h3><?= h($puesto->nombrePuesto) ?></h3>
            <table>
                <tr>
                    <th><?= __('ID Puesto') ?></th>
                    <td><?= $this->Number->format($puesto->idPuesto) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nombre del Puesto') ?></th>
                    <td><?= h($puesto->nombrePuesto) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>