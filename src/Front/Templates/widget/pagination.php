<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Pagination\PaginationResult;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;

/**
 * @var Data             $data
 * @var PaginationResult $pagination
 * @var string           $route
 */
$pagination = $data->pagination;
$route = $data->route;
?>
<style>
	.pagination .glyphicon {
		line-height: inherit;
	}
</style>
<ul class="uk-pagination windwalker-pagination">
	<?php if ($pagination->getFirst()): ?>
		<li>
			<a href="<?php echo $route(array('page' => $pagination->getFirst())); ?>">
				<span class="glyphicon glyphicon-fast-backward"></span>
				<span class="sr-only"><span class="uk-icon-step-backward"></span></span>
			</a>
		</li>
	<?php endif; ?>

	<?php if ($pagination->getPrevious()): ?>
		<li>
			<a href="<?php echo $route(array('page' => $pagination->getPrevious())); ?>">
				<span class="glyphicon glyphicon-backward"></span>
				<span class="sr-only"><span class="uk-icon-backward"></span></span>
			</a>
		</li>
	<?php endif; ?>

<!--	--><?php //if ($pagination->getLess()): ?>
<!--		<li>-->
<!--			<a href="--><?php //echo $route(array('page' => $pagination->getLess())); ?><!--">-->
<!--				更少-->
<!--			</a>-->
<!--		</li>-->
<!--	--><?php //endif; ?>

	<?php foreach ($pagination->getPages() as $k => $page): ?>
		<?php $active = ($page == 'current') ? 'uk-active' : ''; ?>
		<li class="<?php echo $active; ?>">
			<?php if (!$active): ?>
				<a href="<?php echo $route(array('page' => $k)); ?>" class="<?php echo $active; ?>">
					<?php echo $k; ?>
				</a>
			<?php else: ?>
				<span>
					<?php echo $k; ?>
				</span>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>

<!--	--><?php //if ($pagination->getMore()): ?>
<!--		<li>-->
<!--			<a href="--><?php //echo $route(array('page' => $pagination->getMore())); ?><!--">-->
<!--				更多-->
<!--			</a>-->
<!--		</li>-->
<!--	--><?php //endif; ?>

	<?php if ($pagination->getNext()): ?>
		<li>
			<a href="<?php echo $route(array('page' => $pagination->getNext())); ?>">
				<span class="glyphicon glyphicon-forward"></span>
				<span class="sr-only"><span class="uk-icon-forward"></span></span>
			</a>
		</li>
	<?php endif; ?>

	<?php if ($pagination->getLast()): ?>
		<li>
			<a href="<?php echo $route(array('page' => $pagination->getLast())); ?>">
				<span class="glyphicon glyphicon-fast-forward"></span>
				<span class="sr-only"><span class="uk-icon-step-forward"></span></span>
			</a>
		</li>
	<?php endif; ?>
</ul>
