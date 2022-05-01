
<br />
<div class="container-fluid">
	<h3 align="center">MUSIC HUB</h3>
	<br />
	<div class="card mb-4">

		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="dataTable" width="100%"
					cellspacing="0">
					<thead>
						<tr>
							<th></th><th></th><th></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th></th><th></th><th></th>

						</tr>
					</tfoot>
					<tbody>
        				<?php
            $cnt = 0;
            foreach ($music_list as $ml) {
                $cnt ++;
                echo "<tr>";

                echo "<td>";
                echo "<i class='fa fa-music' aria-hidden='true'></i>";
                echo "</td>";

                echo "<td>";
                echo "<font size='4' color='grey'>$ml[file_label]</font>";
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
<br />
<?php
echo '<div align="center"><div><a href=' . base_url() . 'music/choose_category class="btn btn-danger" role="button">Change Category</a>';
if ($user_session['username'] != "active@phangisa.co.za") {
    echo ' <a href=' . base_url() . 'music/upload_form class="btn btn-primary" role="button">Upload</a>';
}
echo '</div></div>';
?>            
           
            
            
            
            
            
 