<div class="box" style="background-color: beige	; margin-top: 100px; width: 60%">
        <form id="table_form" method="post">
        <div class="table-responsive">
            <table class="table table-hover .table-condensed" border="0">
            	<caption style="font-size: 50px">Store</caption>
                <thead>
                    <tr>
                        <th style="width:50px">รหัสร้าน</th>
                        <th style="width:50px">ชื้อร้าน</th>
                        <th style="width:50px">เขต</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($id > 0) {
                        foreach ($id as $r) {
                            echo "<tr>";
                            echo "<td>{$r['store_id']}</td>";
                            echo "<td>{$r['store_name']}</td>";
                            echo "<td>{$r['opt_team']}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
            </div>
        </form>
</ul>
</div>