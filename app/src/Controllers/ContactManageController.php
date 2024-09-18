<?php

namespace App\Controllers;

use App\Models\Contact;
use Atwx\SilverstripeDataManager\ManageController;

/**
 * Class \App\Controllers\ContactManageController
 *
 */
class ContactManageController extends BaseController
{
    private static $managed_model = Contact::class;
    private static $url_segment = 'contacts';
    private static $title = 'Kontakte';
    private static $description = 'Verwaltung der Kontakte';
}
