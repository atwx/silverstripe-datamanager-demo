<?php

namespace App\Models;

use Atwx\SilverstripeDataManager\DataManagerExtension;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

/**
 * Class \App\Models\Contact
 *
 * @property string $Academic
 * @property string $FirstName
 * @property string $Surname
 * @property string $JobTitle
 * @property string $Email
 * @property string $Phone
 * @property string $Mobile
 * @property string $Company
 * @property string $JobDescription
 * @method \SilverStripe\ORM\ManyManyList|\App\Models\Event[] Events()
 * @mixin \Atwx\SilverstripeDataManager\DataManagerExtension
 */
class Contact extends DataObject
{
    private static $db = [
        "Academic" => "Varchar(20)",
        "FirstName" => "Varchar(100)",
        "Surname" => "Varchar(100)",
        "JobTitle" => "Varchar(100)",
        "Email" => "Varchar(255)",
        "Phone" => "Varchar(50)",
        "Mobile" => "Varchar(50)",
        "Company" => "Varchar(255)",
        "JobDescription" => "Varchar(511)",
    ];

    private static $has_one = [
    ];

    private static $has_many = [
    ];

    private static $many_many = [
        "Events" => Event::class,
    ];

    private static $owns = [
    ];

    private static $extensions = [
        DataManagerExtension::class,
    ];

    private static $summary_fields = [
        "ID" => "ID",
        "Title" => "Name",
        "JobTitle" => "Job Title",
        "Company" => "Company",
        "FormatLastEdited" => "Updated",
        "EventSummary" => "Events",
    ];

    private static $field_labels = [
        "Academic" => "Academic Title",
        "FirstName" => "First Name",
        "Surname" => "Surname",
        "JobTitle" => "Job Title",
        "Company" => "Company",
        "Email" => "Email",
        "Phone" => "Phone",
        "Mobile" => "Mobile",
        "JobDescription" => "Job Description",
    ];

    private static $default_sort = "Surname ASC";

    private static $table_name = "Contact";

    private static $singular_name = "Contact";
    private static $plural_name = "Contacts";


    public function Title()
    {
        return ($this->Academic ? $this->Academic . " " : "") . $this->FirstName . " " . $this->Surname;
    }

    public function FormatLastEdited()
    {
        return $this->dbObject('LastEdited')->Format('dd.MM.');
    }

    public function EventSummary()
    {
        return join(', ', $this->Events()->column("Title"));
    }

    public function dataManagerFormFields()
    {
        $fields = $this->scaffoldFormFields();
        $fields->replaceField('Academic', DropdownField::create("Academic", "Academic Title", [
            "" => "",
            "Dr." => "Dr.",
            "Prof." => "Prof.",
            "Prof. Dr." => "Prof. Dr.",
        ]));
        $years = Event::get()->sort('EventDate', 'DESC')->map('ID', 'Title');
        $fields->push(CheckboxSetField::create("Events", "Events", $years));
        return $fields;
    }

    public function getDataManagerFilterFields()
    {
        $years = Event::get()->sort('EventDate', 'DESC')->map('ID', 'Title');
        return FieldList::create(
            TextField::create("Query", "Name"),
            DropdownField::create("Event", "Events", $years)
                ->setEmptyString("All")
        );
    }

    public function buildDataManagerFilter($query, $request)
    {
        if ($q = $request->getVar("Query")) {
            $query = $query->filterAny([
                "FirstName:PartialMatch" => $q,
                "Surname:PartialMatch" => $q,
            ]);
        }

        if ($q = $request->getVar("Event")) {
            $query = $query->filter([
                "Events.ID" => $q,
            ]);
        }

        return $query;
    }

    public function dataManagerExportFields()
    {
        return [
            "ID" => "Nr.",
            "Academic" => "Academic Title",
            "FirstName" => "First Name",
            "Surname" => "Surname",
            "JobTitle" => "Job Title",
            "Company" => "Company",
            "Email" => "Email",
            "Phone" => "Phone",
            "Mobile" => "Mobile",
            "JobDescription" => "Job Description",
        ];
    }

}
