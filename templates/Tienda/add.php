<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tienda $tienda
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Accciones') ?></h4>
            <?= $this->Html->link(__('Lista Tiendas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tienda form content">
            <?= $this->Form->create($tienda) ?>
            <fieldset>
                <legend><?= __('Agregar Tienda') ?></legend>
                <?php
                    echo $this->Form->control('nombreTienda');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
