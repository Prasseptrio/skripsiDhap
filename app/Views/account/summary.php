<div class="container">
	Home <i class="lnr lnr-chevron-right"></i><span class="text-primary pl-2">My Account</span>
</div>
<section class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="list list-group shadow">
					<li class="list-group-item d-flex justify-content-between align-items-center active">
						Hi, Gilang Heavy Pradana
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<a href=""> Ringkasan Akun Saya</a>
						<span class="badge badge-primary badge-pill">2</span>
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Daftar Alamat
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Rekening Bank
					</li>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						Order
						<span class="badge badge-primary badge-pill">2</span>
					</li>
				</ul>
			</div>
			<div class="col-md-5">
				<h3 class="text-4 font-weight-bold">Ringkasan Akun</h3>
				<hr>
				<h3 class="text-4 font-weight-bold">Alamat Email <button type="button" class="btn btn-rounded btn-1 btn-primary mb-2" style="float: right" data-toggle="modal" data-target="#email">Ubah</button></h3>
				<h5 class="text-3 mb-4">gilangheavypradana@gmail.com</h5>
				<h3 class="text-4 font-weight-bold">Nomer Telepon <button type="button" class="btn btn-rounded btn-1 btn-primary mb-2" style="float: right" data-toggle="modal" data-target="#telephone">Ubah</button></h3>
				<h5 class="text-3 mb-4">0878787878</h5>
				<h3 class="text-4 font-weight-bold">Alamat Pengirim dan Penerima <button type="button" class="btn btn-rounded btn-1 btn-primary mb-2" style="float: right" data-toggle="modal" data-target="#alamat">Ubah</button></h3>
				<h5 class="text-3">Bapak / Ibu Gilang Heavy Pradana</h5>
				<h5 class="text-3 ">Jl. Semarang Kalibanteng no 7 , Semarang, </h5>
				<h5 class="text-3 ">Jawa Tengah </h5>
			</div>
			<div class="col-md-4">
				<h3 class="text-4 font-weight-bold">Ringkasan Transaksi</h3>
				<hr>
				<table class="table table-hoverable table-sm shadow bg-white">
					<tr>
						<th>
							Tanggal
						</th>
						<th>
							Invoice
						</th>
						<th>
							Status
						</th>
					</tr>
					<tbody>
						<tr>
							<td>
								1 January 2020
							</td>
							<td class="text-primary">
								INV-AX-999
							</td>
							<td>
								<i>Menunggu Konfirmasi</i>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModal4Label" aria-hidden="true">
		<div class="modal-dialog text-left" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModal4Label">Edit Alamat Email</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="contact-form form-style-2">
						<div class="form-group">
							<label for="recipient-name" class="form-control-label">Email:</label>
							<input type="text" class="form-control" value="gilangheavypradana@gmail.com">
						</div>
					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Ubah</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="telephone" tabindex="-1" role="dialog" aria-labelledby="exampleModal4Label" aria-hidden="true">
		<div class="modal-dialog text-left" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModal4Label">Edit Nomer Telephone</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="contact-form form-style-2">
						<div class="form-group">
							<label for="recipient-name" class="form-control-label">Nomer Telephone:</label>
							<input type="text" class="form-control" value="0878787878">
						</div>
					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Ubah</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="alamat" tabindex="-1" role="dialog" aria-labelledby="exampleModal4Label" aria-hidden="true">
		<div class="modal-dialog text-left" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModal4Label">Edit Alamat Pengirim dan Penerima</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="contact-form form-style-2">
						<div class="form-group">
							<label for="recipient-name" class="form-control-label">Alamat Pengirim Dan Penerima</label>
							<textarea class="form-control">Bapak / Ibu Gilang Heavy Pradana Jl. Semarang Kalibanteng no 7 , Semarang, Jawa Tengah</textarea>
						</div>
					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Ubah</button>
				</div>
			</div>
		</div>
	</div>
</section>