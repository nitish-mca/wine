<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Wine Ingredient'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ingredients'), ['controller' => 'Ingredients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ingredient'), ['controller' => 'Ingredients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wineIngredients index large-9 medium-8 columns content">
    <h3><?= __('Wine Ingredients') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('wine_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ingredient_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('garnish_options') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cost') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wineIngredients as $wineIngredient): ?>
            <tr>
                <td><?= $this->Number->format($wineIngredient->id) ?></td>
                <td><?= $wineIngredient->has('wine') ? $this->Html->link($wineIngredient->wine->title, ['controller' => 'Wines', 'action' => 'view', $wineIngredient->wine->id]) : '' ?></td>
                <td><?= $wineIngredient->has('ingredient') ? $this->Html->link($wineIngredient->ingredient->title, ['controller' => 'Ingredients', 'action' => 'view', $wineIngredient->ingredient->id]) : '' ?></td>
                <td><?= $this->Number->format($wineIngredient->qty) ?></td>
                <td><?= h($wineIngredient->garnish_options) ?></td>
                <td><?= $this->Number->format($wineIngredient->cost) ?></td>
                <td><?= $wineIngredient->has('user') ? $this->Html->link($wineIngredient->user->name, ['controller' => 'Users', 'action' => 'view', $wineIngredient->user->id]) : '' ?></td>
                <td><?= h($wineIngredient->created) ?></td>
                <td><?= h($wineIngredient->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $wineIngredient->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $wineIngredient->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $wineIngredient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wineIngredient->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
