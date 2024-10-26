<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Puesto Controller
 *
 * @property \App\Model\Table\PuestoTable $Puesto
 */
class PuestoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Puesto->find();
        $puesto = $this->paginate($query);

        $this->set(compact('puesto'));
    }

    /**
     * View method
     *
     * @param string|null $id Puesto id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $puesto = $this->Puesto->get($id, contain: []);
        $this->set(compact('puesto'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $puesto = $this->Puesto->newEmptyEntity();
        if ($this->request->is('post')) {
            $puesto = $this->Puesto->patchEntity($puesto, $this->request->getData());
            if ($this->Puesto->save($puesto)) {
                $this->Flash->success(__('El puesto ha sido registrado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo registrar el puesto. Por favor, inténtelo de nuevo.'));
        }
        $this->set(compact('puesto'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Puesto id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $puesto = $this->Puesto->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $puesto = $this->Puesto->patchEntity($puesto, $this->request->getData());
            if ($this->Puesto->save($puesto)) {
                $this->Flash->success(__('El puesto ha sido actualizado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar el puesto. Por favor, inténtelo de nuevo.'));
        }
        $this->set(compact('puesto'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Puesto id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $puesto = $this->Puesto->get($id);
        if ($this->Puesto->delete($puesto)) {
            $this->Flash->success(__('El puesto ha sido eliminado.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el puesto. Por favor, inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
