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
<div class="">
    <main class="main main--print">
        <% loop $Attendances %>
            <% with $Contact %>
                <div class="page page--roominfo">
                    <div class="participant_info participant_info--large">
                        <div class="participant_info_item participant_info_item--booth">$Up.Booth</div>
                        <div class="participant_info_item participant_info_item--room">$Up.Room</div>
                    </div>
                    <h1>$Title</h1>
                    <p>$JobTitle<br/>
                    $Company</p>
                </div>
            <% end_with %>
            <% if $Room.Number == 2%>
                <% with $Contact %>
                    <div class="page page--roominfo">
                        <div class="participant_info participant_info--large">
                            <div class="participant_info_item participant_info_item--booth">$Up.Booth</div>
                            <div class="participant_info_item participant_info_item--room">$Up.Room</div>
                        </div>
                        <h1>$Title</h1>
                        <p>$JobTitle<br/>
                        $Company</p>
                    </div>
                <% end_with %>
            <% end_if %>
        <% end_loop %>
    </main>
</div>
<script type="module" src="$Vite("app/client/src/js/main.js")"></script>
</body>
</html>


