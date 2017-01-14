<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'login', 'forgotpassword', 'changepassword']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, [
            'contain' => ['FaviorateWines', 'Ingredients', 'WineIngredients', 'Wines']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function forgotpassword() {
        $this->viewBuilder()->layout('login');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userData = $this->Users->find()
                            ->where(['Users.username' => $this->request->data['username']])
                            ->contain([])->toArray();
            if (!empty($userData)) {
                $user = $this->Users->get($userData[0]->id, [
                    'contain' => []
                ]);
                $tokenString = $userData[0]->id . '_' . time() . '_' . rand();

                $user = $this->Users->patchEntity($user, $this->request->data);
                $user->password_token = base64_encode($tokenString);
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('Password instruction has been sent. Please check your email.'));
                } else {
                    $this->Flash->error(__('Password instruction couldnot be sent. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Username not found.'));
            }
        }
    }

    public function changepassword($token) {
        $this->viewBuilder()->layout('login');
        $userData = $this->Users->find()
                        ->where(['Users.password_token' => $token])
                        ->contain([])->toArray();
        if (!empty($userData)) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $user = $this->Users->get($userData[0]->id, [
                    'contain' => []
                ]);
                if ($this->request->data['password'] === $this->request->data['confirm_password']) {
                    $this->request->data['password_token'] = '';
                    $user = $this->Users->patchEntity($user, $this->request->data);
                    
                    if ($this->Users->save($user)) {
                        $this->Flash->success(__('The password has been updated.'));

                        return $this->redirect($this->Auth->logout());
                    } else {
                        $this->Flash->error(__('The password could not be updated. Please, try again.'));
                    }
                }else{
                    $this->Flash->error(__('The password and confirm password not matched. Please try again.'));
                }
            } else {
                $this->Flash->error(__('The enter password.'));
            }
        } else {
            $this->Flash->error(__('Invalid link.'));
            return $this->redirect($this->Auth->logout());
        }
    }

}
