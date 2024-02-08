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
										$monogram_data = json_decode($data->monogram);
										$pro_data = $this->db->get_where('tbl_products', array('series_id' => $data->pro_id, 'series_id' => $data->series_id))->row();

									?>
										<tr>
											<td><?php echo $i ?> </td>
											<td><img src="<?= $data->img ?>" style="width:150px;height:150px"></td>
											<td>
												<a href="<?= base_url() ?>Home/product_details/<?= $pro_data->series_id ?>/<?= $pro_data->pro_id ?>?groupId=<?= $pro_data->group_id ?>" target="_blank" rel="noopener noreferrer">
													<?= $data->description ?>
													<? if (!empty($data->ring_size)) { ?>
														<p><span><b>Ring Size : </b></span><?= $data->ring_size ?></p>
													<? } ?>
													<? if (!empty($data->mono_chain_length)) { ?>
														<p><span><b>Chain Length : </b></span><?= $data->mono_chain_length ?></p>
													<? } ?>
													<? if (!empty($monogram_data)) { ?>
														<p><span><b>Monogram : </b></span>
															<? foreach ($monogram_data as  $mono) { ?>
																<span><b><?= $mono->Text ?> - </b> <?= $mono->Value ?> <b>|</b> </span>
															<? } ?>
														</p>
													<? } ?>
													<? if (!empty($gem_data)) { ?>
														</br><span><b>Stones : </b></span>
														<? foreach ($gem_data as  $gem) {
															if (!empty($gem->Product)) {
																$item = $gem->Product;
															} else if (!empty($gem->Diamond)) {
																$item = $gem->Diamond;
															} else if (!empty($gem->GemStone)) {
																$item = $gem->GemStone;
															} else if (!empty($gem->LabGrownDiamond)) {
																$item = $gem->LabGrownDiamond;
															} ?>
															<? if (!empty($item->Description)) { ?>
																<span> <?= $item->Description ?> <b>|</b> </span>
															<? } else if (!empty($item->SerialNumber)) { ?>
																<span> <?= $item->SerialNumber ?> <b>|</b> </span>
															<? } else { ?>
																<span> <?= $item->Id ?> <b>|</b> </span>
															<? } ?>
														<? } ?>
													<? } ?>
												</a>
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