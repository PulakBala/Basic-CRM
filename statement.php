<?php
include('includes/header.php');
include('financial_functions.php');
include('includes/sidebar.php');
?>
<main class="content">
	<div class="container-fluid p-0">
		<!-- Add Year Filter -->
		<div class="row justify-content-center mb-4">
			<div class="col-12 col-lg-12 col-xxl-11">
				<form method="GET" class="d-flex justify-content-end">
					<div class="form-group" style="width: 200px;">
						<div class="input-group">
							<select name="year" class="form-control" onchange="this.form.submit()">
								<?php
								$currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
								$startYear = 2020; 
								for($year = date('Y'); $year >= $startYear; $year--) {
									$selected = ($year == $currentYear) ? 'selected' : '';
									echo "<option value='$year' $selected>$year</option>";
								}
								?>
							</select>
							<div class="input-group-append ">
								<span class="input-group-text">
									<i class="fas fa-calendar-alt p-1"></i>
								</span>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		
		<!-- all  user  -->
		<div class="row justify-content-center">
			<div class=" table-responsive" >
				<table class="table table-bordered table-striped ">
					<thead style="background-color: black; color: white;">
						<tr>
							<th style="color: white;">MONTH</th>
							<th style="color: white; text-align: center;">TOTAL SALE</th>
							<th style="color: white; text-align: center;">TOTAL EXPENSE</th>
							<th style="color: white; text-align: center;">PROFIT/LOSS</th>
							<th style="color: white; text-align: center;">GROWTH</th>
							<!-- <th style="color: white; text-align: center;">STATEMENT</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						$previousProfit = 0;
						for ($i = 1; $i <= 12; $i++):
							$monthName = date('F', mktime(0, 0, 0, $i, 10));
							$totalRevenue = getTotalRevenue($i, $currentYear); // Update function to accept year
							$totalExpense = getTotalExpense($i, $currentYear); // Update function to accept year
							$profitLoss = $totalRevenue - $totalExpense;
							
							// Growth calculation showing percentage between -100% to +100%
							if ($previousProfit != 0) {
								if ($profitLoss >= $previousProfit) {
									// Positive or zero growth (0% to 100%)
									$growth = min(100, (($profitLoss - $previousProfit) / abs($previousProfit)) * 100);
								} else {
									// Negative growth (-100% to 0%)
									$growth = max(-100, (($profitLoss - $previousProfit) / abs($previousProfit)) * 100);
								}
							} else if ($profitLoss != 0) {
								// Previous month was 0, but current month has profit/loss
								$growth = ($profitLoss > 0) ? 100 : -100;
							} else {
								// Both months are 0
								$growth = 0;
							}
							
							// Add growth direction indicator (↑ or ↓)
							$growthDisplay = $growth == 0 ? "0%" : 
											($growth > 0 ? "↑" . number_format($growth, 2) . "%" : 
														 "↓" . number_format(abs($growth), 2) . "%");
							
							$previousProfit = $profitLoss;
						?>
							<tr>
								<td><?php echo $monthName; ?></td>
								<td class="text-center"><?php echo number_format($totalRevenue, 2); ?> BDT</td>
								<td class="text-center"><?php echo number_format($totalExpense, 2); ?> BDT</td>
								<td class="text-center <?php echo $profitLoss > 0 ? 'text-success' : ($profitLoss < 0 ? 'text-danger' : ''); ?>">
									<?php echo number_format($profitLoss, 2); ?> BDT
								</td>
								<td class="text-center <?php echo $growth > 0 ? 'text-success' : ($growth < 0 ? 'text-danger' : ''); ?>">
									<?php echo $growthDisplay; ?>
								</td>
								
							</tr>
						<?php endfor; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>
<?php include('includes/footer.php') ?>