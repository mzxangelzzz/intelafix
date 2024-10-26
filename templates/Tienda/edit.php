<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tienda $tienda
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Nueva Tienda'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Eliminar Tienda'),
                ['action' => 'delete', $tienda->idTienda],
                ['confirm' => __('¿Estas seguro de eliminar la tienda # {0}?', $tienda->idTienda), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Lista Tiendas'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="tienda form content">
            <?= $this->Form->create($tienda) ?>
            <fieldset>
                <legend><?= __('Editar Tienda') ?></legend>
                <?php
                    echo $this->Form->control('nombreTienda');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Actualizar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
