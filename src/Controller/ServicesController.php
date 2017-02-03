<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Routing\Router;

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
        $this->Auth->allow(['login', 'signup', 'forgotpassword', 'changepassword', 'checkemail',
            'getcategories',
            'getingrdients','addingredient',
            'getwinelist', '__getwinelist', 'createwine', 'listwine', 'updatewine', 'searchwine',
            'addfaviorate', 'listfaviorate', 'removefaviorate', 
            'getrecentlist',
            'getprofile', 'updateprofile'
            ]);
    }

    public function login() {
        $msg = array('msg' => 'Please enter your username and password.', 'success' => false, 'error' => true);
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $data['User'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'skype' => $user['skype'],
                    'address' => $user['address'],
                    'state' => $user['state'],
                    'country' => $user['country'],
                    'last_login' => $user['last_login']
                ];
                $msg = array('msg' => 'Login Successful.', 'success' => true, 'data' => $data['User'],'error' => false);
            } else {
                $msg = array('msg' => 'Login Failed. Wrong Username or Password', 'success' => false, 'error' => true);
            }
        }
        echo json_encode($msg);
        die;
    }

    public function signup() {
        $msg = array('msg' => 'Please fill up form.', 'success' => false, 'error' => true);
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if(empty($user->username) || empty($user->password) || empty($user->name)){
                $msg = array('msg' => 'Missing data.', 'success' => false, 'error' => true);
            }
            else{
                if ($this->Users->save($user)) {
                    $data = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'phone' => $user['phone'],
                        'skype' => $user['skype'],
                        'address' => $user['address'],
                        'state' => $user['state'],
                        'country' => $user['country'],
                        'last_login' => $user['last_login']
                    ];
                    $msg = array('msg' => 'New User Add Successfully.', 'success' => true, 'error' => false, 'data' => $data);
                } else {
                    $msg = array('msg' => 'Error in creating new user. Please try again.', 'success' => false, 'error' => true, 'error_data' => $user->errors());
                }
            }
        }
        echo json_encode($msg);
        die;
    }

    public function forgotpassword()    {
        $msg = array('msg' => 'Please enter username.', 'success' => false, 'error' => true);
        $this->loadModel('Users');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userData = $this->Users->find()
                            ->where(['Users.username' => $this->request->data['username']])
                            ->contain([])->toArray();
            if (!empty($userData)) {

                $user = $this->Users->get($userData[0]->id, [
                    'contain' => []
                ]);
                $name = $userData[0]->name;

                $tokenString = $userData[0]->id . '_' . time() . '_' . rand();
                $user = $this->Users->patchEntity($user, $this->request->data);
                $user->password_token = base64_encode($tokenString);
                if ($this->Users->save($user)) {
                    $url = Router::url(['controller' => 'users', 'action' => 'changepassword', $user->password_token], true);
                    $msg = "Dear " . $name . ", <br/> We have recieved request for change your password for our portal. Please click on following link for update it.<br/> " . $url;
                    $email = new Email('default');
                    $email->from(['admin@wineshop.net' => 'Wineshop'])
                            ->to($userData[0]->email)
                            ->subject('Request for change password')
                            ->emailFormat('html')
                            ->send($msg);

                    $msg = array('msg' => 'Password instruction has been sent. Please check your email.', 'success' => true, 'error' => false);
                } else {
                    $msg = array('msg' => 'Password instruction couldnot be sent. Please, try again.', 'success' => false, 'error' => true);
                }
            } else {
                $msg = array('msg' => 'Username not found.', 'success' => false, 'error' => true);
            }
        }
        echo json_encode($msg);
        die;
    }

    public function changepassword($token) {
        $msg = array('msg' => 'Please enter username.', 'success' => false, 'error' => true);
        $this->loadModel('Users');
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
                        $msg = array('msg' => 'The password has been updated.', 'success' => true, 'error' => false);
                    } else {
                        $msg = array('msg' => 'The password could not be changed. Please, try again.', 'success' => false, 'error' => true);
                    }
                } else {
                    $msg = array('msg' => 'The password and confirm password not matched. Please try again.', 'success' => false, 'error' => true);
                }
            } else {
                $msg = array('msg' => 'The enter password.', 'success' => false, 'error' => true);
            }
        } else {
            $msg = array('msg' => 'Invalid or Expired token.', 'success' => false, 'error' => true);
        }
        echo json_encode($msg);
        die;
    }

    public function checkemail() {
        echo $url = Router::url(
                ['controller' => 'services', 'action' => 'changepassword', 'test'], true
        );

        die;
        $email = new Email('default');
        $email->from(['admin@wineshop.net' => 'Wineshop'])
                ->to('nitish.mca@outlook.com')
                ->subject('Test Mail')
                ->send('My message');
        die;
    }

    public function getcategories($id = NULL) {
        $this->loadModel('Categories');
        $conditions = array();
        
        if (!empty($id)) {
            $conditions['Categories.id'] = $id;
        }
        $categories = [];
        $categories = $this->Categories->find()
                ->select(['id', 'title'])
                ->contain(['Ingredients' => function($q) {
                        return $q->select(['id','title', 'category_id', 'size', 'uom', "cost", "ml", "cl", "ltr", "oz", "pt", "portion", "cost_of_portion"]);
                    }])
                ->where($conditions)
                ->limit(250)
                ->order('Categories.id ASC')
                ->toArray();        
        echo json_encode($categories);
        die;
    }

    public function getingrdients($category_id = null) {
        $this->loadModel('Ingredients');
        $conditions = array();
        
        if (!empty($category_id)) {
            $conditions['Ingredients.category_id'] = $category_id;
        }
        $ingredients = [];
        $ingredients = $this->Ingredients->find()
                ->limit(250)
                ->where($conditions)
                ->select(['title', 'category_id', 'size', 'uom', "cost", "ml", "cl", "ltr", "oz", "pt", "portion", "cost_of_portion"])
                ->contain(['Categories' => function ($q) {
                        return $q->select(['id', 'title']);
                    }])
                ->order('Ingredients.id');
        
        echo json_encode($ingredients);
        die;
    }
    
    public function addingredient(){
        $this->loadModel('Ingredients');
        $msg = array('msg' => 'Ingredients could not been added. Please try again.', 'success' => false, 'error' => true);
        if ($this->request->is('post')) {
            $ingredient = $this->Ingredients->newEntity($this->request->data, ['associated' => ['Categories']]);
            if(empty($ingredient->title)){
                $msg = array('msg' => 'Missing Data. Please try again.', 'success' => false, 'error' => true);
            }else{
                if ($this->Ingredients->save($ingredient)) {
                    $data = [
                        'id' => $ingredient['id'],
                        'title' => $ingredient['title'],
                        'size' => $ingredient['size'],
                        'uom' => $ingredient['uom'],
                        'cost' => $ingredient['cost'],
                        'category_id' => $ingredient['category_id'],
                        'category' => [
                            'id' => $ingredient['category']->id,
                            'title' => $ingredient['category']-> title
                        ]   
                    ];

                    $msg = array('msg' => 'Ingredient created successfully.', 'success' => true, 'error' => false, 'data' => $data);
                } else {
                    debug($ingredient->errors());
                    $msg = array('msg' => 'Ingredients could not been created. Please try again.', 'success' => false, 'error' => true);
                }
            }
        }
        echo json_encode($msg);
        die;
    }
    
    public function getwinelist() {
        $this->loadModel('Wines');
        $conditions = array();
        $order = ['Wines.id ASC'];
        $winelist = [];
        $winelist = $this->__getwinelist($conditions, $order);
        echo json_encode($winelist);
        die;
    }
    
    public function __getwinelist($conditions = [], $order = []) {
        $this->loadModel('Wines');       
        $winelist = $this->Wines->find()
                ->where($conditions)
                ->select(['id','title', 'description', 'photo', 'dir'])
                ->contain(['WineIngredients' => function($q){
                    return $q->select(['id', 'wine_id', 'ingredient_id', 'qty', 'cost']);
                }, 
                'WineIngredients.Ingredients' => function($q){
                    return $q->select(['id', 'category_id', 'title', 'size', 'uom']);
                },
                'WineIngredients.Ingredients.Categories' => function($q){
                    return $q->select(['id', 'title']);
                }
                ])
                ->limit(250)
                ->order($order);

        return $winelist;
    }
    
    public function createwine()    {
        $this->loadModel('Wines');
        $msg = array('msg' => 'Wine could not been created. Please try again.', 'success' => false, 'error' => true);
        if ($this->request->is('post')) {
            $wine = $this->Wines->newEntity($this->request->data, ['associated' => ['WineIngredients']]);
            if(empty($wine->title) || empty($wine->description) || empty($wine->user_id)){
                $msg = array('msg' => 'Missing Data. Please try again.', 'success' => false, 'error' => true);
            }
            else{
                $wine->status = 1;            
                if(isset($wine->photo['name'])){
                    $ext = pathinfo($wine->photo['name'], PATHINFO_EXTENSION);
                    $filename = basename($wine->photo['name'], ".$ext");
                    $wine->photo['name'] = md5($filename).'_'.rand(1,1000).'.'.$ext;   
                }            
                if ($this->Wines->save($wine)) {
                    $data = ['id' => $wine['id'], 'title' => $wine['title']];
                    $msg = array('msg' => 'Wine created successfully.', 'success' => true, 'error' => false, 'data' => $data);
                } else {
                    debug($wine->errors());
                    $msg = array('msg' => 'Wine could not been created. Please try again.', 'success' => false, 'error' => true);
                }
            }
        }
        echo json_encode($msg);
        die;
    }
    
    public function listwine($user_id = NULL) {
        $this->loadModel('Wines');
        $conditions = array();
        if(!empty($user_id)){
            $conditions['Wines.user_id'] = $user_id;
        }        
        $order = ['Wines.id DESC'];
        $winelist = [];
        $winelist = $this->__getwinelist($conditions, $order);

        echo json_encode($winelist);
        die;
    }
    
    public function updatewine($id) {
        $msg = array('msg' => 'Wine could not been updated. Please try again.', 'success' => false, 'error' => true);
        
        if(empty($id)){
            $msg = array('msg' => 'Invalid Wine. Please try again.', 'success' => false, 'error' => true);
        }
        
        $this->loadModel('Wines');
        $wineData = $this->Wines->get($id, [
            'contain' => ['WineIngredients']
        ]);
//        debug($wine);die;
        if(empty($wineData)){
            $msg = array('msg' => 'Invalid Wine. Please try again.', 'success' => false, 'error' => true);
        }       
        
        if ($this->request->is('post')) {
            if($this->request->data['user_id'] != $wineData->user_id){
                
                $wine = $wineData->toArray();
                $wine = $this->Wines->newEntity($wine, ['associated' => ['WineIngredients']]);
              //  debug($wine);die;
                $this->Wines->save($wine);
                
            }
            $wine = $this->Wines->patchEntity($wine, $this->request->data);
            
            if(empty($wine->title) || empty($wine->description) || empty($wine->user_id)){
                $msg = array('msg' => 'Missing Data. Please try again.', 'success' => false, 'error' => true);
            }
            else{
                $wine->status = 1;            
                if(isset($wine->photo['name'])){
                    $ext = pathinfo($wine->photo['name'], PATHINFO_EXTENSION);
                    $filename = basename($wine->photo['name'], ".$ext");
                    $wine->photo['name'] = md5($filename).'_'.rand(1,1000).'.'.$ext;   
                }            
                //$this->Wines->create();
                if ($this->Wines->save($wine)) {
                    $data = ['id' => $wine['id'], 'title' => $wine['title']];
                    $msg = array('msg' => 'Wine updated successfully.', 'success' => true, 'error' => false, 'data' => $data);
                } else {
                    debug($wine->errors());
                    $msg = array('msg' => 'Wine could not been created. Please try again.', 'success' => false, 'error' => true);
                }
            }
        }
        echo json_encode($msg);
        die;
    }
    
    public function searchwine(){
        $conn = ConnectionManager::get('default');
        $stmt = $conn->execute('SELECT * FROM users')->fetchAll('assoc');
        debug($stmt);
        die;
    }
    
    public function addfaviorate() {
        $this->loadModel('FaviorateWines');
        $msg = array('msg' => 'Faviorate wine could not been added. Please try again.', 'success' => false, 'error' => true);
        if ($this->request->is('post')) {
            $faviorateWine = $this->FaviorateWines->newEntity($this->request->data);
            if(empty($faviorateWine->user_id) || empty($faviorateWine->wine_id)){
                $msg = array('msg' => 'Missing Data. Please try again.', 'success' => false, 'error' => true);
            }else{            
                $faviorateWine->status = 1;    
                $faviorateWine->created = date('Y-m-d H:m:s');
                
                if($this->FaviorateWines->save($faviorateWine)) {
                    $msg = array('msg' => 'Faviorate wine saved successfully.', 'success' => true, 'error' => false);
                } else {
                    debug($faviorateWine->errors());
                    $msg = array('msg' => 'Faviorate wine could not been added. Please try again.', 'success' => false, 'error' => true);
                }
            }
        }
        echo json_encode($msg);
        die;
    }
    
    public function listfaviorate($user_id) {
        $this->loadModel('FaviorateWines');
        $faviorateWines = $this->FaviorateWines->find('list')
                ->where(['FaviorateWines.user_id' => $user_id])
                ->toArray();
        $conditions = array(['Wines.id IN' => $faviorateWines]);
        $order = ['Wines.id DESC'];
        $data = $this->__getwinelist($conditions, $order);
        
        echo json_encode($data);
        die;
    }
    
    public function removefaviorate() {
        $this->loadModel('FaviorateWines');
        $msg = array('msg' => 'Faviorate wine could not been removed. Please try again.', 'success' => false, 'error' => true);
        if ($this->request->is('post')) {   
            $faviorateWine = $this->request->data;
            if(empty($faviorateWine['user_id']) || empty($faviorateWine['wine_id'])){
                $msg = array('msg' => 'Missing Data. Please try again.', 'success' => false, 'error' => true);
            }else{
                $conditions = array('user_id' => $faviorateWine['user_id'], 'wine_id' => $faviorateWine['wine_id']);
                if($this->FaviorateWines->deleteAll($conditions)){
                    $msg = array('msg' => 'Faviorate wine removed successfully.', 'success' => true, 'error' => false);
                } else {
                    $msg = array('msg' => 'Faviorate wine could not been removed. Please try again.', 'success' => false, 'error' => true);
                }
            }
        }
        echo json_encode($msg);
        die;
    }
    
    public function getrecentlist ($user_id = NULL) {
        $this->loadModel('Wines');
        $conditions = array();
        if(!empty($user_id)){
            $conditions['Wines.user_id'] = $user_id;
        }        
        $order = ['Wines.id DESC'];
        $winelist = [];
        $winelist = $this->__getwinelist($conditions, $order);

        echo json_encode($winelist);
        die;
    }
    
    public function getprofile($user_id = NULL){
        $this->loadModel('Users');
        if(empty($user_id)){
            $user = array('msg' => 'User profile could not been found. Please try again.', 'success' => false, 'error' => true);
        }
        $user = $this->Users->get($user_id);
        if(empty($user)){
            $user = array('msg' => 'User profile could not been found. Please try again.', 'success' => false, 'error' => true);
        }       
        echo json_encode($user);
        die;
    }
    
    public function updateprofile($user_id){
        $this->loadModel('Users');
        $msg = array('msg' => 'User profile could not been added. Please try again.', 'success' => false, 'error' => true);
        $user = $this->Users->get($user_id);
        
        if(empty($user)){
            $msg = array('msg' => 'User profile could not been found. Please try again.', 'success' => false, 'error' => true);
        }
        
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if(isset($user->photo['name'])){
                $ext = pathinfo($user->photo['name'], PATHINFO_EXTENSION);
                $filename = basename($user->photo['name'], ".$ext");
                $user->photo['name'] = md5($filename).'_'.rand(1,1000).'.'.$ext;   
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $user = $this->Users->get($user_id);
                $msg = array('msg' => 'User profile updated successfully.', 'success' => true, 'error' => false, 'data' => $user);
            } else {
                $msg = array('msg' => 'User profile could not been added. Please try again.', 'success' => false, 'error' => true, 'error_data' => $user->errors());
            }
        }
        echo json_encode($msg);
        die;
    }
}