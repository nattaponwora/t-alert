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
            <th style="width:50px">ลำดับที่</th>
            <th style="width:100px">รหัสสาขา</th>
            <th style="width:100px">ชื่อสาขา</th>
            <th style="width:100px">อุปกรณ์</th>
            <th style="width:100px">หมายเลขบาร์โค้ด</th>
            <th style="width:100px">ชื่อย่ออุปกรณ์</th>
            <th style="width:100px">อุณหภูมิ</th>
            <th style="width:100px">เวลา</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($id > 0){
            
            foreach ($id as $r) {
                echo "<tr>";
                
                echo "<td>{$r['id']}</td>";
                echo "<td>{$r['store_id']}</td>";
                echo "<td>{$r['store_name']}</td>";
                echo "<td>{$r['asset_desc']}</td>";
                echo "<td>{$r['asset_barcode']}</td>";
                echo "<td>{$r['asset_shortname']}</td>";
                echo "<td>{$r['temp']}</td>";
                echo "<td>{$r['time']}</td>";
                
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
        setTimeout(a, 1000);
        function a() {
            $("#table_form").load("<?= base_url('temp')?> #table_form");
            setTimeout(a, 1000);
        }
</script>