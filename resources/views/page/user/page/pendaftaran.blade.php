@extends('page.user.index')
@section('title')
    Pendaftaran
@endsection
@section('content')
    <!-- Start Page Banner Area -->
		<div class="page-banner-area bg-8 pt-100">
			<div class="container">
				<div class="page-banner-content">
					<h2>Appointment</h2>
					<ul>
						<li>
							<a href="index-2.html">
								<i class="ri-home-8-line"></i>
								Home 
							</a>
						</li>
						<li>
							<span>Patient Care</span>
						</li>
						<li>
							<span>Appointment</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- End Page Banner Area -->

		<!-- Start Appointment Area -->
		<div class="appointments-area ptb-100">
			<div class="container">
				<div class="appointments-conetnt pb-100">
					<h2>Make an appointment</h2>

				<div class="appointments-form">
					<h2>Patient information</h2>

					<form action="{{ route('pendaftaran.store') }}" method="POST">
                        @csrf
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>YOUR NAME</label>
									<input type="text" class="form-control" name="nama_pasien" placeholder="Your name">
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>ALAMAT</label>
									<input type="text" name="alamat" class="form-control" placeholder="your address here">
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>CHOOSE DOCTOR NAME</label>
									<select class="form-select form-control" name="id_dokter" aria-label="Default select example">
										@forelse ($dokter as $dok)
                                            <option value="" selected>Choose Doctor</option>
                                            <option value="{{ $dok->id_dokter }}">{{ $dok->nama_dokter }}</option>
                                        @empty
                                            <option value="">No Option</option>
                                        @endforelse
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="form-group">
									<label>SELECT DEPARTMENT</label>
									<select class="form-select form-control" name="id_poli" aria-label="Default select example">
										@forelse ($poli as $pol)
                                            <option value="" selected>Choose Poli</option>
                                            <option value="{{ $pol->id_poli }}">{{ $pol->nama_poli }}</option>
                                        @empty
                                            <option value="">No Option</option>
                                        @endforelse
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>PHONE</label>
									<input type="text" name="no_telp" class="form-control" placeholder="***********">
								</div>
							</div>

							<div class="col-lg-12">
								<button type="submit" class="default-btn active">
									Make an appointment
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- End Appointment Area -->
@endsection