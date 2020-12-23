<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    
    public function initialize(){
        parent::initialize();
        $this->Auth->allow(['add']);
        $this->viewBuilder()->setLayout('cakephp_default');
        
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
                
		// The add actions are always allowed to logged in users.
		if (in_array($action, ['add'])) {
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
        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
		
        

    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Wines'],
        ]);

        $this->set('file', $file);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEntity();
        if ($this->request->is('post') or $this->request->is('ajax')) {
            $filerequest = $this->request->getData();
 //               debug($filerequest);
 //               debug($this->request->getData()['name']);
  //              die();
			
		if (!empty($filerequest['file']['name'])) {
                $fileName = $filerequest['file']['name'];
                $uploadPath = 'files/add/';
                $uploadFile = $uploadPath . $fileName;
                if (move_uploaded_file($filerequest['file']['tmp_name'], 'img/' . $uploadFile)) {
                    $file = $this->Files->patchEntity($file, $this->request->getData());
                    $file->name = $fileName;
                    $file->path = $uploadPath;
                    if ($this->Files->save($file)) {
                        $this->Flash->success(__('File has been uploaded and inserted successfully.'));
						
				return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Unable to upload file, please try again.'));
                    }
                } else {
                    $this->Flash->error(__('Unable to upload file, please try again.'));
                }
            } else {
                $this->Flash->error(__('Please choose a file to upload.'));
            }
        }
        $wines = $this->Files->Wines->find('list', ['limit' => 200]);
        $this->set(compact('file', 'wines'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Wines'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $wines = $this->Files->Wines->find('list', ['limit' => 200]);
        $this->set(compact('file', 'wines'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
