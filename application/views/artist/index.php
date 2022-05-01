<div class="container" align="center">
	<br />
<?php
if ($artists) {
    echo '<table class="table table-hover table-inverse">
  <thead>
    <tr>
      <th>Name</th>
      <th>Surname</th>
      
<th>Tracks</th>
    
       <th></th>
    </tr>
  </thead>
  <tbody>';
    $cnt = 0;
    foreach ($artists as $a) {
        $cnt ++;
        echo "<tr>";
        echo "<td>$a[member_name]</td>";
        echo "<td>$a[member_surname]</td>";
        echo "<td><a href=" . base_url() . "artist/music_by_artist/$a[member_id]>View</td>";
        echo "</tr>";
    }
    echo "</tbody>
</table>";
}
?>
</div>