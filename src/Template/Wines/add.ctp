<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Wines'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="wines form large-9 medium-8 columns content">
    <?= $this->Form->create($wine, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Add Wine') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('category_id', ['options' => $categories]);
            echo $this->Form->input('photo', ['type' => 'file']);
            echo $this->Form->input('description');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
