<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

/**
 * Vineyards Controller
 *
 * @property \App\Model\Table\VineyardsTable $Vineyards
 *
 * @method \App\Model\Entity\Vineyard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VineyardsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->Auth->allow(['index']);
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $vineyards = $this->Vineyards->find('all');
        $this->set([
            'vineyards' => $vineyards,
            '_serialize' => ['vineyards']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Vineyard id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vineyard = $this->Vineyards->get($id);
        $this->set([
            'vineyard' => $vineyard,
            '_serialize' => ['vineyard']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod(['post', 'put']);
        $vineyard = $this->Vineyards->newEntity($this->request->getData());
        if ($this->Vineyards->save($vineyard)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'vineyard' => $vineyard,
            '_serialize' => ['message', 'vineyard']
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vineyard id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id)
    {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $vineyard = $this->Vineyards->get($id);
        $vineyard = $this->Vineyards->patchEntity($vineyard, $this->request->getData());
        if ($this->Vineyards->save($vineyard)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vineyard id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
        $this->request->allowMethod(['delete']);
        $vineyard = $this->Vineyards->get($id);
        $message = 'Deleted';
        if (!$this->Vineyards->delete($vineyard)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}
