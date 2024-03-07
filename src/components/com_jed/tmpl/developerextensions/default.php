<?php

/**
 * @package JED
 *
 * @copyright (C) 2022 Open Source Matters, Inc.  <https://www.joomla.org>
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;

// phpcs:enable PSR1.Files.SideEffects

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('behavior.multiselect');
HTMLHelper::_('formbehavior.chosen', 'select');

$items = $this->items;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->useStyle('com_jed.jazstyle');

/**
 * @var $this Jed\Component\Jed\Site\View\Developerextensions\HtmlView
 */
?>
<?php if ($items): ?>
    <div class="jed-cards-wrapper margin-bottom-half">
        <div class="jed-container">
            <h2 class="heading heading--m">My Extensions</h2>
            <ul class="jed-grid jed-grid--1-1-1">
                <?php foreach ($items as $item) : ?>
                    <?php echo LayoutHelper::render(
                        'cards.extension',
                        [
                            'image' => $item->logo,
                            'title' => $item->title,
                            'developer' => $item->developer,
                            'score_string' => $item->score_string,
                            'score' => $item->score,
                            'reviews' => $item->review_string,
                            'compatibility' => $item->version,
                            'description' => $item->description,
                            'type' => $item->type,
                            'category' => $item->category_title,
                            'link' => Route::_(sprintf('index.php?option=com_jed&view=extension&catid=%s&id=%s', $item->primary_category_id, $item->id)),
                        ]
                    ); ?>

                <?php endforeach; ?>
            </ul>
        </div>
    </div>


<?php else: ?>
    <p>You don't have any extensions yet.</p>
    <button class="btn btn-primary">Submit extension</button>
<?php endif; ?>
