<table>
    <tr>
        <th style="width:50px">Index</th>
        <th style="width:200px">Store ID</th>
        <th style="width:200px">Store Name</th>
        <th style="width:150px">Asset ID</th>
        <th style="width:150px">Asset Shortname</th>
        <th style="width:150px">Asset Description</th>
    </tr>
    <?php
    foreach ($id as $r) {
        echo "<tr>";
        foreach ($r as $c) {
            echo "<td>$c</td>";
        }
        echo "</tr>";
    }
    ?>
</table>

<form id="back_form" action="<?= base_url("temp/logout") ?>" method="post" >
    <p>
        <input id="back_button" name="back_button" type="submit" value="Back" />
    </p>
</form>

