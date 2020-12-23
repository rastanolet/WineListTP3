<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Wine $wine
 */
?>
<div class="wines view large-9 medium-8 columns content">
    <h3><?= h($wine->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= h($wine->user['username']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= h($wine->color['name']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($wine->country['name']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Region') ?></th>
            <td><?= h($wine->region['name']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vineyard') ?></th>
            <td><?= h($wine->vineyard['name']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= h($wine->year['year_number']) ?></td>
        </tr>
<!--        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($wine->name) ?></td>
        </tr>
         <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($wine->id) ?></td>
        </tr>
  -->      <tr>
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
            </tr>
            <?php foreach ($wine->grapes as $grapes): ?>
            <tr>
                <td><?= h($grapes->id) ?></td>
                <td><?= h($grapes->name) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
