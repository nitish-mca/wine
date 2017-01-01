<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Faviorate Wine'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="faviorateWines index large-9 medium-8 columns content">
    <h3><?= __('Faviorate Wines') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('wine_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($faviorateWines as $faviorateWine): ?>
            <tr>
                <td><?= $this->Number->format($faviorateWine->id) ?></td>
                <td><?= $faviorateWine->has('wine') ? $this->Html->link($faviorateWine->wine->title, ['controller' => 'Wines', 'action' => 'view', $faviorateWine->wine->id]) : '' ?></td>
                <td><?= $faviorateWine->has('user') ? $this->Html->link($faviorateWine->user->name, ['controller' => 'Users', 'action' => 'view', $faviorateWine->user->id]) : '' ?></td>
                <td><?= h($faviorateWine->status) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $faviorateWine->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $faviorateWine->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $faviorateWine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $faviorateWine->id)]) ?>
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
