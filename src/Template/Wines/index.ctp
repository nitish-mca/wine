<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Wine'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="wines index large-9 medium-8 columns content">
    <h3><?= __('Wines') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wines as $wine): ?>
                <tr>
                    <td><?= $this->Number->format($wine->id) ?></td>
                    <td><?= h($wine->title) ?></td>
                    <td><?= $wine->has('category') ? $this->Html->link($wine->category->title, ['controller' => 'Categories', 'action' => 'view', $wine->category->id]) : '' ?></td>
                    <td><?= h($wine->status) ?></td>
                    <td><?= $wine->has('user') ? $this->Html->link($wine->user->name, ['controller' => 'Users', 'action' => 'view', $wine->user->id]) : '' ?></td>
                    <td><?= h($wine->created) ?></td>
                    <td><?= h($wine->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $wine->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $wine->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $wine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wine->id)]) ?>
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
