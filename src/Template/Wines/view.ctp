<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wine'), ['action' => 'edit', $wine->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wine'), ['action' => 'delete', $wine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wine->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wines'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wine'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wines view large-9 medium-8 columns content">
    <h3><?= h($wine->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($wine->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Photo') ?></th>
            <td><?= h($wine->photo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dir') ?></th>
            <td><?= h($wine->dir) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $wine->has('user') ? $this->Html->link($wine->user->name, ['controller' => 'Users', 'action' => 'view', $wine->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wine->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($wine->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($wine->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $wine->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($wine->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wine Ingredients') ?></h4>
        <?php if (!empty($wine->wine_ingredients)): ?>
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
            <?php foreach ($wine->wine_ingredients as $wineIngredients): ?>
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
</div>
