
<section id="body" style="background-color: #fff; color: black">
	<div class="container-fluid" style="padding-left: 10px; padding-right: 10px; padding-top: 30px;background-color:  #e8be04;">
		<br><br><br>
		<div class="row">
			<div class="col-12">
				<div class="single-footer-widget" style="">
					<?php if (is_array($search)) { ?>
						<?php foreach ($search as $key) { ?>
							<div class="row" data-toggle="modal" data-target="#show-data">
								<div class="col-md-7">
									<h2><?php echo $key->name; ?> In <?php echo $key->city; ?></h2><br>
									<b>
										<font color="black"><?php echo $key->venue; ?></font>
									</b>
									<br>
									<i style="color: #fff ;"><i class="fa fa-map-marker">&nbsp;</i><?php echo $key->city; ?>,&nbsp;<?php echo $key->country; ?></i>
								</div>
							</div>
						<?php }
					} else { ?>
						<h3>Is Empty</h3>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-3 card" style="padding-left: 13px">
			<ul class="tab">
				<li><a href="#" class="tablinks" onclick="openCity(event, 'Ticket')">A-Z</a></li>
			</ul>

			<div id="Ticket" class="tabcontent">
				<?php if (!empty($ticket)) { ?>
					<?php if (!empty($numberTicket)) { ?>
						<table class="table text-left">
							<tbody style="color: black">
								<h5>The Number of Ticket You Want : <?php echo $numberTicket[0]; ?></h5>
								<br>
								<?php if (is_array($ticket)) { ?>
									<?php foreach ($ticket as $key) { ?>
										<tr onclick="window.location='<?php echo site_url() ?>/Search/detailTicket/<?php echo $key->idSchedule; ?>/<?php echo $key->idPrice; ?>'">
											<th scope="row">
												<h4><?php echo $key->seatZone; ?></h4>
												<br>
												<h5>Remaining Tickets : <?php echo $key->remainTicket; ?></h5>
											</th>
											<td width="50px">
												<button class="btn btn-outline-warning" style="width: 110px">Rp.<?php echo $key->price; ?></button>
											</td>
										</tr>
									<?php }
								} else { ?>
									<tr>
										<th scope="row" colspan="3">
											<h3>Is Empty</h3>
										</th>
									</tr>
								<?php }
							} else { ?>
							<?php } ?>
							</tbody>
						</table>
					<?php } ?>

					<?php if (!empty($detail)) { ?>
						<?php if (!empty($numberTicket)) : ?>
							<h5>The Number of Ticket You Want : <?php echo $numberTicket[0]; ?></h5>
						<?php endif; ?>
						<br>
						<?php if (is_array($detail)) { ?>
							<div class="row">
								<div class="col-7">
									<h3>Rp.<?php echo $detail[0]->price; ?></h3>
									<p style="color: grey">Includes $19 seller and delivery fees</p>
								</div>
								<div class="col-5">
									<a href="<?php echo site_url() ?>/Payment/home/<?php echo $detail[0]->idPrice; ?>"><button class="btn btn-outline-warning" style="width: 110px">Checkout</button></a>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-2" style=""><i class="fa fa-clock-o" style="font-size:35px;color:black;margin-top: -9px"></i>
									<br>
									<i class="fa fa-ticket" style="font-size:35px;color:black;margin-top: 20px"></i>
									<br>
									<i class="fa fa-bank" style="font-size:35px;color:black;margin-top: 20px"></i>

								</div>
								<div class="col-10">
									<b>
										<p style="color: black">At <?php echo $detail[0]->startTime; ?></p>
										<hr />
										<p style="color: black"><?php echo $detail[0]->remainTicket; ?> Remaining Tickets</p>
										<hr />
										<p style="color: black"><?php echo $detail[0]->seatZone; ?></p>
									</b>
									<br><br><br><br>
								</div>
							</div>

						<?php } else { ?>
							<h3>Is Empty</h3>
						<?php }
					} else { ?>
					<?php } ?>

			</div>
		</div>

		<div class="col-md-1"></div>
		<div class="col-md-8" style="padding-top: 70px; padding-bottom: 20px; ">
			<center><img src="<?php echo base_url() ?>assets/imgEvent/<?php echo $search[0]->photo; ?>" width="800" height="370" style="border-radius: 5px;"></center>
		</div>

	</div>
</section>

<!-- Modal Tambah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="show-data" class="modal fade-in show">
	<div class="modal-dialog" style="max-width: 900px; max-height: 500px">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $search[0]->name; ?></h4>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<div class="row">
						<div class="col-4 scroll" style='overflow:auto;width:400px;height:500px;'>
							<center><img src="<?php echo base_url() ?>/assets/imgEvent/<?php echo $search[0]->pict ?>" width="200px"></center><br>
							
						</div>
						<div class="col-8">
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th scope="col" colspan="2">Event Details</th>
									</tr>
								</thead>
								<tbody style="color: black">
									<tr class="no-hover">
										<th scope="row">Venue</th>
										<td>
											<h1><?php echo $search[0]->venue; ?>,&nbsp;<?php echo $search[0]->city; ?>,&nbsp;<?php echo $search[0]->country; ?></h1>
										</td>
									</tr>
									<tr class="no-hover">
										<th scope="row">Date</th>
										<td><?php echo $search[0]->date; ?></td>
									</tr>
									<tr class="no-hover">
										<th scope="row">Time</th>
										<td><?php echo $search[0]->startTime; ?></td>
									</tr>
									<tr class="no-hover">
										<th scope="row">Performer</th>
										<td><?php echo $search[0]->artist; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('components/footer'); ?>

<!-- End footer Area -->

<script src="<?php echo base_url(); ?>assets/assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/superfish.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/jquery.ajaxchimp.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/main.js"></script>


<script type="text/javascript">
	<?php if (empty($numberTicket)) { ?>
		$('#myModal').modal('show');
	<?php } ?>
</script>

<script>
	document.getElementsByClassName('tablinks')[0].click()

	function openCity(evt, className) {
		document.getElementById(className).style.display = "block";
		evt.currentTarget.className += " active";
	}

	$('#show-data').modal('show');
</script>


</body>

</html>
