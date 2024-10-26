<?php
declare(strict_types=1);

namespace App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Empleado Controller
 *
 * @property \App\Model\Table\EmpleadoTable $Empleado
 * @property \App\Model\Table\PuestoTable $Puesto
 * @property \App\Model\Table\TiendaTable $Tienda
 */
class EmpleadoController extends AppController
{
    public function index()
    {
        // Obtener todos los empleados con sus puestos y tiendas
        $query = $this->Empleado->find()
            ->contain(['Puesto', 'Tienda'])
            ->order(['Empleado.idEmpleado' => 'ASC']);
        
        $empleados = $this->paginate($query);
    
        // Calcular el salario total
        $totalSalario = $this->Empleado->find()
            ->select(['total' => $this->Empleado->find()->func()->sum('salario')])
            ->first()
            ->total;
    
        $this->set(compact('empleados', 'totalSalario'));
    }
    


    public function view($id = null)
    {
        $empleado = $this->Empleado->get($id, [
            'contain' => ['Puesto', 'Tienda'] // Cargar las asociaciones necesarias
        ]);
        $this->set(compact('empleado'));
    }

    public function generateSalaryPdf()
{
    // Obtener todos los registros de empleados agrupados por tienda
    $empleados = $this->Empleado->find('all')->contain(['Tienda'])->order(['Empleado.salario' => 'DESC']);
    
    // Agrupar empleados por tienda
    $empleadosPorTienda = [];
    foreach ($empleados as $empleado) {
        $tiendaNombre = $empleado->tienda->nombreTienda; // Asegúrate que la relación esté definida
        if (!isset($empleadosPorTienda[$tiendaNombre])) {
            $empleadosPorTienda[$tiendaNombre] = [];
        }
        $empleadosPorTienda[$tiendaNombre][] = $empleado;
    }

    // Configuración de Dompdf
    $options = new Options();
    $options->set('defaultFont', 'Helvetica');
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $fechaConsulta = date('d/m/Y H:i:s');

    // Generar el contenido HTML para el PDF
    $html = '
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 5px;
        }
        .fecha-consulta {
            text-align: right;
            font-size: 12px;
            color: #555;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 20px; /* Añadido margen entre tablas */
        }
        th {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
        }
        td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>

    <h1>Listado de Salarios de Empleados por Tienda</h1>
    <div class="fecha-consulta">Fecha de consulta: ' . $fechaConsulta . '</div>';

    // Generar una tabla por cada tienda
    foreach ($empleadosPorTienda as $tiendaNombre => $empleados) {
        $html .= '<h2>' . h($tiendaNombre) . '</h2>'; // Título de la tienda
        $html .= '<table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID Empleado</th>
                    <th>Nombre Completo</th>
                    <th>Salario</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($empleados as $empleado) {
            $html .= '<tr>';
            $html .= '<td>' . h($empleado->idEmpleado) . '</td>';
            $html .= '<td>' . h($empleado->nombres . ' ' . $empleado->apellidos) . '</td>';
            $html .= '<td>' . h($empleado->salario) . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
    }

    try {
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    } catch (\Exception $e) {
        echo 'Error al generar PDF: ' . $e->getMessage();
        return; // Termina la ejecución si hay un error
    }

    // Enviar el PDF al navegador para descarga
    $dompdf->stream("Reporte_Salarios_Empleados.pdf", ["Attachment" => 1]);

    // Finaliza la ejecución
    return $this->response->withType('pdf');
}

    public function generateEmployeePdf()
{
    // Obtener todos los empleados
    $empleados = $this->Empleado->find('all')->contain(['Puesto', 'Tienda']);

    // Configuración de Dompdf con opciones
    $options = new Options();
    $options->set('defaultFont', 'Helvetica');
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $fechaConsulta = date('d/m/Y H:i:s');
    $totalSalario = 0;

    // Generar el contenido HTML para el PDF
    $html = '
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        h1 { text-align: center; color: #4CAF50; font-size: 24px; margin-bottom: 5px; }
        .fecha-consulta { text-align: right; font-size: 12px; color: #555; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th { background-color: #4CAF50; color: white; padding: 8px; }
        td { padding: 8px; border: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        img { width: 50px; height: auto; } /* Ajustar el tamaño de la fotografía */
    </style>

    <h1>Listado General de Empleados</h1>
    <div class="fecha-consulta">Fecha de consulta: ' . $fechaConsulta . '</div>
    
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID Empleado</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha de Nacimiento</th>
                <th>Fotografía</th>
                <th>Salario</th>
                <th>Puesto</th>
                <th>Tienda</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($empleados as $empleado) {
        $html .= '<tr>';
        $html .= '<td>' . h($empleado->idEmpleado) . '</td>';
        $html .= '<td>' . h($empleado->nombres) . '</td>';
        $html .= '<td>' . h($empleado->apellidos) . '</td>';
        $html .= '<td>' . h($empleado->fecha_nacimiento->format('d/m/Y')) . '</td>';
        $html .= '<td>' . ($empleado->fotografia ? '<img src="data:image/jpeg;base64,'.base64_encode(stream_get_contents($empleado->fotografia)).'" />' : 'Sin fotografía') . '</td>';
        $html .= '<td>' . h($empleado->salario) . '</td>';
        $html .= '<td>' . ($empleado->puesto ? h($empleado->puesto->nombrePuesto) : 'Sin puesto') . '</td>';
        $html .= '<td>' . ($empleado->tienda ? h($empleado->tienda->nombreTienda) : 'Sin tienda') . '</td>';
        $html .= '</tr>';
        
        // Acumulando el salario total
        $totalSalario += $empleado->salario;
    }

    $html .= '</tbody></table>';

    // Añadir total de salarios al final del documento
    $html .= '<h2>Total Salario: ' . h(number_format($totalSalario, 2)) . '</h2>';

    try {
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    } catch (\Exception $e) {
        echo 'Error al generar PDF: ' . $e->getMessage();
        return;
    }

    // Enviar el PDF al navegador para descarga
    $dompdf->stream("Reporte_Empleados.pdf", ["Attachment" => 1]);
    
    // Finaliza la ejecución
    return $this->response->withType('pdf');
}


    public function add()
    {
        $empleado = $this->Empleado->newEmptyEntity();

        // Obtener la lista de puestos
        $puestos = $this->Empleado->Puesto->find('list', [
            'keyField' => 'idPuesto',
            'valueField' => 'nombrePuesto'
        ])->toArray();

        // Obtener la lista de tiendas
        $tiendas = $this->Empleado->Tienda->find('list', [
            'keyField' => 'idTienda',
            'valueField' => 'nombreTienda'
        ])->toArray();

        if ($this->request->is('post')) {
            // Aplicar los datos al nuevo empleado
            $empleado = $this->Empleado->patchEntity($empleado, $this->request->getData());

            // Calcular la edad
            $fechaNacimiento = new \Cake\I18n\FrozenDate($empleado->fecha_nacimiento);
            $hoy = new \Cake\I18n\FrozenDate();
            $edad = $hoy->year - $fechaNacimiento->year;

            // Ajustar la edad si el cumpleaños no ha ocurrido este año
            if ($hoy->month < $fechaNacimiento->month || 
                ($hoy->month === $fechaNacimiento->month && $hoy->day < $fechaNacimiento->day)) {
                $edad--;
            }

            // Validar que el empleado tenga 18 años o más
            if ($edad < 18) {
                $this->Flash->error(__('El empleado debe ser mayor de 18 años.'));
            } else {
                // Manejo de la fotografía
                $file = $this->request->getData('fotografia');
                if ($file && $file->getError() == UPLOAD_ERR_OK) {
                    $empleado->fotografia = file_get_contents($file->getStream()->getMetadata('uri'));
                } else {
                    $this->Flash->error(__('No se pudo cargar la fotografía. Por favor, inténtelo de nuevo.'));
                }

                // Guardar el empleado en la base de datos
                if ($this->Empleado->save($empleado)) {
                    $this->Flash->success(__('El empleado ha sido registrado.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo registrar el empleado. Por favor, inténtelo de nuevo.'));
            }
        }

        // Pasar las listas a la vista
        $this->set(compact('empleado', 'puestos', 'tiendas'));
    }

    public function edit($id = null)
    {
        $empleado = $this->Empleado->get($id, [
            'contain' => ['Puesto', 'Tienda'] // Cargar las asociaciones necesarias
        ]);
        $puestos = $this->Empleado->Puesto->find('list', [
            'keyField' => 'idPuesto',
            'valueField' => 'nombrePuesto'
        ])->toArray();
        $tiendas = $this->Empleado->Tienda->find('list', [
            'keyField' => 'idTienda',
            'valueField' => 'nombreTienda'
        ])->toArray();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $empleado = $this->Empleado->patchEntity($empleado, $this->request->getData());

            // Calcular la edad
            $fechaNacimiento = new \Cake\I18n\FrozenDate($empleado->fecha_nacimiento);
            $hoy = new \Cake\I18n\FrozenDate();
            $edad = $hoy->year - $fechaNacimiento->year;

            // Ajustar la edad si el cumpleaños no ha ocurrido este año
            if ($hoy->month < $fechaNacimiento->month || 
                ($hoy->month === $fechaNacimiento->month && $hoy->day < $fechaNacimiento->day)) {
                $edad--;
            }

            // Validar que el empleado tenga 18 años o más
            if ($edad < 18) {
                $this->Flash->error(__('El empleado debe ser mayor de 18 años.'));
            } else {
                // Manejo de fotografía al editar
                $file = $this->request->getData('fotografia');
                if ($file && $file->getError() == UPLOAD_ERR_OK) {
                    $empleado->fotografia = file_get_contents($file->getStream()->getMetadata('uri'));
                }

                if ($this->Empleado->save($empleado)) {
                    $this->Flash->success(__('El empleado ha sido actualizado.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo actualizar el empleado. Por favor, inténtelo de nuevo.'));
            }
        }

        // Pasar las listas a la vista
        $this->set(compact('empleado', 'puestos', 'tiendas'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $empleado = $this->Empleado->get($id);
        if ($this->Empleado->delete($empleado)) {
            $this->Flash->success(__('El empleado ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el empleado. Por favor, inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
