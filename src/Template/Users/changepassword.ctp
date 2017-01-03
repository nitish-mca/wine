<div class="users form">
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter new password') ?></legend>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('confirm_password', ['type' => 'password']) ?>
    </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>

