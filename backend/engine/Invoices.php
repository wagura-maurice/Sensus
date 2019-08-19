<?php
/**
* 
*/
class Invoices extends WebStore {

	public function Invoice($id, $value) {
		// query the invoice table rows using the id and return required value
		$Query  = "SELECT * FROM `invoices` WHERE `id` = '$id'";
		$Result = $this->database->run($Query);
		$Row = $Result->fetch_assoc();

		return $Row[$value];
	}

	public function Serial($value) {
		// Serialize Invoice ID 
		return str_pad($value, 5,'0', STR_PAD_LEFT);
	}

	public function getCustomers($value, $id) {
		// return value from customers table row where is assigned
		$Query = "SELECT `$value` FROM `customers` WHERE `id` = '$id'";
		$Result = $this->database->run($Query);
		$Row    = $Result->fetch_assoc();

		return $Row[$value];
	}

	public function Extractor($Products) {
		// custom function to extract and clean the products 'string' array
		$data = [substr(substr($Products, 2), 0 , -2)]; // convert products string to array
		// use explode & array_slice functions to extract array data
		$products = [];
		foreach ($data as $key => $value) {
			explode('[',$value);
			explode('[',$value);
			explode(']',$value);
			explode(']',$value);
			$products[] = array_slice(explode('\"',$value), 1, -1);
		}

		$prod = [];
		$keys = array_keys($products);
		for($i = 0; $i < count($products); $i++) {
			foreach($products[$keys[$i]] as $key => $value) {
				// clean array data
				if ($value != "," && $value != ']","[' && $value != 'ksh') {
					$prod[] = $value;
				}
			}
		}

		$products = array_chunk($prod, 4);
		$keys = array_keys($products);
		// declare the return array
		$return = [];
		for($i = 0; $i < count($products); $i++) {
			foreach($products[$keys[$i]] as $key => $value) {
				// loop to assign each value for each chunk of the array to the return array
				$return[] = $value;
			}
		}
		return array_chunk($return, 4); // return split chunks of the array
	}

	public function InvoiceTL($value) {
		// get invoice data for each customer
		$Query  = "SELECT * FROM `invoices` WHERE `customers_id` = $value";
		$Result = $this->database->run($Query);
		while($Row = $Result->fetch_assoc()) {
			$stack = $this->Extractor($Row['products']); // load array from the Extractor function
			for($i = 0; $i < count($stack); $i++) {
				// push serialized invoice id and quantity to the array
				array_push($stack[$i], 1, $this->Serial($i + 1));
			}

			$stack1 = [];
			for($i = 0; $i < count($stack); $i++) {
				// realign the array keys in the format of the invoice table interface
				$stack1[$i] = [$stack[$i][5], $stack[$i][0], $stack[$i][1], $stack[$i][2], $stack[$i][4], $stack[$i][3]];
			}

			$return = NULL; // declare a null string to return
			$keys = array_keys($stack1);
			for($i = 0; $i < count($stack1); $i++) {
				$return .= "<tr>";
				foreach($stack1[$keys[$i]] as $key => $value) {
					if ($value != "," && $value != ']","[') {
						// clean the array, then assign it to the HTML table interface
						$return .= "<th>" . $value . "</th>";
					}
				}
				$return .= "</tr>";
			}
		}

		return $return; // return string
	}

	public function show() {
		// check if super global $_GET is set and if is numeric or not
		if (isset($_GET['invoice']) && is_numeric($_GET['invoice'])) {
			// get data form invoice where id is that provided in the super global $_GET
			$Query  = "SELECT * FROM `invoices` WHERE `id` = " . $_GET['invoice'];
			$Result = $this->database->run($Query);

			$totalRecs = $Result->num_rows;

			if($totalRecs == 0) {
				// if id is not in the database then echo no data
				echo "No Data To Display";
			} else {
				// get invoice information and store to $Row array
				$Row     = $Result->fetch_assoc();
				// get customer information and store to $client array
				$QueryC  = "SELECT * FROM `customers` WHERE `id` = " . $Row['customers_id'];
				$ResultC = $this->database->run($QueryC);
				$Client  = $ResultC->fetch_assoc();
				// load return of InvoiceTL function
				$tableData = $this->InvoiceTL($Row['customers_id']);

				echo "
				<div class=\"container\">
					<button class=\"btn btn-default pull-right\" onclick=\"window.history.go(-1)\">Back to Listing</button><div class=\"well well-sm\"><h4><strong>Web Store Invoice No. " . $this->Serial($Row['id']) . "</strong></h4></div><div class=\"row\">
					<div class=\"col-xs-12\">
						<div class=\"pull-left\">
							<address>
								<strong>" . ucwords($Client['name']) . "</strong><br>
								<abbr title=\"Mobile Phone\">Phone:</abbr> " . $Client['telephone'] . "<br/>
								<abbr title=\"Email Address\">Email:</abbr> " . $Client['emailaddress'] . "
							</address>
						</div>
						<div class=\"pull-right\">
							<p class=\"m-t-10\"><strong>Order Status: </strong> <span class=\"label label-danger\">" . $Row['status'] . "</span></p>
							<p class=\"m-t-10\"><strong>Order ID: </strong> # " . $this->Serial($Row['id']) . "</p>
						</div>
					</div><!-- end col -->
				</div><div class=\"row\">
				<div class=\"col-xs-12\">
					<div class=\"table-responsive\">
						<table class=\"table m-t-30\">
							<thead class=\"bg-faded\">
								<tr>
									<th>#</th>
									<th>Product No</th>
									<th>Item</th>
									<th>Description</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>" . $tableData . "</tbody>
						</table>
					</div>
				</div>
				</div><div class=\"row\">
				<div class=\"col-md-6 col-sm-6 col-xs-6\">
					<div class=\"clearfix m-t-30\">
						<h5 class=\"small text-inverse font-600\"><b>PAYMENT TERMS AND POLICIES</b></h5>
						<small>
							All accounts are to be paid within 7 days from receipt of
							invoice. To be paid by cheque or credit card or direct payment
							online. If account is not paid within 7 days the credits details
							supplied as confirmation of work undertaken will be charged the
							agreed quoted fee noted above.
						</small>
					</div>
				</div>
				<div class=\"col-md-3 col-sm-6 col-xs-6 col-md-offset-3\">
					<p class=\"text-xs-right\"><b>Sub-total:</b> " . number_format($Row['total']) . "</p>
					<p class=\"text-xs-right\">Discout: 0%</p>
					<p class=\"text-xs-right\">VAT: 0%</p>
					<hr>
					<h3 class=\"text-xs-right\">KSH " . number_format($Row['total']) . "</h3>
				</div>
				</div>
				</div>";
			}
		} else {
			// if super global $_GET was not set run the invoice data only
			$Query  = "SELECT * FROM `invoices`";
			$Result = $this->database->run($Query);

			$totalRecs = $Result->num_rows;
			
			if($totalRecs == 0) {
				echo "No Data To Display";
			} else {
				echo "
				<table class=\"table table-striped table-bordered\">
					<thead>
						<tr>
							<th>Invoice #</th>
							<th>Customer</th>
							<th>Total</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
				";
				while($Row = $Result->fetch_assoc()) {
					// echo the invoice table data
					echo "
					<tr align=\"center\">
					<td>" . $this->Serial($Row['id']) . "</td>
					<td>" . ucwords($this->getCustomers('name', $Row['customers_id'])) . "</td>
					<td>Ksh " . $Row['total'] . "</td>
					<td><span class=\"label label-danger\">" . $Row['status'] . "</span></td>
					<td><a href=\"?invoice=" . $Row['id'] . "\" class=\"btn btn-default\" role=\"button\">Show more</a></td>
					";
				}
				echo "</tr></table>";
			}
		}
	}
}