<% include Atwx\SilverstripeDataManager\Includes\Heading Title=$Title, Description=$Description, Actions=$Actions%>
<div data-uk-grid>
    <div class="uk-width-2-3@m">
        <iframe
            src="campaigns/preview/$Item.ID"
<%--            onload="(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+'px';}(this));"--%>
            style="width:100%;height:800px;">
        </iframe>
    </div>
    <div class="uk-width-1-3@m">
        $PreviewForm
    </div>
</div>
<script>
    const iframe = document.querySelector('iframe');
    iframe.onload = function() {
        iframe.style.height = iframe.contentWindow.document.body.scrollHeight + 'px';
    };
    const recipientSelect = document.querySelector('#Form_PreviewForm_RecipientID');
    recipientSelect.addEventListener('change', function() {
        const iframe = document.querySelector('iframe');
        iframe.src = 'campaigns/preview/$Item.ID?RecipientID=' + this.value;
    });
</script>
