<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Wines Controller
 *
 * @property \App\Model\Table\WinesTable $Wines
 */
class WinesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Categories', 'Users']
        ];
        $wines = $this->paginate($this->Wines);

        $this->set(compact('wines'));
        $this->set('_serialize', ['wines']);
    }

    /**
     * View method
     *
     * @param string|null $id Wine id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $wine = $this->Wines->get($id, [
            'contain' => ['Categories', 'Users', 'FaviorateWines', 'WineIngredients']
        ]);

        $this->set('wine', $wine);
        $this->set('_serialize', ['wine']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wine = $this->Wines->newEntity();
        if ($this->request->is('post')) {
            $wine = $this->Wines->patchEntity($wine, $this->request->data);
            if(isset($wine->photo['name'])){
                $ext = pathinfo($wine->photo['name'], PATHINFO_EXTENSION);
                $filename = basename($wine->photo['name'], ".$ext");
                $wine->photo['name'] = md5($filename).'_'.rand(1,1000).'.'.$ext;
                
            }
            if ($this->Wines->save($wine)) {
                $this->Flash->success(__('The wine has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wine could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Wines->Categories->find('list', ['limit' => 200]);
        $users = $this->Wines->Users->find('list', ['limit' => 200]);
        $this->set(compact('wine', 'categories', 'users'));
        $this->set('_serialize', ['wine']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Wine id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wine = $this->Wines->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wine = $this->Wines->patchEntity($wine, $this->request->data);
            if(isset($wine->photo['name'])){
                $ext = pathinfo($wine->photo['name'], PATHINFO_EXTENSION);
                $filename = basename($wine->photo['name'], ".$ext");
                $wine->photo['name'] = md5($filename).'_'.rand(1,1000).'.'.$ext;
                
            }
            if ($this->Wines->save($wine)) {
                $this->Flash->success(__('The wine has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wine could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Wines->Categories->find('list', ['limit' => 200]);
        $users = $this->Wines->Users->find('list', ['limit' => 200]);
        $this->set(compact('wine', 'categories', 'users'));
        $this->set('_serialize', ['wine']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Wine id.
     * @return \Cake\Network\Response|null Redirects to index.
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
