<?php
/**
* 
*/
class Customers extends WebStore {

	public function show() {
		$Query  = "SELECT * FROM `customers`";
		$Result = $this->database->run($Query);

		$totalRecs = $Result->num_rows;

		echo "
		<table class=\"table table-striped table-bordered table-hover\" id=\"customers_table\">
		<h1> Customers Table </h1>
		<thead>
		<tr>
		<th>Query ID #</th>
		<th>Customer Name</th>
		<th>Telephone Number</th>
		<th>Email Address</th>
		</tr>
		</thead>
		<tbody>";

		if($totalRecs == 0) {
			echo "No Data To Display";
		} else {
			$k = 1;
			while($Row = $Result->fetch_assoc()) {
				echo "
				<tr align=\"center\">
				<td>" . $Row['id'] . "</td>
				<td>" . ucwords($Row['name']) . "</td>
				<td><a href=\"tel:0" . $Row['telephone'] . "\"> 0" . $Row['telephone'] . "</a></td>
				<td><a href=\"mailto:" . $Row['emailaddress'] . "\">" . $Row['emailaddress'] . "</a></td>";
			}
		}
		echo "
		</tr>
		</tbody>
		</table>";
	}
}

?>