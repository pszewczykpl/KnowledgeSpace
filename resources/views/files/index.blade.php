@extends('master')

@section('subheader')
<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
	<div class="d-flex align-items-center flex-wrap mr-2">
		<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $title }}</h5>
		<div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
		<x-datatables.search-box-global />
	</div>
	<div class="d-flex align-items-center">
		<a href="{{ route('home.index') }}" class="btn btn-clean btn-sm mr-1">@include('svg.back', ['class' => 'navi-icon']) Powrót</a>
	</div>
</div>
@stop

@section('content')
<div class="container">
	<div class="d-flex flex-column flex-md-row">
		<div class="flex-md-row-fluid">
			<div class="card card-custom">
				<div class="card-header flex-wrap border-0 pt-6 pb-0">
					<h3 class="card-title align-items-start flex-column">
						<span class="card-label font-weight-bolder text-dark">{{ $title }}</span>
						<span class="text-muted mt-1 font-weight-bold font-size-sm">Przeglądaj dokumenty</span>
					</h3>
					<div class="card-toolbar">
						@can('create', App\Models\File::class)
						<a href="{{ route('files.create') }}" class="btn btn-light-primary btn-shadow font-weight-bold mr-2">
							<span class="svg-icon navi-icon">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24"/>
										<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
										<rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"/>
										<rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"/>
									</g>
								</svg>
							</span>
							Dodaj Dokument
						</a>
						@endcan
						@can('viewAny', App\Models\Trash::class)
							<a href="{{ route('trash.index', ['model' => 'files']) }}" class="btn btn-light-danger btn-shadow font-weight-bold ml-2">
								<span class="svg-icon navi-icon">
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"/>
											<path d="M6,8 L18,8 L17.106535,19.6150447 C17.04642,20.3965405 16.3947578,21 15.6109533,21 L8.38904671,21 C7.60524225,21 6.95358004,20.3965405 6.89346498,19.6150447 L6,8 Z M8,10 L8.45438229,14.0894406 L15.5517885,14.0339036 L16,10 L8,10 Z" fill="#000000" fill-rule="nonzero"/>
											<path d="M14,4.5 L14,3.5 C14,3.22385763 13.7761424,3 13.5,3 L10.5,3 C10.2238576,3 10,3.22385763 10,3.5 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
										</g>
									</svg>
								</span>
								Elementy usunięte
							</a>
						@endcan
					</div>
				</div>
				<div class="card-body">
					<div class="mb-1">
						<div class="alert alert-custom alert-light-primary fade show mb-5" role="alert">
							<div class="alert-icon">
								<i class="flaticon-info"></i>
							</div>
							<div class="alert-text">
								<b>Pamiętaj!</b><br>
								Poniżej znajdują się dokumenty dodane we wszystkich obiektach dostępnch w systemie.<br>
								Pojedynczy dokument może być powiązany z wieloma obiektami.
							</div>
							<div class="alert-close">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">
										<i class="ki ki-close"></i>
									</span>
								</button>
							</div>
						</div>
						<div class="row align-items-center">
							<x-datatables.search-box --size="3" --number="0" --placeholder="Nazwa" />
							<x-datatables.search-box --size="3" --number="1" --placeholder="Ścieżka" />
						</div>
					</div>
					<table class="table table-separate table-head-custom collapsed" id="table">
						<thead>
							<tr>
								<td>Nazwa</td>
								<td>Ścieżka</td>
								<td>Kategoria dokumentu</td>
								<td>Akcje</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('additional_css')
	<link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('additional_scripts')
	<script src="{{ asset('js/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/files/index.js') }}" type="text/javascript"></script>
@stop
