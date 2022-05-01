
<br />

<div class="container">
	<div class="container-fluid">



	<img style="height: 260px; width: 100%;"
			src="<?php echo base_url("resources/musichub.jpg")?>">
		<br /> <br />
		<h3 align="center">
			<font color='red'>MUSIC</font>HUB
		</h3>

		<br />

		<div class="card mb-4">

			<div class="card-body">
				<div class="table-responsive">
					<table class="table" id="dataTable" width="100%"
						cellspacing="0">
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								 
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
						<tbody>


<?php
$cnt = 0;

foreach ($music_list as $ml) {
    $cnt ++;
    echo "<tr>";

    echo "<td>";
    echo "<i class='fa fa-music' aria-hidden='true' style='font-size:15px'></i>";
    echo "</td>";

    echo "<td>";
    echo "<font size='3' color='grey'>$ml[file_label]</font>";
    echo "</td>";

    echo "<td>";
    echo "<a href=$ml[music_link]>Download</a>";
    echo "</td>";

    echo "</tr>";
}
?>


                                        </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>