<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recordempleado $recordempleado
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Nuevo Record Empleado'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Eliminar Record Empleado'), ['action' => 'delete', $recordempleado->idRecord], ['confirm' => __('¿Estas seguro de eliminar el record # {0}?', $recordempleado->idRecord), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista Record Empleados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="recordempleado form content">
            <?= $this->Form->create($recordempleado) ?>
            <fieldset>
                <legend><?= __('Editar Record Empleado') ?></legend>
                <?php

                    // Mostrar el ID del registro, pero deshabilitado para que no sea editable
                    echo $this->Form->control('id', [
                        'label' => __('No.Record'),
                        'value' => $recordempleado->idRecord,
                        'disabled' => true
                    ]);

                    // Mostrar el nombre completo del empleado, pero deshabilitado para que no sea editable
                    echo $this->Form->control('empleado_nombre', [
                        'label' => 'Empleado',
                        'value' => $recordempleado->empleado->nombres . ' ' . $recordempleado->empleado->apellidos,
                        'disabled' => true
                    ]);

                    // Campo oculto para el idEmpleado, que es necesario para enviar el valor correcto
                    echo $this->Form->hidden('idEmpleado', ['value' => $recordempleado->idEmpleado]);
                    
                   // echo $this->Form->control('idEmpleado');
                    echo $this->Form->control('descripcion');
                    echo $this->Form->control('tipo_logro');
                    echo $this->Form->control('fecha_ocurrencia');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Actualizar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
