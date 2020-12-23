<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Utility\Text;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout', 'add', 'confirm', 'edit']);
                $this->viewBuilder()->setLayout('cakephp_default');
	}
        
        public function isAuthorized($user)
	{
		$action = $this->request->getParam('action');
		if (in_array($action, ['index'])) {
                    if (!$user['confirmed']){
                        $this->Flash->success(__('Please confirm your email'));
                        return parent::isAuthorized($user);
                    }
                    
                    return true;
		}

		// All other actions require a id.
		$id = $this->request->getParam('pass.0');
		if (!$id) {
                    $this->Flash->error(__('Missing parameter'));
                    return false;
		}

		// Check that the wine belongs to the current user.
		if($id == $user['id']){
                    return true;
                } else{
                    return parent::isAuthorized($user);
                }
	}
	
	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
                                if (!$user['confirmed']){
                                    $this->Flash->success(__('Please confirm your email to acces the users list'));
                                }
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error('Your username or password is incorrect.');
		}
	}

	public function sendConfirmEmail($user)
    {
        $email = new Email ('default');
		$email->to($user->email)->subject(__('Confirm your email'))->send('http://' . $_SERVER['HTTP_HOST'] . $this->request->webroot . 'users/confirm/' . $user->uuid);
    }
	
	public function confirm($uuid)
    {
        $user = $this->Users->findByUuid($uuid)->firstOrFail();
		$user->confirmed = true;
		if ($this->Users->save($user)){
			$this->Flash->success(__('Thank you') . '. ' . __('Your email has been confirmed'));
			return $this->redirect(['action' => 'index']);
		}
		$this->Flash->error(__('The confirmation could not be saved. PLease, try again.'));
    }
	

	public function logout()
	{
		$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles'],
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Wines'],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->uuid = Text::uuid();
			$user->confirmed = false;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
				$this->sendConfirmEmail($user);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			
			if ($user->uuid == '') $user->uuid = Text::uuid();
//			debug($user); die();
			
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
