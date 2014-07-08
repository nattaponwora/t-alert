<br>
<form id="search_form" class="form-inline" role="form" action="<?= base_url("temp/search") ?>" method="post">
    <select class="form-control">
        <option>ทั้งหมด</option>
        <option>b3310</option>
    </select>

    <div class="form-group">
        <input id="search_storeasset" name="search_storeasset" type="text">
    </div>

    <select class="form-control">
        <option>ทั้งหมด</option>
        <option>OpenType</option>
    </select>

    <button id="search" name="search" type="submit">Search</button>
</form>
<br>
<table class="table table- -->hover" border="0">
    <thead>
        <tr>
            <th style="width:50px">Index</th>
            <th style="width:100px">Store ID</th>
            <th style="width:100px">Store Name</th>
            <th style="width:100px">Asset ID</th>
            <th style="width:100px">Asset Shortname</th>
            <th style="width:200px">Asset Description</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($id > 0){
            foreach ($id as $r) {
                echo "<tr>";
                foreach ($r as $c) {
                    echo "<td>$c</td>";
                }
                echo "</tr>";
            }
        }
        ?>     
    </tbody>
</table>

<form id="back_form" action="<?= base_url("temp/logout") ?>" method="post" >
    <p>
        <input id="back_button" name="back_button" type="submit" value="Back" />
    </p>
</form>