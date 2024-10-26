<?php
declare(strict_types=1);


namespace App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * Recordempleado Controller
 *
 * @property \App\Model\Table\RecordempleadoTable $Recordempleado
 */
class RecordempleadoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
   /*
    public function index()
    {
        $query = $this->Recordempleado->find();
        $recordempleado = $this->paginate($query);

        $this->set(compact('recordempleado'));
    }
        */

        public function generatePdf()
        {
            
            // Obtener todos los registros de empleados
            $recordempleado = $this->Recordempleado->find('all')->contain(['Empleado']); 
            
            // Configuración de Dompdf con opciones
            $options = new Options();
            $options->set('defaultFont', 'Helvetica');
            $options->set('isRemoteEnabled', true); // Habilitar imágenes remotas si usas URLs completas
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
                .header img {
                    width: 100px;
                    margin-bottom: 10px;
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
        
            <h1>Listado de Logros de Empleados</h1>
            <div class="fecha-consulta">Fecha de consulta: ' . $fechaConsulta . '</div>
        
            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No. Record</th>
                        <th>Nombre del Empleado</th>
                        <th>Logro Positivo</th>
                        <th>Descripción</th>
                        <th>Fecha del Logro</th>
                    </tr>
                </thead>
                <tbody>';
            
            foreach ($recordempleado as $record) {
                $html .= '<tr>';
                $html .= '<td>' . h($record->idRecord) . '</td>';
                $html .= '<td>' . ($record->empleado ? h($record->empleado->nombres . ' ' . $record->empleado->apellidos) : 'Empleado no asignado') . '</td>';
                $html .= '<td>' . ($record->tipo_logro ? 'SI' : 'NO') . '</td>';
                $html .= '<td>' . h($record->descripcion) . '</td>';
                $html .= '<td>' . h($record->fecha_ocurrencia ? $record->fecha_ocurrencia->format('d/m/Y') : 'Fecha no disponible') . '</td>';
                $html .= '</tr>';
            }
        
            $html .= '</tbody></table>';

  try {
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
} catch (\Exception $e) {
    echo 'Error al generar PDF: ' . $e->getMessage();
    return; // Termina la ejecución si hay un error
}
            // Enviar el PDF al navegador para descarga
            $dompdf->stream("Reporte_Logros_Empleados.pdf", ["Attachment" => 1]);
        
            // Finaliza la ejecución
            return $this->response->withType('pdf');
        }    

    public function index()
{
    // Incluye la tabla 'Empleados' para traer los datos relacionados
    $query = $this->Recordempleado->find()->contain(['Empleado']);
    $recordempleado = $this->paginate($query);

    $this->set(compact('recordempleado'));
}

    /**
     * View method
     *
     * @param string|null $id Recordempleado id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        // Asegúrate de incluir el modelo 'Empleado' en la consulta
        $recordempleado = $this->Recordempleado->get($id, [
            'contain' => ['Empleado'] // Incluir la relación 'Empleado'
        ]);
        
        $this->set(compact('recordempleado'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $recordempleado = $this->Recordempleado->newEmptyEntity();
        
        // Obtener los empleados concatenando nombres y apellidos
        $empleados = $this->Recordempleado->Empleado->find('list', [
            'keyField' => 'idEmpleado', // El id de la tabla EMPLEADO
            'valueField' => function ($row) {
                return $row['nombres'] . ' ' . $row['apellidos'];
            }
        ])->toArray();
        
        if ($this->request->is('post')) {
            $recordempleado = $this->Recordempleado->patchEntity($recordempleado, $this->request->getData());
            
            if ($this->Recordempleado->save($recordempleado)) {
                $this->Flash->success(__('El record del empleado ha sido guardado.'));
    
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar el record del empleado. Por favor, inténtelo de nuevo.'));
        }
        
        // Pasar la lista de empleados a la vista
        $this->set(compact('recordempleado', 'empleados'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Recordempleado id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */ 
    public function edit($id = null)
    {
        //$recordempleado = $this->Recordempleado->get($id, contain: []);
        
        // Cargar el registro de Recordempleado junto con el empleado relacionado
        $recordempleado = $this->Recordempleado->get($id, [
            'contain' => ['Empleado'], // Incluir la asociación con 'Empleado'
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $recordempleado = $this->Recordempleado->patchEntity($recordempleado, $this->request->getData());
            if ($this->Recordempleado->save($recordempleado)) {
                $this->Flash->success(__('El record del empleado ha sido actualizado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar el record del empleado. Por favor, inténtelo de nuevo.'));
        }
       
        // Pasar el registro del empleado a la vista
        $empleado = $recordempleado->empleado; // Acceder al empleado relacionado
        $this->set(compact('recordempleado', 'empleado'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Recordempleado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $recordempleado = $this->Recordempleado->get($id);
        if ($this->Recordempleado->delete($recordempleado)) {
            $this->Flash->success(__('El record del empleado ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el record del empleado. Por favor, inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
