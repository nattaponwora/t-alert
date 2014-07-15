<div class="container">
    <script type="text/javascript" src="<?= base_url("public/dynamic_dropdown.js") ?>"></script>
    <script type="text/javascript">
        function load_asset() {
            var search_value = document['search_form']['search_storeasset'].value; 
            var url = '<?= base_url("temp/load_states") ?>/' + search_value; 
            loadStates(url, 'search_assetlist');      
        }
        
        function load_assettype() {
            var search_value = document['search_form']['search_storeasset'].value; 
            var search_valuelist = document['search_form']['search_assetlist'].value; 
            var url = '<?= base_url("temp/load_statestype") ?>/' + search_value + '/' + search_valuelist; 
            loadStates(url, 'search_assettypelist');      
        }
    </script>
    
    <form name="search_form" id="search_form" class="form-inline" role="form" action="<?= base_url("temp/search") ?>" method="post">
        <label>รหัสร้าน</label>
        <div class="form-group">
            <?php if($searchTerm == null) { ?>
            <input id="search_storeasset" name="search_storeasset" type="text" value="" onchange="load_asset()" />
            <?php } ?>
            <?php if($searchTerm != null) { ?>
            <input id="search_storeasset" name="search_storeasset" type="text" value="<?= $searchTerm ?>" onchange="load_asset()" />
            <?php } ?>
        </div>
        
        <label>อุปกรณ์</label>
        <div class="form-group" id ='assetlist'>
            <?php $js = 'id="search_assetlist" class="btn btn-default dropdown-toggle" onchange="load_assettype()"'; ?>
            <?= form_dropdown('search_assetlist', $selection, $search_asset, $js); ?>
        </div>
        
        
        <label>หมายเลขอุปกรณ์</label>
        <div class="form-group" id ='assettypelist'>
            <select id='search_assettypelist' name="search_assettypelist" size="1" class="btn btn-default dropdown-toggle">
                <option value=" " selected="selected">โปรดเลือก</option>
            </select>
        </div>
        
        <button id="search" name="search" type="submit" class="btn btn-primary">
            Search
        </button>
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
            if ($id > 0) {
                $i = 1;
                foreach ($id as $r) {
                    echo "<tr>";
                    echo "<td>{$i}</td>";
                    echo "<td>{$r['store_id']}</td>";
                    echo "<td>{$r['store_name']}</td>";
                    echo "<td>{$r['type']}</td>";
                    echo "<td>{$r['asset_barcode']}</td>";
                    echo "<td>{$r['asset_shortname']}</td>";
                    echo "<td>{$r['temp']}</td>";
                    echo "<td>{$r['time']}</td>";
                    $i++;
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</form>

<ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">&raquo;</a></li>
</ul>

</div>
<script type='text/javascript'>
    setTimeout(a, 5000);
    function a() {
        $("#table_form").load("<?= base_url("temp/show/$searchTerm/$search_asset") ?>
        #table_form");
        setTimeout(a, 5000);
    }
</script>