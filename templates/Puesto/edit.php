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
            <?= $this->Form->postLink(
                __('Eliminar Puesto'),
                ['action' => 'delete', $puesto->idPuesto],
                ['confirm' => __('¿Estas seguro de eliminar el puesto # {0}?', $puesto->idPuesto), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Lista Puesto'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="puesto form content">
            <?= $this->Form->create($puesto) ?>
            <fieldset>
                <legend><?= __('Editar Puesto') ?></legend>
                <?php
                    echo $this->Form->control('nombrePuesto');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Actualizar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
