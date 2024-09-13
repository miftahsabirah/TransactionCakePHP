<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<h3>Login</h3>
<?= $this->Form->create() ?>
<?= $this->Form->control('email', ['autocomplete' => 'username']) ?>
<?= $this->Form->control('password', ['autocomplete' => 'current-password']) ?>
<?= $this->Form->button('Login') ?>
<?= $this->Form->end() ?>
