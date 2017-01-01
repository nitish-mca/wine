<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * FaviorateWines Controller
 *
 * @property \App\Model\Table\FaviorateWinesTable $FaviorateWines
 */
class FaviorateWinesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Wines', 'Users']
        ];
        $faviorateWines = $this->paginate($this->FaviorateWines);

        $this->set(compact('faviorateWines'));
        $this->set('_serialize', ['faviorateWines']);
    }

    /**
     * View method
     *
     * @param string|null $id Faviorate Wine id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $faviorateWine = $this->FaviorateWines->get($id, [
            'contain' => ['Wines', 'Users']
        ]);

        $this->set('faviorateWine', $faviorateWine);
        $this->set('_serialize', ['faviorateWine']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $faviorateWine = $this->FaviorateWines->newEntity();
        if ($this->request->is('post')) {
            $faviorateWine = $this->FaviorateWines->patchEntity($faviorateWine, $this->request->data);
            if ($this->FaviorateWines->save($faviorateWine)) {
                $this->Flash->success(__('The faviorate wine has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The faviorate wine could not be saved. Please, try again.'));
            }
        }
        $wines = $this->FaviorateWines->Wines->find('list', ['limit' => 200]);
        $users = $this->FaviorateWines->Users->find('list', ['limit' => 200]);
        $this->set(compact('faviorateWine', 'wines', 'users'));
        $this->set('_serialize', ['faviorateWine']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Faviorate Wine id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $faviorateWine = $this->FaviorateWines->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $faviorateWine = $this->FaviorateWines->patchEntity($faviorateWine, $this->request->data);
            if ($this->FaviorateWines->save($faviorateWine)) {
                $this->Flash->success(__('The faviorate wine has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The faviorate wine could not be saved. Please, try again.'));
            }
        }
        $wines = $this->FaviorateWines->Wines->find('list', ['limit' => 200]);
        $users = $this->FaviorateWines->Users->find('list', ['limit' => 200]);
        $this->set(compact('faviorateWine', 'wines', 'users'));
        $this->set('_serialize', ['faviorateWine']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Faviorate Wine id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $faviorateWine = $this->FaviorateWines->get($id);
        if ($this->FaviorateWines->delete($faviorateWine)) {
            $this->Flash->success(__('The faviorate wine has been deleted.'));
        } else {
            $this->Flash->error(__('The faviorate wine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
