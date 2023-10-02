<!-- Sidebar -->
<style>
    .sub_icon {
        font-size: 14px !important;
        margin: 0 2px 0 10px !important;
    }
</style>
@isset($ssm)
    @php $ssm = $ssm; @endphp
@else
    @php $ssm = ''; @endphp
@endisset
<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            {{-- <div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="{{asset('backend/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							Hizrian
							<span class="user-level">Administrator</span>
							<span class="caret"></span>
						</span>
					</a>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							<li>
								<a href="#profile">
									<span class="link-collapse">My Profile</span>
								</a>
							</li>
							<li>
								<a href="#edit">
									<span class="link-collapse">Edit Profile</span>
								</a>
							</li>
							<li>
								<a href="#settings">
									<span class="link-collapse">Settings</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
            </div> --}}

            <ul class="nav">
                <li class="nav-item {{ $p == 'da' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @if (Auth::user()->permission == 1)
                    <li class="nav-item {{ $p == 'admin' ? 'active' : '' }}">
                        <a data-toggle="collapse" href="#admin">
                            <i class="fas fa-users-cog"></i>
                            <p>Admin</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $p == 'admin' ? 'show' : '' }}" id="admin">
                            <ul class="nav nav-collapse">
                                <li class="{{ $sm == 'adminIndex' ? 'activeSub' : '' }}">
                                    <a href="{{ route('admin-user.index') }}">
                                        <span class="sub-item">User Management</span>
                                    </a>
                                </li>
                                <li class="{{ $sm == 'slider' ? 'activeSub' : '' }}">
                                    <a href="{{ route('slider.index') }}">
                                        <span class="sub-item">Slider</span>
                                    </a>
                                </li>
                                <li class="{{ $sm == 'notice' ? 'activeSub' : '' }}">
                                    <a href="{{ route('notice.index') }}">
                                        <span class="sub-item">Notice</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item {{ $p == 'farmSett' ? 'active submenu' : '' }}">
                        <a data-toggle="collapse" href="#invoice">
                            <i class="fas fa-tools"></i>
                            <p>Farm Settings</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ $p == 'farmSett' ? 'show' : '' }}" id="invoice">
                            <ul class="nav nav-collapse">
                                <li class="{{ $sm == 'farm' ? 'active' : '' }} ">
                                    <a href="{{ route('research-farm.index') }}">
                                        <span class="sub-item">Research Farm</span>
                                    </a>
                                </li>
                                <li class="{{ $sm == 'commCat' ? 'active' : '' }}">
                                    <a href="{{ route('community-cat.index') }}">
                                        <span class="sub-item">Community Farm</span>
                                    </a>
                                </li>

                                <li class="{{ $sm == 'comm' ? 'active' : '' }}">
                                    <a href="{{ route('community.index') }}">
                                        <span class="sub-item">Individual Farm</span>
                                    </a>
                                </li>
                                <li class="{{ $sm == 'animalCat' ? 'active' : '' }}">
                                    <a href="{{ route('animal-cat.index') }}">
                                        <span class="sub-item">Animal Category</span>
                                    </a>
                                </li>
                                <li class="{{ $sm == 'diseaseClinicalSign' ? 'active' : '' }}">
                                    <a href="{{ route('disease.index') }}">
                                        <span class="sub-item">Disease & Clinical Sign</span>
                                    </a>
                                </li>
                                {{-- <li class="{{$sm=='clinicalSign'?'active':''}}">
                                <a href="{{ route('clinical-sign.index') }}">
                                    <span class="sub-item">Clinical Sign</span>
                                </a>
                            </li> --}}
                            </ul>
                        </div>
                    </li>
                @endif

                <li
                    class="nav-item {{ activeNav([
                        'dead-culled.',
                        'deadCulled.*',
                        'animalInfo.*',
                        'animal-info.*',
                        'morphometric.*',
                        'body-weight.*',
                        'reproduction-record.*',
                        'milk-production.*',
                        'milk-composition.*',
                        'semen-analysis.*',
                        'service.*',
                        'distribution.*',
                        'dead-culled.*',
                    ]) }}">
                    <a data-toggle="collapse" href="#animal">
                        <i class="fas fa-info-circle"></i>
                        <p>Animal Record</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav([
                        'dead-culled.',
                        'deadCulled.*',
                        'animalInfo.*',
                        'animal-info.*',
                        'morphometric.*',
                        'body-weight.*',
                        'reproduction-record.*',
                        'milk-production.*',
                        'milk-composition.*',
                        'semen-analysis.*',
                        'service.*',
                        'distribution.*',
                        'dead-culled.*',
                    ]) }}"
                        id="animal">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-toggle="collapse" href="#animalInfo">
                                    <span class="sub-item">Animal Info.</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ openNav(['animalInfo.*', 'animal-info.*']) }}" id="animalInfo">
                                    <ul class="nav nav-collapse subnav">
                                        <li {{ activeSubNav(['animalInfo.index']) }}>
                                            <a href="{{ route('animalInfo.index') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                        <li {{ activeSubNav(['animal-info.*']) }}>
                                            <a href="{{ route('animal-info.create') }}">
                                                <span class="sub-item">Add</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            {{-- <li class="{{ activeSubNav(['animalInfo.*','animal-info.*']) }}">
                                <a href="{{ route('animalInfo.index') }}"><span class="sub-item">Animal
                                        Info.</span></a>
                            </li> --}}
                            <li class="{{ activeSubNav('morphometric.*') }}">
                                <a href="{{ route('morphometric.index') }}">
                                    <span class="sub-item">Morphometric</span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="collapse" href="#body-weight">
                                    <span class="sub-item">Calves Body Weight</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ openNav(['body-weight.*']) }}" id="body-weight">
                                    <ul class="nav nav-collapse subnav">
                                        <li {{ activeSubNav(['body-weight.index','body-weight.edit']) }}>
                                            <a href="{{ route('body-weight.index') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                        <li {{ activeSubNav(['body-weight.create']) }}>
                                            <a href="{{ route('body-weight.create') }}">
                                                <span class="sub-item">Add</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- <li class="{{ activeSubNav('body-weight.*') }}">
                                <a href="{{ route('body-weight.index') }}">
                                    <span class="sub-item">Calves Body Weight</span>
                                </a>
                            </li> --}}
                            <li class="{{ activeSubNav('reproduction-record.*') }}">
                                <a href="{{ route('reproduction-record.index') }}">
                                    <span class="sub-item">Reproduction</span>
                                </a>
                            </li>

                            <li>
                                <a data-toggle="collapse" href="#milk-production">
                                    <span class="sub-item">Milk Production</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ openNav(['milk-production.*']) }}" id="milk-production">
                                    <ul class="nav nav-collapse subnav">
                                        <li {{ activeSubNav(['milk-production.index','milk-production.edit']) }}>
                                            <a href="{{ route('milk-production.index') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                        <li {{ activeSubNav(['milk-production.create']) }}>
                                            <a href="{{ route('milk-production.create') }}">
                                                <span class="sub-item">Add</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- <li class="{{ activeSubNav('milk-production.*') }}">
                                <a href="{{ route('milk-production.index') }}">
                                    <span class="sub-item">Milk Production</span>
                                </a>
                            </li> --}}

                            <li>
                                <a data-toggle="collapse" href="#milk-composition">
                                    <span class="sub-item">Milk Compositions</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ openNav(['milk-composition.*']) }}" id="milk-composition">
                                    <ul class="nav nav-collapse subnav">
                                        <li {{ activeSubNav(['milk-composition.index','milk-composition.edit']) }}>
                                            <a href="{{ route('milk-composition.index') }}">
                                                <span class="sub-item">Manage</span>
                                            </a>
                                        </li>
                                        <li {{ activeSubNav(['milk-composition.create']) }}>
                                            <a href="{{ route('milk-composition.create') }}">
                                                <span class="sub-item">Add</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            {{-- <li class="{{ activeSubNav(['milk-composition.*']) }}">
                                <a href="{{ route('milk-composition.index') }}">
                                    <span class="sub-item">Milk Compositions</span>
                                </a>
                            </li> --}}
                            <li class="{{ activeSubNav('semen-analysis.*') }}">
                                <a href="{{ route('semen-analysis.index') }}">
                                    <span class="sub-item">Semen Analysis</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('service.*') }}">
                                <a href="{{ route('service.index') }}">
                                    <span class="sub-item">Service</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('distribution.*') }}">
                                <a href="{{ route('distribution.index') }}">
                                    <span class="sub-item">Distribution</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('dead-culled.*') }}">
                                <a href="{{ route('dead-culled.index') }}">
                                    <span class="sub-item">Culling</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li
                    class="nav-item {{ activeNav(['disease-and-treatment.*', 'vaccination.*', 'deworming.*', 'parasite.*']) }}">
                    <a data-toggle="collapse" href="#hm">
                        <i class="fas fa-heartbeat"></i>
                        <p>Health Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav(['disease-and-treatment.*', 'vaccination.*', 'deworming.*', 'parasite.*']) }}"
                        id="hm">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeSubNav('disease-and-treatment.*') }}">
                                <a href="{{ route('disease-and-treatment.index') }}">
                                    <span class="sub-item">Disease and Treatment</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('vaccination.*') }}">
                                <a href="{{ route('vaccination.index') }}">
                                    <span class="sub-item">Vaccination</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('deworming.*') }}">
                                <a href="{{ route('deworming.index') }}">
                                    <span class="sub-item">Deworming</span>
                                </a>
                            </li>
                            <li class="{{ activeSubNav('parasite.*') }}">
                                <a href="{{ route('parasite.index') }}">
                                    <span class="sub-item">Parasite</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li
                    class="nav-item {{ activeNav([
                        'report.animalInfo.*',
                        'report.morphometric.*',
                        'report.bodyWeight.*',
                        'report.reproduction.*',
                        'report.milkProduction.*',
                        'report.milkComposition.*',
                        'report.semenAnalysis.*',
                        'report.service.*',
                        'report.distribution.*',
                        'report.deadCulled.*',
                        'report.diseaseTreatment.*',
                        'report.vaccination.*',
                        'report.deworming.*',
                        'report.parasite.*',
                    ]) }}">
                    <a data-toggle="collapse" href="#report.animalInfo">
                        <i class="fa-solid fa-clipboard-list fa-lg"></i>
                        <p>Report</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ openNav([
                        'report.animalInfo.*',
                        'report.morphometric.*',
                        'report.bodyWeight.*',
                        'report.reproduction.*',
                        'report.milkProduction.*',
                        'report.milkComposition.*',
                        'report.semenAnalysis.*',
                        'report.service.*',
                        'report.distribution.*',
                        'report.deadCulled.*',
                        'report.diseaseTreatment.*',
                        'report.vaccination.*',
                        'report.deworming.*',
                        'report.parasite.*',
                    ]) }}"
                        id="report.animalInfo">
                        <ul class="nav nav-collapse">
                            <li class="{{ activeNav('report.animalInfo.*') }}">
                                <a href="{{ route('report.animalInfo.select') }}">
                                    <span class="sub-item">Animal Info</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.morphometric.*') }}">
                                <a href="{{ route('report.morphometric.select') }}">
                                    <span class="sub-item">Morphometric</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.bodyWeight.*') }}">
                                <a href="{{ route('report.bodyWeight.select') }}">
                                    <span class="sub-item">Calves Body Weight</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.reproduction.*') }}">
                                <a href="{{ route('report.reproduction.select') }}">
                                    <span class="sub-item">Reproduction</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.milkProduction.*') }}">
                                <a href="{{ route('report.milkProduction.select') }}">
                                    <span class="sub-item">Milk Production</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.milkComposition.*') }}">
                                <a href="{{ route('report.milkComposition.select') }}">
                                    <span class="sub-item">Milk Composition</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.semenAnalysis.*') }}">
                                <a href="{{ route('report.semenAnalysis.select') }}">
                                    <span class="sub-item">Semen Analysis</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.service.*') }}">
                                <a href="{{ route('report.service.select') }}">
                                    <span class="sub-item">Service</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.distribution.*') }}">
                                <a href="{{ route('report.distribution.select') }}">
                                    <span class="sub-item">Distribution</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.deadCulled.*') }}">
                                <a href="{{ route('report.deadCulled.select') }}">
                                    <span class="sub-item">Culling</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.diseaseTreatment.*') }}">
                                <a href="{{ route('report.diseaseTreatment.select') }}">
                                    <span class="sub-item">Disease Treatment</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.vaccination.*') }}">
                                <a href="{{ route('report.vaccination.select') }}">
                                    <span class="sub-item">Vaccination</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.deworming.*') }}">
                                <a href="{{ route('report.deworming.select') }}">
                                    <span class="sub-item">Deworming</span>
                                </a>
                            </li>
                            <li class="{{ activeNav('report.parasite.*') }}">
                                <a href="{{ route('report.parasite.select') }}">
                                    <span class="sub-item">Parasite</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- <li class="nav-item {{$p=='visitor'?'active':''}}">
                    <a class="dropdown-item" href="{{ route('VisitorInfo') }}" >
                        <i class="fas fa-user-secret"></i>
                        <p>Visitor Info</p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
