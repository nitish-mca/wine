<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $faviorateWine->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $faviorateWine->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Faviorate Wines'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Wines'), ['controller' => 'Wines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wine'), ['controller' => 'Wines', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="faviorateWines form large-9 medium-8 columns content">
    <?= $this->Form->create($faviorateWine) ?>
    <fieldset>
        <legend><?= __('Edit Faviorate Wine') ?></legend>
        <?php
            echo $this->Form->input('wine_id', ['options' => $wines]);
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
