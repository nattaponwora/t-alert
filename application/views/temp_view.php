<br>
<form id="search_form" class="form-inline" role="form" action="<?= base_url("temp/search") ?>" method="post">

    <div class="form-group">
        <?php if($searchTerm == null) { ?>
            <input id="search_storeasset" name="search_storeasset" type="text">
        <?php } ?>
        <?php if($searchTerm != null) { ?>
            <input id="search_storeasset" name="search_storeasset" type="text" value="<?= $searchTerm ?>">
        <?php } ?>
    </div>
    
    <label>อุปกรณ์</label>
    <select class="form-control" name="search_assetlist">
        <option value="all">ทั้งหมด</option>
        <option value="opentype">OpenType</option>
        <option value="wall">ตู้ไอศครีม Wall</option>
    </select>

    <button id="search" name="search" type="submit">Search</button>
</form>
<br>
<form id="table_form" method="post">
<table class="table table- -->hover" border="0">
    <thead>
        <tr>
            <th style="width:50px">Index</th>
            <th style="width:100px">Store ID</th>
            <th style="width:100px">Store Name</th>
            <th style="width:100px">Asset ID</th>
            <th style="width:100px">Asset Shortname</th>
            <th style="width:100px">Asset Description</th>
            <th style="width:100px">Temperature</th>
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
</form>
<form id="back_form" action="<?= base_url("temp/logout") ?>" method="post" >
    <p>
        <input id="back_button" name="back_button" type="submit" value="Back" />
    </p>
</form>

<script type='text/javascript'>
        setTimeout($("#search_form").fieldcontain('refresh'),1000);
        function a() {
            setTimeout($("#search_form").fieldcontain('refresh'),1000); 
        }
</script>