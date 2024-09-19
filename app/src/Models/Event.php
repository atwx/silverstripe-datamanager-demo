<?php

namespace App\Models;

use Atwx\SilverstripeDataManager\DataManagerExtension;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\View\ArrayData;

/**
 * Class \App\Models\Event
 *
 * @property string $EventDate
 * @property string $Title
 * @method \SilverStripe\ORM\ManyManyList|\App\Models\Contact[] Contacts()
 * @mixin \Atwx\SilverstripeDataManager\DataManagerExtension
 */
class Event extends DataObject
{
    private static $db = [
        "EventDate" => "Date",
        "Title" => "Varchar(255)",
    ];

    private static $has_many = [
    ];

    private static $belongs_many_many = [
        "Contacts" => Contact::class,
    ];

    private static $table_name = "Event";

    private static $extensions = [
        DataManagerExtension::class,
    ];

    private static $summary_fields = [
        "ID" => "ID",
        "EventDate" => "Datum",
        "Title" => "Name",
    ];

    private static $searchable_fields = [
    ];

    private static $default_sort = "EventDate DESC";

    public function Year()
    {
        if ($this->EventDate)
            return date("Y", strtotime($this->EventDate));
        return "";
    }
}
