<?php

/**
 * @package JED
 *
 * @subpackage VEL
 *
 * @copyright (C) 2022 Open Source Matters, Inc.  <https://www.joomla.org>
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Jed\Component\Jed\Site\View\Developerextensions
;

// No direct access
// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

use Cassandra\Exception\UnauthorizedException;
use Exception;
use Joomla\CMS\Access\Exception\AuthenticationFailed;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\Registry\Registry;
use Joomla\CMS\Pagination\Pagination;

/**
 * View class for a list of VEL Developer Updates.
 *
 * @since 4.0.0
 */
class HtmlView extends BaseHtmlView
{
    public array $items;

    /**
     * Display the view
     *
     * @param string $tpl Template name
     *
     * @return void
     *
     * @since  4.0.0
     * @throws Exception
     */
    public function display($tpl = null): void
    {
        $app = Factory::getApplication();

        //$this->state         = $this->get('State');
        $this->items         = $this->get('Items');
        //$this->pagination    = $this->get('Pagination');
        //$this->params        = $app->getParams('com_jed');
        //$this->filterForm    = $this->get('FilterForm');
        //$this->activeFilters = $this->get('ActiveFilters');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        $currentUser = Factory::getApplication()->getIdentity();

        //TODO check if user is a developer.
        if(!$currentUser->id)
            throw new Exception("You need to be logged in." );

        //$this->prepareDocument();
        parent::display($tpl);
    }

    /**
     * Check if state is set
     *
     * @param mixed $state State
     *
     * @return bool
     *
     * @since 4.0.0
     */
    public function getState(mixed $state): bool
    {
        return $this->state->{$state} ?? false;
    }
}
