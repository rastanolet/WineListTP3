<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wine $wine
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Wine'), ['action' => 'edit', $wine->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Wine'), ['action' => 'delete', $wine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wine->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Wines'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wine'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colors'), ['controller' => 'Colors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Color'), ['controller' => 'Colors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grapes'), ['controller' => 'Grapes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grape'), ['controller' => 'Grapes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Regions'), ['controller' => 'Regions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Region'), ['controller' => 'Regions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Vineyards'), ['controller' => 'Vineyards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Vineyard'), ['controller' => 'Vineyards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Years'), ['controller' => 'Years', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Year'), ['controller' => 'Years', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="wines view large-9 medium-8 columns content">
    <h3><?= h($wine->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $wine->has('user') ? $this->Html->link($wine->user->username, ['controller' => 'Users', 'action' => 'view', $wine->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= $wine->has('color') ? $this->Html->link($wine->color->name, ['controller' => 'Colors', 'action' => 'view', $wine->color->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= $wine->has('country') ? $this->Html->link($wine->country->name, ['controller' => 'Countries', 'action' => 'view', $wine->country->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= $wine->has('region') ? $this->Html->link($wine->region->name, ['controller' => 'Regions', 'action' => 'view', $wine->region->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vineyard') ?></th>
            <td><?= $wine->has('vineyard') ? $this->Html->link($wine->vineyard->name, ['controller' => 'Vineyards', 'action' => 'view', $wine->vineyard->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= $wine->has('year') ? $this->Html->link($wine->year->year_number, ['controller' => 'Years', 'action' => 'view', $wine->year->id]) : '' ?></td>
        </tr>
    <!--      <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($wine->name) ?></td>
        </tr>
       <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wine->id) ?></td>
        </tr>
       --> <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($wine->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rating AVG') ?></th>
            <td><?= $this->Number->format($wine->rating_AVG) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($wine->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($wine->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($wine->description)); ?>
    </div>
	
	
	<div class="related">
        <h4><?= __('Images') ?></h4>
        <?php if (!empty($wine->files)): ?>
        <table cellpadding="0" cellspacing="0">
            <?php foreach ($wine->files as $files): ?>
            <tr>
                
                <td><?php
					echo $this->Html->image($files->path . $files->name, [
						"alt" => $files->name,
					]);
                ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
	
	
	<div class="related">
        <h4><?= __('Grape Varieties') ?></h4>
        <?php if (!empty($wine->grapes)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($wine->grapes as $grapes): ?>
            <tr>
                <td><?= h($grapes->id) ?></td>
                <td><?= h($grapes->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Grapes', 'action' => 'view', $grapes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Grapes', 'action' => 'edit', $grapes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Grapes', 'action' => 'delete', $grapes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grapes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
