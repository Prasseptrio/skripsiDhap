			<section id="aboutus" class="section pb-lg-0">
				<div class="container">
					<div class="row">
						<div class="col-md-5">
							<div class="overflow-hidden">
								<span class="top-sub-title text-color-primary d-block appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="100">HUBUNGI LAYANAN KAMI 24/7</span>
							</div>
							<div class="overflow-hidden mb-3">
								<h2 class="word-rotator letters type font-weight-bold text-5 mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">
									<span>Solusi untuk</span>
									<span class="word-rotator-words waiting">
										<b class="is-visible">Transaksi</b>
										<b>Akun</b>
										<b>Pengiriman</b>
									</span>
								</h2>
							</div>
							<div class="overflow-hidden mb-3">
								<p class="lead mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="400">Alenxi Technology menyediakan layanan Dukungan Kustomer (Customer Support) 24 jam dalam 7 hari untuk membantu mengatasi dan memberikan solusi bagi masalah anda dalam bertransaksi. Anda dapat menyampaikan keluhan terkait kendala bertransaksi melalui layanan telepon, live chat maupun email yang akan langsung tersambung dengan Customer Service kami.</p>
							</div>

							<div class="overflow-hidden mb-3">
								<strong>
									<p class="mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="600">
										Kenyamanan dan kepuasan anda dalam bertransaksi menjadi fokus utama kami untuk terus memberikan pelayanan yang terbaik.
									</p>
								</strong>
							</div>
						</div>
						<div class="col-md-7" style="margin-top: -10%">
							<!--								<img src="<?= base_url('assets/'); ?>img/others/desktop-concept-1.png" class="img-fluid concept-pos-1" alt="" />-->
							<img src="https://www.alenxi.com/image/customer_support/customer_support_baru.png" class="img-fluid concept-pos-1" alt="alenxi support" width="70%" />
						</div>
					</div>
				</div>
			</section>
			<section class="section bg-light-5">
				<div class="container">
					<div class="row mb-5">
						<div class="col">
							<!--<div class="overflow-hidden">
									<span class="top-sub-title text-color-primary d-block appear-animation" data-appear-animation="maskUp">HI, HOW ARE YOU?</span>
								</div>-->
							<div class="overflow-hidden mb-3">
								<h2 class="font-weight-bold mb-0 appear-animation" data-appear-animation="maskUp" data-appear-animation-delay="200">Hi, Ada yang bisa kami bantu ?</h2>
							</div>
						</div>
					</div>
					<div class="row align-items-baseline mb-4 pb-2">
						<div class="col-sm-6 col-lg-3">
							<div class="icon-box-animation-1">
								<div class="icon-box icon-box-style-3 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400">
									<div class="icon-box-icon">
										<img width="42" height="42" src="<?= base_url('assets/'); ?>vendor/linear-icons/tablet.svg" alt="" data-icon data-plugin-options="{'color': '#2388ED', 'animated': true, 'delay': 400}" />
									</div>
									<div class="icon-box-info">
										<div class="icon-box-info-title">
											<h3 class="font-weight-bold text-4 mb-3">REGISTRASI/DAFTAR</h3>
											<?php foreach ($informasi as $i) {
												$t = $i['category_information_id'];
												$s = $i['status_id'];
												if ($t == 1 && $s == 1) { ?>
													<a href="<?= base_url('support/support/detail/' . $i['information_id']); ?>"><span class="top-sub-title" value="<?php echo $i['category_information_id']; ?>">- <?php echo $i['title']; ?></span> </a>
													<br>
													<br>
											<?php }
											} ?>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="icon-box-animation-1">
								<div class="icon-box icon-box-style-3 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="100">
									<div class="icon-box-icon">
										<img width="48" height="48" src="<?= base_url('assets/'); ?>vendor/linear-icons/select.svg" alt="" data-icon data-plugin-options="{'color': '#2388ED', 'animated': true, 'delay': 700}" />
									</div>
									<div class="icon-box-info">
										<div class="icon-box-info-title">
											<h3 class="font-weight-bold text-4 mb-3">PEMESANAN</h3>
											<?php foreach ($informasi as $i) {
												$t = $i['category_information_id'];
												$s = $i['status_id'];
												if ($t == 2 && $s == 1) { ?>
													<a href="<?= base_url('support/support/detail/' . $i['information_id']); ?>"><span class="top-sub-title" value="<?php echo $i['category_information_id']; ?>">- <?php echo $i['title']; ?></span> </a>
													<br>
													<br>
											<?php }
											} ?>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="icon-box-animation-1">
								<div class="icon-box icon-box-style-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="100">
									<div class="icon-box-icon">
										<img width="42" height="42" src="<?= base_url('assets/'); ?>vendor/linear-icons/magnifier.svg" alt="" data-icon data-plugin-options="{'color': '#2388ED', 'animated': true, 'delay': 1000}" />
									</div>
									<div class="icon-box-info">
										<div class="icon-box-info-title">
											<h3 class="font-weight-bold text-4 mb-3">PEMBAYARAN</h3>
											<?php foreach ($informasi as $i) {
												$t = $i['category_information_id'];
												$s = $i['status_id'];
												if ($t == 3 && $s == 1) { ?>
													<a href="<?= base_url('support/support/detail/' . $i['information_id']); ?>"><span class="top-sub-title" value="<?php echo $i['category_information_id']; ?>">- <?php echo $i['title']; ?></span> </a>
													<br>
													<br>
											<?php }
											} ?>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="icon-box-animation-1">
								<div class="icon-box icon-box-style-3 appear-animation" data-appear-animation="fadeInRightShorter" data-appear-animation-delay="400">
									<div class="icon-box-icon">
										<img width="42" height="42" src="<?= base_url('assets/'); ?>vendor/linear-icons/tag.svg" alt="" data-icon data-plugin-options="{'color': '#2388ED', 'animated': true, 'delay': 1300}" />
									</div>
									<div class="icon-box-info">
										<div class="icon-box-info-title">
											<h3 class="font-weight-bold text-4 mb-3">FUNGSIONAL PRODUK</h3>
											<?php foreach ($informasi as $i) {
												$t = $i['category_information_id'];
												$s = $i['status_id'];
												if ($t == 4 && $s == 1) { ?>
													<a href="<?= base_url('support/support/detail/' . $i['information_id']); ?>"><span class="top-sub-title" value="<?php echo $i['category_information_id']; ?>">- <?php echo $i['title']; ?></span> </a>
													<br>
													<br>
											<?php }
											} ?>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>