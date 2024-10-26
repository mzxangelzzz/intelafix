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
            <?= $this->Html->link(__('Lista Puestos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="puesto form content">
            <?= $this->Form->create($puesto) ?>
            <fieldset>
                <legend><?= __('Agregar Tienda') ?></legend>
                <?php
                    echo $this->Form->control('nombrePuesto');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
