<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Recordempleado $recordempleado
 * @var array $empleados Lista de empleados para el dropdown (nombres y apellidos concatenados)
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Lista Record Empleados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="recordempleado form content">
            <?= $this->Form->create($recordempleado) ?>
            <fieldset>
                <legend><?= __('Agregar Record Empleado') ?></legend>
                <?php
                    // Mostrar dropdown de empleados con nombres y apellidos concatenados
                    echo $this->Form->control('idEmpleado', [
                        'label' => 'Empleado',
                        'options' => $empleados, // Lista de empleados que viene desde el controlador
                        'empty' => 'Seleccione un empleado', // Opción vacía
                    ]);
                     
                    echo $this->Form->control('descripcion');
                    echo $this->Form->control('tipo_logro', ['label' => 'Logro positivo']);
                    echo $this->Form->control('fecha_ocurrencia', ['type' => 'date']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
