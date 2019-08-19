<?php
/**
* 
*/
class Products extends WebStore {

	public function show() {
		$Query  = "SELECT * FROM `products`";
		$Result = $this->database->run($Query);

		$totalRecs = $Result->num_rows;

		echo "
		<table class=\"table table-striped table-bordered table-hover\" id=\"products_table\">
		<h1> Products Table </h1>
		<thead>
		<tr>
		<th>Query ID #</th>
		<th>Domain Name</th>
		<th>Description</th>
		<th>Price</th>
		<th>Code</th>
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
				<td><a href=\"http://" . $Row['name'] . "\" target=\"_blank\">" . $Row['name'] . "</a></td>
				<td>" . $Row['description'] . "</td>
				<td>Ksh " . $Row['price'] . "</td>
				<td>" . $Row['code'] . "</td>";
			}
		}
		echo "
		</tr>
		</tbody>
		</table>";
	}
}

?>