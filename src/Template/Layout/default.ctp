<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Wineshop';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?php // $this->Html->meta('icon')  ?>

        <?= $this->Html->css('base.css') ?>
        <?= $this->Html->css('cake.css') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><a href="">Wineshop</a></h1>
                </li>
            </ul>
            <div class="top-bar-section">
                <ul class="left">
                    <li><?= $this->Html->link(__('Wines'), ['controller' => 'wines', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Wine Category'), ['controller' => 'categories', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Ingredients'), ['controller' => 'ingredients', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link(__('Users'), ['controller' => 'users', 'action' => 'index']) ?></li>
                </ul>
                <ul class="right">
                    <li><a  href="#"><?= $this->request->session()->read('Auth.User.username'); ?></a></li>
                    <li><?php echo !empty($this->request->session()->read('Auth.User.username')) ? $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) : ''; ?></li>
                </ul>
            </div>
        </nav>
        <?= $this->Flash->render() ?>
        <div class="container clearfix">
            <?= $this->fetch('content') ?>
        </div>
        <footer>
        </footer>
    </body>
</html>
