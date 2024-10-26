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
            <h4 class="heading"><?= __('Acciones') ?></h4>
            <?= $this->Html->link(__('Lista Empleados'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="empleado form content">
            <?= $this->Form->create($empleado, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Agregar Empleado') ?></legend>
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
                        'required' => true // Añadir esta línea
                    ]);
                    echo $this->Form->control('apellidos', [
                        'required' => true // Añadir esta línea
                    ]);
                    echo $this->Form->control('fecha_nacimiento', [
                        'type' => 'date',
                        'min' => '1900-01-01', // Fecha mínima
                        'max' => date('Y-m-d'), // Fecha máxima (hoy)
                        'required' => true // Añadir esta línea
                    ]);
                    echo $this->Form->control('fotografia', [ // Cambiar 'Fotografia' a 'fotografia'
                        'type' => 'file',
                        'label' => 'Fotografía',
                        'required' => true // Añadir esta línea
                    ]);
                    echo $this->Form->control('salario', [
                        'required' => true // Añadir esta línea
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Guardar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
