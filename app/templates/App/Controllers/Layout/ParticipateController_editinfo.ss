<% include Atwx\SilverstripeDataManager\Includes\Heading Title=$Title, Description=$Description, Actions= %>
<div class="uk-child-width-expand@s" data-uk-grid>
    <div>
        $Content
        $Form
    </div>
    <div style="position:sticky;top:80px;align-self:flex-start">
        <iframe src="$PreviewLink" class="uk-width-1-1" style="height:calc(100vh - 80px)">

        </iframe>
    </div>
</div>
