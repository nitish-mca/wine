<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ingredient'), ['action' => 'edit', $ingredient->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ingredient'), ['action' => 'delete', $ingredient->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ingredients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ingredient'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ingredients view large-9 medium-8 columns content">
    <h3><?= h($ingredient->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($ingredient->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $ingredient->has('category') ? $this->Html->link($ingredient->category->title, ['controller' => 'Categories', 'action' => 'view', $ingredient->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Uom') ?></th>
            <td><?= h($ingredient->uom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $ingredient->has('user') ? $this->Html->link($ingredient->user->name, ['controller' => 'Users', 'action' => 'view', $ingredient->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ingredient->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Size') ?></th>
            <td><?= $this->Number->format($ingredient->size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= $this->Number->format($ingredient->cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('1 Ml') ?></th>
            <td><?= $this->Number->format($ingredient->ml) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('1 Cl') ?></th>
            <td><?= $this->Number->format($ingredient->cl) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('1 Ltr') ?></th>
            <td><?= $this->Number->format($ingredient->ltr) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('1 Oz') ?></th>
            <td><?= $this->Number->format($ingredient->oz) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('1 Pt') ?></th>
            <td><?= $this->Number->format($ingredient->pt) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Portion') ?></th>
            <td><?= $this->Number->format($ingredient->portion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost Of Portion') ?></th>
            <td><?= $this->Number->format($ingredient->cost_of_portion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($ingredient->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($ingredient->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $ingredient->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Wine Ingredients') ?></h4>
        <?php if (!empty($ingredient->wine_ingredients)): ?>
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
            <?php foreach ($ingredient->wine_ingredients as $wineIngredients): ?>
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
