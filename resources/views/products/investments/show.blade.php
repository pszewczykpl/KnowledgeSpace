@extends('layouts.app')

@section('subheader')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm ml-3">
    <li class="breadcrumb-item">
		<span class="text-muted">{{ $investment->code_toil }}</span>
	</li>
	<li class="breadcrumb-item">
		<span class="text-muted">{{ $investment->edit_date }}</span>
	</li>
</ul>
@stop

@section('toolbar')
	<a href="{{ route('investments.index') }}" class="btn btn-clean btn-sm">@include('svg.back', ['class' => 'navi-icon']) Powrót</a>
	<a onclick="ShareInvestments('{{ $investment->id }}')" class="btn btn-light-primary btn-sm ml-1">@include('svg.share', ['class' => 'navi-icon']) Udostępnij</a>
	@can('update', $investment)
		<a href="{{ route('investments.edit', $investment->id) }}" class="btn btn-light-primary btn-sm ml-1">@include('svg.edit', ['class' => 'navi-icon']) Edytuj</a>
	@endcan
	@can('create', App\Models\Investment::class)
		<a href="{{ route('investments.duplicate', $investment) }}" class="btn btn-light-primary btn-sm ml-1">@include('svg.duplicate', ['class' => 'navi-icon']) Duplikuj</a>
	@endcan
	@can('delete', $investment)
		<a onclick='document.getElementById("investments_destroy_{{ $investment->id }}").submit();' class="btn btn-light-danger btn-sm ml-1">@include('svg.trash', ['class' => 'navi-icon']) Usuń</a>
		{{ Form::open([ 'method'  => 'delete', 'route' => [ 'investments.destroy', $investment->id ], 'id' => 'investments_destroy_' . $investment->id ]) }}{{ Form::close() }}
	@endcan
@stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-4">
			<div class="card card-custom gutter-b">
				<div class="card-header h-auto py-sm-0 border-0">
					@if($investment->status == 'N')
					<div class="card-title">
						<h3 class="card-label text-danger font-weight-bold"><b>Dokumenty Archiwalne</b></h3>
					</div>
					<div class="card-toolbar">
						<span class="label font-weight-bold label label-inline label-light-danger">Ważne</span>
					</div>
					@else
					<div class="card-title">
						<h3 class="card-label text-success font-weight-bold"><b>Dokumenty aktualne</b></h3>
					</div>
					@endif
				</div>
				<div class="card-body pt-0 pb-6">
					<p class="text-dark-50">
					@if($investment->status == 'N')
					<span class="font-weight-bold">Pamiętaj!</span> Dla wybranego prdouktu istnieje nowszy komplet dokumentów.
					@else
					To najnowszy komplet dokumentów dla wybranego produktu.
					@endif
					</p>
				</div>
			</div>
			<x-cards.details --title="Szczegóły ubezpieczenia" --description="Dane ubezpieczenia inwestycyjnego">
				<x-cards.details-row --attribute="Nazwa produktu" :value="$investment->name" />
				<x-cards.details-row --attribute="Kod produktu" :value="$investment->code" />
				<x-cards.details-row --attribute="Kod OWU" :value="$investment->code_owu" />
				<x-cards.details-row --attribute="Kod TOiL" :value="$investment->code_toil" />
				<x-cards.details-row --attribute="Grupa produktowa" :value="$investment->group" />
				<x-cards.details-row --attribute="Dystrybutor" :value="$investment->dist" />
				<x-cards.details-row --attribute="Kod dystrybutora" :value="$investment->dist_short" />
				<x-cards.details-row --attribute="Typ produktu" :value="$investment->type" />
			</x-cards.details>
			<x-cards.details --title="Historia rekordu" --description="Historia edycji rekordu">
				<x-cards.details-row --attribute="Data ostatniej edycji" :value="$investment->updated_at" />
				<x-cards.details-row --attribute="Data utworzenia" :value="$investment->created_at" />
				<x-cards.details-row --attribute="Utworzone przez" :value="$investment->user->fullname()" />
			</x-cards.details>
		</div>
		<div class="col-lg-8">
			<div class="card card-custom gutter-b">
				<div class="card-header card-header-tabs-line">
					<div class="card-toolbar">
						<ul class="nav nav-tabs nav-tabs-space-sm nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#notes" role="tab" aria-selected="false">
									<span class="nav-icon mr-2">
										<span class="svg-icon mr-2">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"/>
													<path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"/>
												</g>
											</svg>
										</span>
									</span>
									<span class="nav-text">Notatki</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#files" role="tab" aria-selected="true">
									<span class="nav-icon mr-2">
										<span class="svg-icon mr-2">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24"></polygon>
													<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
													<rect fill="#000000" x="6" y="11" width="9" height="2" rx="1"></rect>
													<rect fill="#000000" x="6" y="15" width="5" height="2" rx="1"></rect>
												</g>
											</svg>
										</span>
									</span>
									<span class="nav-text">Dokumenty</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#funds" role="tab" aria-selected="true">
									<span class="nav-icon mr-2">
										<span class="svg-icon mr-2">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24"/>
													<path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"/>
													<path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"/>
												</g>
											</svg>
										</span>
									</span>
									<span class="nav-text">Fundusze</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="card-body px-0">
					<div class="tab-content pt-2">
						<div class="tab-pane " id="notes" role="tabpanel">
							<x-panels.notes :notes="$investment->get_notes()" -type="investment" :id="$investment->id"  />
						</div>
						<div class="tab-pane active" id="files" role="tabpanel">
							<x-panels.files :files="$investment->get_files()" :name="$investment->extended_name()" -type="investment" :id="$investment->id" />
						</div>
						<div class="tab-pane" id="funds" role="tabpanel">
							<x-panels.funds :investmentid="$investment->id" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@push('css')
	<link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
	<script src="{{ asset('js/datatables.bundle.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pages/products/investments/show.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/components/panels/files.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/components/panels/funds.js') }}" type="text/javascript"></script>
@endpush