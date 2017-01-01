<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wine Ingredient'), ['action' => 'edit', $wineIngredient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wine Ingredient'), ['action' => 'delete', $wineIngredient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wineIngredient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wine Ingredients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wine Ingredient'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Ingredients'), ['controller' => 'Ingredients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ingredient'), ['controller' => 'Ingredients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wineIngredients view large-9 medium-8 columns content">
    <h3><?= h($wineIngredient->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Wine') ?></th>
            <td><?= $wineIngredient->has('wine') ? $this->Html->link($wineIngredient->wine->title, ['controller' => 'Wines', 'action' => 'view', $wineIngredient->wine->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ingredient') ?></th>
            <td><?= $wineIngredient->has('ingredient') ? $this->Html->link($wineIngredient->ingredient->title, ['controller' => 'Ingredients', 'action' => 'view', $wineIngredient->ingredient->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $wineIngredient->has('user') ? $this->Html->link($wineIngredient->user->name, ['controller' => 'Users', 'action' => 'view', $wineIngredient->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wineIngredient->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qty') ?></th>
            <td><?= $this->Number->format($wineIngredient->qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= $this->Number->format($wineIngredient->cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($wineIngredient->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($wineIngredient->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Garnish Options') ?></th>
            <td><?= $wineIngredient->garnish_options ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
