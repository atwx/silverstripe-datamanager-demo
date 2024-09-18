<% with $Item %>
    <h1>$Title</h1>
    <h2>Teilnehmer</h2>
    <table class="uk-table uk-table-striped">
        <thead>
        <tr>
            <% loop $prepareDataManagerFields %>
                <th>$Title</th>
            <% end_loop %>
        </tr>
        </thead>
        <tbody>
        <% if $Participants.Count > 0 %>
            <% loop $Participants %>
                <tr>
                    <% loop $DataManagerData %>
                        <% if $IsFirst %>
                            <td><a href="$Top.Link("view")/$Up.ID">$Value</a></td>
                        <% else %>
                            <td>$Value</td>
                        <% end_if %>
                    <% end_loop %>
                        <td>
                            <a href="participate/confirm/$ID/$Hash"
                               class="uk-icon-button"
                               title="Confirm"
                               target="_blank"
                               uk-icon="icon: check"></a>
                        </td>
                        <td>
                            <a href="participate/editinfo/$ID/$Hash"
                               class="uk-icon-button"
                               title="Edit Info"
                               target="_blank"
                               uk-icon="icon: user"></a>
                        </td>
                    <% if $CanEdit %>
                        <td>
                            <a href="$Top.Link("editattendance")/$ID"
                               class="uk-icon-button"
                               title="Bearbeiten"
                               uk-icon="icon: pencil"></a>
                        </td>
                    <% end_if %>
                </tr>
            <% end_loop %>
        <% else %>
            <tr>
                <td><p>- Keine Einträge gefunden -</p></td>
            </tr>
        <% end_if %>
        </tbody>
    </table>
    <h2>Weitere Rückmeldungen</h2>
        <table class="uk-table uk-table-striped">
        <thead>
        <tr>
            <% loop $prepareDataManagerFields %>
                <th>$Title</th>
            <% end_loop %>
        </tr>
        </thead>
        <tbody>
        <% if $CancellationsAndDropouts.Count > 0 %>
            <% loop $CancellationsAndDropouts %>
                <tr>
                    <% loop $DataManagerData %>
                        <% if $IsFirst %>
                            <td><a href="$Top.Link("view")/$Up.ID">$Value</a></td>
                        <% else %>
                            <td>$Value</td>
                        <% end_if %>
                    <% end_loop %>
                        <td>
                            <a href="participate/confirm/$ID/$Hash"
                               class="uk-icon-button"
                               title="Confirm"
                               target="_blank"
                               uk-icon="icon: check"></a>
                        </td>
                        <td>
                            <a href="participate/editinfo/$ID/$Hash"
                               class="uk-icon-button"
                               title="Edit Info"
                               target="_blank"
                               uk-icon="icon: user"></a>
                        </td>
                    <% if $CanEdit %>
                        <td>
                            <a href="$Top.Link("edit")/$ID"
                               class="uk-icon-button"
                               title="Bearbeiten"
                               uk-icon="icon: pencil"></a>
                        </td>
                    <% end_if %>
                </tr>
            <% end_loop %>
        <% else %>
            <tr>
                <td><p>- Keine Einträge gefunden -</p></td>
            </tr>
        <% end_if %>
        </tbody>
    </table>

<% end_with %>
