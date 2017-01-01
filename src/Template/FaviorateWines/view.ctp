<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Faviorate Wine'), ['action' => 'edit', $faviorateWine->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Faviorate Wine'), ['action' => 'delete', $faviorateWine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faviorateWine->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Faviorate Wines'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Faviorate Wine'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="faviorateWines view large-9 medium-8 columns content">
    <h3><?= h($faviorateWine->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Wine') ?></th>
            <td><?= $faviorateWine->has('wine') ? $this->Html->link($faviorateWine->wine->title, ['controller' => 'Wines', 'action' => 'view', $faviorateWine->wine->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $faviorateWine->has('user') ? $this->Html->link($faviorateWine->user->name, ['controller' => 'Users', 'action' => 'view', $faviorateWine->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($faviorateWine->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $faviorateWine->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
