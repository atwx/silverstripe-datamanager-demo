<h2>$Item</h2>
<% with $Item %>
    <h2>$ID</h2>
    <table class="uk-table uk-table-striped">
        <thead>
        <tr>
            <% loop $DataManagerFields %>
                <th>$Title</th>
            <% end_loop %>
        </tr>
        </thead>
        <tbody>
        <% if $Attendances.Count > 0 %>
            <% loop $Attendances %>
                <tr>
                    <% loop $DataManagerData %>
                        <% if $IsFirst %>
                            <td><a href="$Top.Link("view")/$Up.ID">$Value</a></td>
                        <% else %>
                            <td>$Value</td>
                        <% end_if %>
                    <% end_loop %>
                    <% if $CanEdit %>
                        <td>
                            <a href="$Top.Link("edit")/$ID"
                               class="uk-icon-button"
                               title="Bearbeiten"
                               uk-icon="icon: pencil"></a>
                        </td>
                    <% end_if %>
                    <% if $CanDelete %>
                        <td>
                            <a href="$Top.Link("delete")/$ID?BackURL=$Top.Link"
                               class="uk-icon-button"
                               title="Löschen"
                               onclick="return confirm('Sind Sie sicher?')"
                               uk-icon="icon: trash"></a>
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
