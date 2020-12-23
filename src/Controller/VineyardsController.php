<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Vineyards Controller
 *
 * @property \App\Model\Table\VineyardsTable $Vineyards
 *
 * @method \App\Model\Entity\Vineyard[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VineyardsController extends AppController
{
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
                
		// The findVineyards action is always allowed to logged in users.
		if (in_array($action, ['findVineyards'])) {
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
     * findVineyard method
     * for use with JQuery-UI Autocomplete
     *
     * @return JSon query result
     */
    public function findVineyards() {

        if ($this->request->is('ajax')) {

            $this->autoRender = false;
            $name = $this->request->query['term'];
            $results = $this->Vineyards->find('all', array(
                'conditions' => array('Vineyards.name LIKE ' => '%' . $name . '%')
            ));

            $resultArr = array();
            foreach ($results as $result) {
                $resultArr[] = array('label' => $result['name'], 'value' => $result['id']);
            }
            echo json_encode($resultArr);
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('vineyardsSpa');
        $vineyards = $this->Vineyards->find('all');
        //$vineyards = $this->paginate($this->Vineyards);

        $this->set(compact('vineyards'));
    }

    /**
     * View method
     *
     * @param string|null $id Vineyard id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
/*    public function view($id = null)
    {
        $vineyard = $this->Vineyards->get($id, [
            'contain' => ['Wines'],
        ]);

        $this->set('vineyard', $vineyard);
    }
*/
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
/*    public function add()
    {
        $vineyard = $this->Vineyards->newEntity();
        if ($this->request->is('post')) {
            $vineyard = $this->Vineyards->patchEntity($vineyard, $this->request->getData());
            if ($this->Vineyards->save($vineyard)) {
                $this->Flash->success(__('The vineyard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vineyard could not be saved. Please, try again.'));
        }
        $this->set(compact('vineyard'));
    }
*/
    /**
     * Edit method
     *
     * @param string|null $id Vineyard id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
/*    public function edit($id = null)
    {
        $vineyard = $this->Vineyards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vineyard = $this->Vineyards->patchEntity($vineyard, $this->request->getData());
            if ($this->Vineyards->save($vineyard)) {
                $this->Flash->success(__('The vineyard has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The vineyard could not be saved. Please, try again.'));
        }
        $this->set(compact('vineyard'));
    }
*/
    /**
     * Delete method
     *
     * @param string|null $id Vineyard id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
 /*   public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vineyard = $this->Vineyards->get($id);
        if ($this->Vineyards->delete($vineyard)) {
            $this->Flash->success(__('The vineyard has been deleted.'));
        } else {
            $this->Flash->error(__('The vineyard could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
  */
}
