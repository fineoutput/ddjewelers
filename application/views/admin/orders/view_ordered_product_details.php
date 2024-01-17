<div class="content-wrapper">
	<section class="content-header">
		<h1>
			View Products Details
		</h1>
		<a class="btn btn-info cticket" href="<?php echo base_url() ?>dcadmin/OrdersNew/new_orders" role="button" style="margin-bottom:12px;"> Back</a>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url() ?>dcadmin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo base_url() ?>dcadmin/college"><i class="fa fa-dashboard"></i> View Orders </a></li>
			<li class="active">View Products Details</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-12">

				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-money fa-fw"></i>View Products Details</h3>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="">
							<table class="table table-bordered table-hover table-striped" id="userTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Image</th>
										<th>Product</th>
										<th>Quantity</th>
										<th>Amount</th>
										<th>Date</th>
									</tr>
								</thead>

								<tbody>
									<?php $i = 1;
									foreach ($ordered_product_details_data->result() as $data) {
										$gem_data = json_decode($data->gem_data);
									?>
										<tr>
											<td><?php echo $i ?> </td>
											<td><img src="<?= $data->img ?>" style="width:150px;height:150px"></td>
											<td><?= $data->description ?>
												<? if (!empty($gem_data)) { ?>
													</br><span><b>Stones : </b></span>
													<? foreach ($gem_data as  $gem) { ?>
														<span><?= $gem->Product->Description ?> <b>|</b> </span>
												<? }
												} ?>
											</td>
											<td><?php echo $data->quantity ?></td>
											<td>$<?php echo $data->amount ?></td>
											<td><?
												$newdate = new DateTime($data->date);
												echo $newdate->format('j F, Y, g:i a');   #d-m-Y  // March 10, 2001, 5:16 pm
												?></td>
										</tr>
									<?php $i++;
									} ?>
								</tbody>
							</table>

						</div>
					</div>
				</div>

			</div>

		</div>
</div>
</section>
</div>


<style>
	label {
		margin: 5px;
	}
</style>

<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(document.body).on('click', '.dCnf', function() {
			var i = $(this).attr("mydata");
			console.log(i);

			$("#btns" + i).hide();
			$("#cnfbox" + i).show();

		});

		$(document.body).on('click', '.cans', function() {
			var i = $(this).attr("mydatas");
			console.log(i);

			$("#btns" + i).show();
			$("#cnfbox" + i).hide();
		})

	});
</script>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/slider/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/slider/rs.js"></script>	  -->