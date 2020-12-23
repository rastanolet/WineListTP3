<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Wines Controller
 *
 * @property \App\Model\Table\WinesTable $Wines
 *
 * @method \App\Model\Entity\Wine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WinesController extends AppController
{
	public function initialize() {
        parent::initialize();
        $this->Auth->allow(['grapes', 'files']);
        $this->viewBuilder()->setLayout('cakephp_default');
		
		// Include the FlashComponent
        $this->loadComponent('Flash');
        
        // Load Files model
        $this->loadModel('Files');
        
    }
	
    public function isAuthorized($user)
	{
		$action = $this->request->getParam('action');
                // Admins have all access
                if($user['role_id'] == 1){
                    return true;
                }
                
                // Visiters have no rights
                if($user['role_id'] == 3){
                    return false;
                }
                
		// The add, grapes and files actions are always allowed to logged in users.
		if (in_array($action, ['add', 'grapes', 'files'])) {
			return true;
		}

		// All other actions require a id.
		$id = $this->request->getParam('pass.0');
		if (!$id) {
			return false;
		}

		// Check that the wine belongs to the current user.
		$wine = $this->Wines->get($id);

		return $wine->user_id === $user['id'];
	}
        
	/**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Colors', 'Countries', 'Grapes', 'Regions', 'Vineyards', 'Years', 'Files'],
        ];
        $wines = $this->paginate($this->Wines);

        $this->set(compact('wines'));
    }

    /**
     * View method
     *
     * @param string|null $id Wine id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $wine = $this->Wines->get($id, [
            'contain' => ['Users', 'Colors', 'Countries', 'Grapes', 'Regions', 'Vineyards', 'Years', 'Files'],
        ]);

        $this->set('wine', $wine);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wine = $this->Wines->newEntity();
        if ($this->request->is('post')) {
            $wine = $this->Wines->patchEntity($wine, $this->request->getData());
			$wine->user_id = $this->Auth->user('id');
            if ($this->Wines->save($wine)) {
                $this->Flash->success(__('The wine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wine could not be saved. Please, try again.'));
        }
        $users = $this->Wines->Users->find('list', ['limit' => 200]);
        $colors = $this->Wines->Colors->find('list', ['limit' => 200]);
        $countries = $this->Wines->Countries->find('list', ['limit' => 200]);
        $grapes = $this->Wines->Grapes->find('list', ['limit' => 200]);
        $regions = $this->Wines->Regions->find('list', ['limit' => 200]);
        $vineyards = $this->Wines->Vineyards->find('list', ['limit' => 200]);
        $years = $this->Wines->Years->find('list', ['limit' => 200]);
	$files = $this->Wines->Files->find('list', ['limit' => 200]);
        $this->set(compact('wine', 'users', 'colors', 'countries', 'grapes', 'regions', 'vineyards', 'years', 'files'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Wine id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wine = $this->Wines->get($id, [
            'contain' => ['Files', 'Vineyards'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wine = $this->Wines->patchEntity($wine, $this->request->getData());
            if ($this->Wines->save($wine)) {
                $this->Flash->success(__('The wine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The wine could not be saved. Please, try again.'));
        }
        $users = $this->Wines->Users->find('list', ['limit' => 200]);
        $colors = $this->Wines->Colors->find('list', ['limit' => 200]);
        $countries = $this->Wines->Countries->find('list', ['limit' => 200]);
        $grapes = $this->Wines->Grapes->find('list', ['limit' => 200]);
        $regions = $this->Wines->Regions->find('list', ['limit' => 200]);
        $vineyards = $this->Wines->Vineyards->find('list', ['limit' => 200]);
        $years = $this->Wines->Years->find('list', ['limit' => 200]);
	$files = $this->Wines->Files->find('list', ['limit' => 200]);
        $this->set(compact('wine', 'users', 'colors', 'countries', 'grapes', 'regions', 'vineyards', 'years', 'files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Wine id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $wine = $this->Wines->get($id);
        if ($this->Wines->delete($wine)) {
            $this->Flash->success(__('The wine has been deleted.'));
        } else {
            $this->Flash->error(__('The wine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
