<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Utility\Security;
use Firebase\JWT\JWT;
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
		$this->Auth->allow(['add', 'token']);
	}
        
        public function token() {
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }
        $this->set([
            'success' => true,
            'data' => [
                'id' => $user['id'],
                'token' => JWT::encode([
                    'sub' => $user['id'],
                    'exp' => time() + 604800
                        ],
                        Security::salt())
            ],
            '_serialize' => ['success', 'data']
        ]);
       }
        
    public function index() {
        $users = $this->Users->find('all');
        $this->set([
            'users' => $users,
            '_serialize' => ['users']
        ]);
    }

    public function view($id) {
        $user = $this->Users->get($id);
        $this->set([
            'user' => $user,
            '_serialize' => ['user']
        ]);
    }

    public function add() {
        $this->request->allowMethod(['post', 'put']);
        $user = $this->Users->newEntity($this->request->getData());
        $user->uuid = Text::uuid();
        $user->confirmed = true;
        $data = '';

        $savedUser = $this->Users->save($user);
        if ($savedUser) {
            $message = 'Saved';
            $data = [
                'id' => $savedUser->id,
                'token' => JWT::encode(
                        [
                            'sub' => $savedUser->id,
                            'exp' => time() + 604800
                        ],
                Security::salt())
            ];
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            'data' => $data,
            '_serialize' => ['message', 'data']
        ]);
    }

    public function edit($id) {
        $this->request->allowMethod(['patch', 'post', 'put']);
        $user = $this->Users->get($id);
        $user = $this->Users->patchEntity($user, $this->request->getData());
        if ($this->Users->save($user)) {
            $message = 'Saved';
        } else {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }

    public function delete($id) {
        $this->request->allowMethod(['delete']);
        $user = $this->Users->get($id);
        $message = 'Deleted';
        if (!$this->Users->delete($user)) {
            $message = 'Error';
        }
        $this->set([
            'message' => $message,
            '_serialize' => ['message']
        ]);
    }
}
