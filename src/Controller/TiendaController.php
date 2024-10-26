<?php
declare(strict_types=1);

namespace App\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * Tienda Controller
 *
 * @property \App\Model\Table\TiendaTable $Tienda
 */
class TiendaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Tienda->find();
        $tienda = $this->paginate($query);

        $this->set(compact('tienda'));
    }

    /**
     * View method
     *
     * @param string|null $id Tienda id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tienda = $this->Tienda->get($id, contain: []);
        $this->set(compact('tienda'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tienda = $this->Tienda->newEmptyEntity();
        if ($this->request->is('post')) {
            $tienda = $this->Tienda->patchEntity($tienda, $this->request->getData());
            if ($this->Tienda->save($tienda)) {
                $this->Flash->success(__('La tienda ha sido registrada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo registrar la tienda. Por favor, inténtelo de nuevo.'));
        }
        $this->set(compact('tienda'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tienda id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tienda = $this->Tienda->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tienda = $this->Tienda->patchEntity($tienda, $this->request->getData());
            if ($this->Tienda->save($tienda)) {
                $this->Flash->success(__('La tienda ha sido actualizada.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar la tienda. Por favor, inténtelo de nuevo.'));
        }
        $this->set(compact('tienda'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tienda id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tienda = $this->Tienda->get($id);
        if ($this->Tienda->delete($tienda)) {
            $this->Flash->success(__('La tienda ha sido eliminada.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la tienda. Por favor, inténtelo de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
