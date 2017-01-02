<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class ServicesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('json');
        $this->Auth->allow(['login', 'signup','getcategories', 'getsubcategories', 'getofferslist', 'getofferdetails', 'addsubsricption', 'addsuggestions', 'listoffers']);
    }

    public function login() {
        $msg = array('msg' => 'Please enter your username and password.', 'success' => false, 'error' => true);
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $msg = array('msg' => 'Login Successful.', 'success' => true, 'error' => false);
                //return $this->redirect($this->Auth->redirectUrl());

               // $this->Flash->error(__('Invalid username or password, try again'));
            }else{
                $msg = array('msg' => 'Login Failed. Wrong Username or Password', 'success' => false, 'error' => true);
            }
        }
        echo json_encode($msg);
        die;
    }
    
    public function signup(){
        $msg = array('msg' => 'Please fill up form.', 'success' => false, 'error' => true);
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $msg = array('msg' => 'New User Add Successfully.', 'success' => true, 'error' => false);
            } else {
                $msg = array('msg' => 'Error.', 'success' => false, 'error' => true);
            }
        }
        echo json_encode($msg);
        die;
    }

    public function index() {

        $categories = $this->paginate($this->Categories);
        $this->set(compact('categories'));
        $this->set('_serialize', ['categories']);
    }

    public function getcategories() {
        $this->loadModel('Categories');
        $categories = $this->Categories->find()
                ->contain(['Ingredients'])
                ->limit(25)
                ->order('Categories.id ASC')
                ->toArray();
        echo json_encode($categories);
        die;
    }

    public function getingrdientsbycategory($category_id = null) {
        $this->loadModel('Ingredients');
        if (!empty($category_id)) {
            $ingredients = $this->Ingredients->find()
                    ->limit(25)
                    ->where(['Ingredients.category_id' => $category_id])
                    ->order('Ingredients.id');
        } else {
            $ingredients = $this->Ingredients->find()
                    ->limit(25)
                    ->contain(['Categories'])
                    ->order('Ingredients.id');
        }

        echo json_encode($ingredients);
        die;
    }

    public function getwinelist($user_id = null) {
        $this->loadModel('Wines');
        $winelist = $this->Wines->find('all', [
            'limit' => 25,
//            'fields' => ['id', 'title', 'subtitle'],
//            'where' => ['subcategory_id' => $subcategory_id],
            'order' => 'Wines.id ASC'
        ]);
        echo json_encode($winelist);
        die;
    }

    public function getofferdetails($offer_id) {
        $this->loadModel('Offers');
        $offer = $this->Offers->get($offer_id, ['contain' => ['Subcategories']])->toArray();
        $offer['urls'] = !empty($offer['urls']) ? unserialize($offer['urls']) : '';
        $offer['photo'] = !empty($offer['photo']) ? '/Offers/photo/' . $offer['photo'] : '';
        unset($offer['dir'], $offer['is_expired']);
        echo json_encode($offer);
        die;
    }

    public function addsubsricption() {
        $this->loadModel('Subscriptions');
        $subscription = $this->Subscriptions->newEntity();
        $msg = array('msg' => 'Please Send email address in post method.', 'success' => false, 'error' => true);
        if ($this->request->is('post')) {
            $subscription = $this->Subscriptions->patchEntity($subscription, $this->request->data);
            //debug($subscription);die;
            if ($this->Subscriptions->save($subscription)) {
                $msg = array('msg' => 'The subscription has been saved.', 'success' => true, 'error' => false);
            } else {
                $msg = array('msg' => 'The subscription could not been saved. Please try again.', 'success' => false, 'error' => true);
            }
        }
        echo json_encode($msg);
        die;
    }

    public function addsuggestions() {
        $this->loadModel('Suggestions');
        $msg = array('msg' => 'Your suggestion could not been sent. Please try again.', 'success' => false, 'error' => true);
        $suggestion = $this->Suggestions->newEntity();
        if ($this->request->is('post')) {
            $suggestion = $this->Suggestions->patchEntity($suggestion, $this->request->data);
            if ($this->Suggestions->save($suggestion)) {
                $msg = array('msg' => 'Your suggestion has been sent successfully.', 'success' => true, 'error' => false);
            } else {
                $msg = array('msg' => 'Your suggestion could not been sent. Please try again.', 'success' => false, 'error' => true);
            }
        }
        echo json_encode($msg);
        die;
    }

    public function listoffers($category_id) {
        $this->loadModel('Subcategories');
        $subcategories = $this->Subcategories->find()
                ->contain(['Categories', 'Offers'])
                ->limit(25)
                ->where(['Subcategories.category_id' => $category_id])
                ->order('Subcategories.id')
                ->toArray();
        $data = array();
        foreach ($subcategories as $k => $sb) {
            if (!empty($sb['offers'])) {
                $data[$k]['id'] = $sb['id'];
                $data[$k]['title'] = $sb['title'];
                $data[$k]['category'] = $sb['category']->title;
                $data[$k]['totalOffers'] = count($sb['offers']);
                foreach ($sb['offers'] as $i => $offer) {
                    $data[$k]['offers'][$i]['id'] = $offer['id'];
                    $data[$k]['offers'][$i]['title'] = $offer['title'];
                    $data[$k]['offers'][$i]['subtitle'] = $offer['subtitle'];
                    $data[$k]['offers'][$i]['photo'] = !empty($offer['photo']) ? '/img/Offers/photo/' . $offer['photo'] : '';
                    $data[$k]['offers'][$i]['urls'] = !empty($offer['urls']) ? unserialize($offer['urls']) : '';
                    $data[$k]['offers'][$i]['description'] = $offer['description'];
                    $data[$k]['offers'][$i]['email'] = $offer['email'];
                    $data[$k]['offers'][$i]['phone'] = $offer['phone'];
                    $data[$k]['offers'][$i]['facetime_phone'] = $offer['facetime_phone'];
                }
            }
        }
        echo json_encode($data);
        die;
    }

}
