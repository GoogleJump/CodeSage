<?php 
	require_once('./php/config.php');
	require_once('./php/functions.php');
	$dbh = getDBH();
	
	if($_POST['submitCompete'] && $_POST['battleKey'] && $_SESSION['id']){
		JoinBattle($_POST['battleKey'], $_SESSION['id']);
	}


	$battleQuery = $dbh->prepare("SELECT * FROM battles ORDER BY createdAt DESC");
	$battleQuery->execute();
	
	$battles = array();
	while($battle = $battleQuery->fetch(PDO::FETCH_ASSOC)){
		$battles[] = $battle;
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Cutthroat Coding</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="./css/application.css" media="all" rel="stylesheet" type="text/css" />

	<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.1/css/jquery.dataTables.css">
  
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.1/js/jquery.dataTables.js"></script>

		<style>
		    body {
    overflow:hidden;
}
      .container {
  display: table;
  height: 100%;
  position: absolute;
  overflow: hidden;
  width: 100%;}
.helper {
  #position: absolute; /*a variation of an "lte ie7" hack*/
  #top: 50%;
  display: table-cell;
  vertical-align: middle;}

		</style>
	</head>
	<body>
		<div class="container">
     <div class="helper">

		<div class="bodyContainer" style="width: 900px;text-align:center;">
			<div class="row row-split">
				<div class="pageTitle" style="border-radius: 10px;">
					<h1>Find Battles</h1>
				</div>
				<div class="mainContent">
   	 				<table  id="battleTable" class="display">
						<thead>
							<tr>
								<th>Difficulty</th>
								<th>Languages</th>
								<th># Questions</th>
								<th>Player 1</th>
								<th>Player 2</th>
								<th>Spectate</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if(sizeof($battles) == 0){
								echo "<tr><td colspan=6>No battles occuring right now could be found</td></tr>";
							}
							foreach($battles as $battle){
								echo "<tr>
									<td>{$battle['difficulty']}</td>
									<td>{$battle['language']}</td>
									<td>{$battle['questionCount']}</td>";
									if($battle['player1ID'] == $_SESSION['id']){
										echo "<td><a href='./battle.php?id=".$battle['battleKey']."'>Re-join</a></td>";
									}else{
										echo "<td>{$battle['player1ID']}</td>";
									}
									if($battle['player2ID']){
										if($battle['player2ID'] == $_SESSION['id']){
											echo "<td><a href='./battle.php?id=".$battle['battleKey']."'>Re-join</a></td>";
										}else{
											echo	"<td>{$battle['player2ID']}</td>"; 
										}
									}else{ 
										if($battle['player1ID'] != $_SESSION['id']){
											echo "<td><form action='' method='POST'><input type='hidden' name='battleKey' value='".$battle['battleKey']."'><input type='submit' name='submitCompete' class='button minibutton pwmLButton' value='Compete'></form></td>"; 
										}else{
											echo "<td></td>";
										}
									}
									echo "<td><a href='./battle.php?id=".$battle['battleKey']."'>Watch</a></td>";
								echo "</tr>";
								}
						?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan=6></td>
							</tr>
						</tfoot>
					</table>
				</div>
   	 		</div>
			</div>
		</div>
	</div>
<script>
	$(document).ready( function () {
    $('#battleTable').DataTable();
} );
</script>
	</body>
</html>