<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Years Controller
 *
 * @property \App\Model\Table\YearsTable $Years
 *
 * @method \App\Model\Entity\Year[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class YearsController extends AppController
{
    public function isAuthorized($user)
	{
		$action = $this->request->getParam('action');
                // Admins have all access
                if($user['role_id'] == 1){
                    return true;
                }
                

		// All other actions require a id.
		$id = $this->request->getParam('pass.0');
		if (!$id) {
			return false;
		}

	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $years = $this->paginate($this->Years);

        $this->set(compact('years'));
    }

    /**
     * View method
     *
     * @param string|null $id Year id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $year = $this->Years->get($id, [
            'contain' => ['Wines'],
        ]);

        $this->set('year', $year);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $year = $this->Years->newEntity();
        if ($this->request->is('post')) {
            $year = $this->Years->patchEntity($year, $this->request->getData());
            if ($this->Years->save($year)) {
                $this->Flash->success(__('The year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The year could not be saved. Please, try again.'));
        }
        $this->set(compact('year'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Year id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $year = $this->Years->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $year = $this->Years->patchEntity($year, $this->request->getData());
            if ($this->Years->save($year)) {
                $this->Flash->success(__('The year has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The year could not be saved. Please, try again.'));
        }
        $this->set(compact('year'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Year id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $year = $this->Years->get($id);
        if ($this->Years->delete($year)) {
            $this->Flash->success(__('The year has been deleted.'));
        } else {
            $this->Flash->error(__('The year could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
