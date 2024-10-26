<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Empleado $empleado
 * @var array $puestos
 * @var array $tiendas
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Accciones') ?></h4>
            <?= $this->Html->link(__('Nuevo Empleado'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(
                __('Eliminar Empleado'),
                ['action' => 'delete', $empleado->idEmpleado],
                ['confirm' => __('¿Estas seguro de eliminar el empleado # {0}?', $empleado->idEmpleado), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Lista Empleados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="empleado form content">
            <?= $this->Form->create($empleado, ['type' => 'file']) ?> <!-- Necesitas habilitar el manejo de archivos -->
            <fieldset>
                <legend><?= __('Editar Empleado') ?></legend>
                <?php
                    echo $this->Form->control('idPuesto', [
                        'type' => 'select',
                        'options' => $puestos,
                        'label' => 'Puesto',
                        'empty' => 'Seleccione un puesto'
                    ]);
                    echo $this->Form->control('idTienda', [
                        'type' => 'select',
                        'options' => $tiendas,
                        'label' => 'Tienda',
                        'empty' => 'Seleccione una tienda'
                    ]);
                    echo $this->Form->control('nombres', [
                        'required' => true
                    ]);
                    echo $this->Form->control('apellidos', [
                        'required' => true
                    ]);
                    echo $this->Form->control('fecha_nacimiento', [
                        'type' => 'date',
                        'min' => '1900-01-01',
                        'max' => date('Y-m-d'),
                        'required' => true
                    ]);
                    echo $this->Form->control('fotografia', [
                        'type' => 'file',
                        'label' => 'Fotografía'
                    ]);
                    echo $this->Form->control('salario', [
                        'required' => true
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Actualizar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
