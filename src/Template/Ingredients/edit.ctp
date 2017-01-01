<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ingredient->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ingredient->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ingredients'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Ingredient'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ingredients form large-9 medium-8 columns content">
    <?= $this->Form->create($ingredient) ?>
    <fieldset>
        <legend><?= __('Edit Ingredient') ?></legend>
        <?php
            echo $this->Form->input('title');
            echo $this->Form->input('category_id', ['options' => $categories, 'empty' => true]);
            echo $this->Form->input('size');
            echo $this->Form->input('uom');
            echo $this->Form->input('cost');
            echo $this->Form->input('ml', ['label' => '1 Ml']);
            echo $this->Form->input('cl', ['label' => '1 Cl']);
            echo $this->Form->input('ltr', ['label' => '1 Ltr']);
            echo $this->Form->input('oz', ['label' => '1 Oz']);
            echo $this->Form->input('pt', ['label' => '1 Pt']);
            echo $this->Form->input('portion');
            echo $this->Form->input('cost_of_portion');
            echo $this->Form->input('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
