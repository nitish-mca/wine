<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        
        <tr>
            <th scope="row"><?= __('Password Token') ?></th>
            <td><?= h($user->password_token) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Skype') ?></th>
            <td><?= h($user->skype) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($user->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($user->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Device Id') ?></th>
            <td><?= h($user->device_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Login') ?></th>
            <td><?= h($user->last_login) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $user->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Faviorate Wines') ?></h4>
        <?php if (!empty($user->faviorate_wines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Wine Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->faviorate_wines as $faviorateWines): ?>
            <tr>
                <td><?= h($faviorateWines->id) ?></td>
                <td><?= h($faviorateWines->wine_id) ?></td>
                <td><?= h($faviorateWines->user_id) ?></td>
                <td><?= h($faviorateWines->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FaviorateWines', 'action' => 'view', $faviorateWines->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FaviorateWines', 'action' => 'edit', $faviorateWines->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FaviorateWines', 'action' => 'delete', $faviorateWines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faviorateWines->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Ingredients') ?></h4>
        <?php if (!empty($user->ingredients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Size') ?></th>
                <th scope="col"><?= __('Uom') ?></th>
                <th scope="col"><?= __('Cost') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->ingredients as $ingredients): ?>
            <tr>
                <td><?= h($ingredients->id) ?></td>
                <td><?= h($ingredients->title) ?></td>
                <td><?= h($ingredients->size) ?></td>
                <td><?= h($ingredients->uom) ?></td>
                <td><?= h($ingredients->cost) ?></td>
                <td><?= h($ingredients->status) ?></td>
                <td><?= h($ingredients->user_id) ?></td>
                <td><?= h($ingredients->created) ?></td>
                <td><?= h($ingredients->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Ingredients', 'action' => 'view', $ingredients->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Ingredients', 'action' => 'edit', $ingredients->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ingredients', 'action' => 'delete', $ingredients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ingredients->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wine Ingredients') ?></h4>
        <?php if (!empty($user->wine_ingredients)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Wine Id') ?></th>
                <th scope="col"><?= __('Ingredient Id') ?></th>
                <th scope="col"><?= __('Qty') ?></th>
                <th scope="col"><?= __('Garnish Options') ?></th>
                <th scope="col"><?= __('Cost') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->wine_ingredients as $wineIngredients): ?>
            <tr>
                <td><?= h($wineIngredients->id) ?></td>
                <td><?= h($wineIngredients->wine_id) ?></td>
                <td><?= h($wineIngredients->ingredient_id) ?></td>
                <td><?= h($wineIngredients->qty) ?></td>
                <td><?= h($wineIngredients->garnish_options) ?></td>
                <td><?= h($wineIngredients->cost) ?></td>
                <td><?= h($wineIngredients->user_id) ?></td>
                <td><?= h($wineIngredients->created) ?></td>
                <td><?= h($wineIngredients->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WineIngredients', 'action' => 'view', $wineIngredients->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WineIngredients', 'action' => 'edit', $wineIngredients->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WineIngredients', 'action' => 'delete', $wineIngredients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wineIngredients->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wines') ?></h4>
        <?php if (!empty($user->wines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Category Id') ?></th>
                <th scope="col"><?= __('Photo') ?></th>
                <th scope="col"><?= __('Dir') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->wines as $wines): ?>
            <tr>
                <td><?= h($wines->id) ?></td>
                <td><?= h($wines->title) ?></td>
                <td><?= h($wines->category_id) ?></td>
                <td><?= h($wines->photo) ?></td>
                <td><?= h($wines->dir) ?></td>
                <td><?= h($wines->description) ?></td>
                <td><?= h($wines->status) ?></td>
                <td><?= h($wines->user_id) ?></td>
                <td><?= h($wines->created) ?></td>
                <td><?= h($wines->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Wines', 'action' => 'view', $wines->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Wines', 'action' => 'edit', $wines->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Wines', 'action' => 'delete', $wines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wines->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
