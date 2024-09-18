<?php

namespace App\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\Event;
use App\Models\EventAttendance;
use Atwx\SilverstripeDataManager\ManageController;
use HeadlessChromium\BrowserFactory;
use SilverStripe\Core\Environment;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\TextField;

/**
 * Class \App\Controllers\ContactManageController
 *
 */
class EventManageController extends BaseController
{
    private static $managed_model = Event::class;
    private static $url_segment = 'events';
    private static $title = 'Infotage';
    private static $description = '';

    private static $allowed_actions = [
        'participantinfo',
        'rooms',
        'preview_pdf',
    ];

    public function canView($member = null)
    {
        if ($this->getAction() == 'participantinfo' || $this->getAction() == 'rooms') {
            return true;
        }
        return parent::canView($member);
    }

    public function participantinfo()
    {
        $id = $this->getRequest()->param("ID");
        $event = Event::get()->byID($id);
        if (!$event) {
            return $this->httpError(404);
        }
        $attendances = $event->Attendances()->filter([
            'Status' => 'participant',
        ]);
        return $this->renderWith("App\\Controllers\\EventManageController_participantinfo", [
            'Event' => $event,
            'Attendances' => $attendances->sort('Booth'),
        ]);
    }

    public function rooms()
    {
        $id = $this->getRequest()->param("ID");
        $event = Event::get()->byID($id);
        if (!$event) {
            return $this->httpError(404);
        }
        $attendances = $event->Attendances()->filter([
            'Status' => 'participant',
        ]);
        return $this->renderWith("App\\Controllers\\EventManageController_rooms", [
            'Event' => $event,
            'Attendances' => $attendances->leftJoin('Room', 'RoomID = Room.ID')->sort('Room.Name'),
        ]);
    }


    public function preview_pdf()
    {
        $id = $this->getRequest()->param("ID");
        $action = $this->getRequest()->param("OtherID");
        if(!$action) {
            $action = "participantinfo";
        }
        $contact = EventAttendance::get()->byID($id);
        if (!$contact) {
            return $this->httpError(404);
        }
        $chrome_path = Environment::getEnv('CHROME_PATH');
        $browserFactory = new BrowserFactory($chrome_path ? $chrome_path : null);

        // starts headless Chrome
        $browser = $browserFactory->createBrowser([
            'startupTimeout' => 600,
            'connectionDelay' => 1,
        ]);

        try {
            // creates a new page and navigate to an URL
            $page = $browser->createPage();
            $page->navigate($this->AbsoluteLink("$action/$id"))->waitForNavigation();

            $options = [
                'landscape' => true,             // default to false
                'printBackground' => true,             // default to false
                'displayHeaderFooter' => true,             // default to false
                'preferCSSPageSize' => true,             // default to false (reads parameters directly from @page)
                'marginTop' => 0.2,              // defaults to ~0.4 (must be a float, value in inches)
                'marginBottom' => 0.2,              // defaults to ~0.4 (must be a float, value in inches)
                'marginLeft' => 0.2,              // defaults to ~0.4 (must be a float, value in inches)
                'marginRight' => 0.2,              // defaults to ~0.4 (must be a float, value in inches)
                'paperWidth' => 8.3,              // defaults to 8.5 (must be a float, value in inches)
                'paperHeight' => 11.7,              // defaults to 11.0 (must be a float, value in inches)
                'headerTemplate' => '<p style="color:red">Seite <span class="pageNumber"></span></p>', // see details above
                'footerTemplate' => '<p>foo</p>', // see details above
                'scale' => 1,              // defaults to 1.0 (must be a float)
            ];

            // print as pdf (in memory binaries)
            $pdf = $page->pdf($options);

            // or directly output pdf without saving
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename=filename.pdf');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');

            echo base64_decode($pdf->getBase64());
        } finally {
            // bye
            $browser->close();
        }
    }

}
