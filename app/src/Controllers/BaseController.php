<?php

namespace App\Controllers;

use App\Projects\Project;
use Atwx\SilverstripeDataManager\DataManagerController;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;

/**
 * Class \App\Controllers\BaseController
 *
 */
class BaseController extends DataManagerController
{

//    private static $logo = 'app/client/images/itaw_logo.svg';

    public function MainNavigation()
    {
        $navigation = ArrayList::create();

        if (singleton(ContactManageController::class)->canView()) {
            $navigation->push(ArrayData::create([
                'Title' => 'Contacts',
                'Active' => Controller::curr()->getRequest()->getURL() == '' ||
                    str_starts_with(Controller::curr()->getRequest()->getURL(), 'contacts'),
                'Link' => 'contacts',
            ]));
        }

        if (singleton(EventManageController::class)->canView()) {
            $navigation->push(ArrayData::create([
                'Title' => 'Events',
                'Active' => str_starts_with(Controller::curr()->getRequest()->getURL(), 'events'),
                'Link' => 'events',
            ]));
        }
        return $navigation;
    }
}
