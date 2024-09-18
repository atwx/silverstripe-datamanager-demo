<!doctype html>
<html lang="de">
<head>
    <% base_tag %>
    $MetaTags(false)
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="utf-8">
    <title>$Title - Infotag Arbeitswelt</title>
    $ViteClient.RAW
    <link rel="stylesheet" href="$Vite("app/client/src/scss/main.scss")">
</head>
<body>
<div class="uk-container uk-container-xlarge">
    <% include Atwx\\SilverstripeDataManager\\Includes\\Header %>
    <% include Atwx\\SilverstripeDataManager\\Includes\\Sidebar %>
    <main class="main">
        $Layout
    </main>
</div>
<script type="module" src="$Vite("app/client/src/js/main.js")"></script>
<%--<script>--%>
<%--    tinyMCE.init({--%>
<%--                selector: 'textarea',--%>
<%--                skin: 'silverstripe',--%>
<%--                menubar: false,--%>
<%--                statusbar: false,--%>
<%--            });--%>
<%--</script>--%>
</body>
</html>
