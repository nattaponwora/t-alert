<div class="box" style="background-color: beige	; margin-top: 100px; width: 70%">
	<form id="table_form" method="post">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" border="0">
			<caption style="font-size: 50px">
				Technician
			</caption>
			<thead>
				<tr>
					<th style="width:50px">ทีม</th>
					<th style="width:50px">หัวหน้าแผนก</th>
					<th style="width:50px">เบอร์โทร</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($id > 0) {
					foreach ($id as $r) {
						echo "<tr>";
						echo "<td>{$r['team']}</td>";
						echo "<td>{$r['tel']}</td>";
						echo "<td>{$r['supervisor_name']}</td>";
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