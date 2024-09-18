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
                <div class="page">
                    <div class="participant_info">
                        <div class="participant_info_item participant_info_item--booth">$Up.Booth</div>
                        <div class="participant_info_item participant_info_item--room">$Up.Room</div>
                    </div>
                    <h1>$Title</h1>
                    <p>$JobTitle<br/>
                    $Company</p>
                    <h2>$JobDescription</h2>
                    <section class="section">
                        <h2>Hauptaufgaben</h2>
                        <p>
                            $MainTasks
                        </p>
                    </section>
                    <section class="section">
                        <h2>Bildungsweg</h2>
                        <p>
                            $Education
                        <p>
                    </section>
                    <section class="section">
                        <h2>Berufsweg</h2>
                        <p>
                        $CareerPath
                        </p>
                    </section>
                    <section class="section">
                        <h2>Motivation</h2>
                        <p>
                        $Motivation
                        </p>
                    </section>
                </div>
            <% end_with %>
        <% end_loop %>
    </main>
</div>
<script type="module" src="$Vite("app/client/src/js/main.js")"></script>
</body>
</html>


