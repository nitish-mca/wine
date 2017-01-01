<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * WineIngredients Controller
 *
 * @property \App\Model\Table\WineIngredientsTable $WineIngredients
 */
class WineIngredientsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Wines', 'Ingredients', 'Users']
        ];
        $wineIngredients = $this->paginate($this->WineIngredients);

        $this->set(compact('wineIngredients'));
        $this->set('_serialize', ['wineIngredients']);
    }

    /**
     * View method
     *
     * @param string|null $id Wine Ingredient id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $wineIngredient = $this->WineIngredients->get($id, [
            'contain' => ['Wines', 'Ingredients', 'Users']
        ]);

        $this->set('wineIngredient', $wineIngredient);
        $this->set('_serialize', ['wineIngredient']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $wineIngredient = $this->WineIngredients->newEntity();
        if ($this->request->is('post')) {
            $wineIngredient = $this->WineIngredients->patchEntity($wineIngredient, $this->request->data);
            if ($this->WineIngredients->save($wineIngredient)) {
                $this->Flash->success(__('The wine ingredient has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wine ingredient could not be saved. Please, try again.'));
            }
        }
        $wines = $this->WineIngredients->Wines->find('list', ['limit' => 200]);
        $ingredients = $this->WineIngredients->Ingredients->find('list', ['limit' => 200]);
        $users = $this->WineIngredients->Users->find('list', ['limit' => 200]);
        $this->set(compact('wineIngredient', 'wines', 'ingredients', 'users'));
        $this->set('_serialize', ['wineIngredient']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Wine Ingredient id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $wineIngredient = $this->WineIngredients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $wineIngredient = $this->WineIngredients->patchEntity($wineIngredient, $this->request->data);
            if ($this->WineIngredients->save($wineIngredient)) {
                $this->Flash->success(__('The wine ingredient has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The wine ingredient could not be saved. Please, try again.'));
            }
        }
        $wines = $this->WineIngredients->Wines->find('list', ['limit' => 200]);
        $ingredients = $this->WineIngredients->Ingredients->find('list', ['limit' => 200]);
        $users = $this->WineIngredients->Users->find('list', ['limit' => 200]);
        $this->set(compact('wineIngredient', 'wines', 'ingredients', 'users'));
        $this->set('_serialize', ['wineIngredient']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Wine Ingredient id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $wineIngredient = $this->WineIngredients->get($id);
        if ($this->WineIngredients->delete($wineIngredient)) {
            $this->Flash->success(__('The wine ingredient has been deleted.'));
        } else {
            $this->Flash->error(__('The wine ingredient could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
