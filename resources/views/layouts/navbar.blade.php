        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
              <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <img src="{{ asset('logo-yayasan.png') }}" style="max-width: 60px" alt="">
                </span>
                <span class="demo menu-text fw-bolder ms-2 mt-3" style="font-size: 17px">
                  <span class="fw-bolder">SIMKU-YTPSM</span>
                  <p class="text-muted" style="font-size: 9px">Sistem Informasi Manajemen Keuangan Yayasan pendidikan surau minang</p>
                </span>
              </a>
  
              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
            </div>
  
            <div class="menu-inner-shadow"></div>
  
            <ul class="menu-inner py-1">
              <!-- Dashboard -->
              <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-home"></i>
                  <div data-i18n="Analytics">Dashboard</div>
                </a>
              </li>
              @if (Auth::user()->role == 'ADMIN')
              <li class="menu-item {{ Route::is('user*') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                  <div data-i18n="Analytics">Accounts</div>
                </a>
              </li>
              <li class="menu-item {{ Route::is('parent*') ? 'active' : '' }}">
                <a href="{{ route('parent.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-user"></i>
                  <div data-i18n="Analytics">Wali Murid</div>
                </a>
              </li>
              <li class="menu-item {{ Route::is('student*') ? 'active' : '' }}">
                <a href="{{ route('student.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-user-circle"></i>
                  <div data-i18n="Analytics">Siswa</div>
                </a>
              </li>
              <li class="menu-item {{ Route::is(['spp.index', 'spp.edit']) ? 'active' : '' }}">
                <a href="{{ route('spp.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-wallet"></i>
                  <div data-i18n="Analytics">Spp</div>
                </a>
              </li>
              <li class="menu-item {{ Route::is(['payments*']) ? 'active' : '' }}">
                <a href="{{ route('payments.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-wallet"></i>
                  <div data-i18n="Analytics">Uang Pangkal / Daftar</div>
                </a>
              </li>
              @endif
              <li class="menu-item {{ Route::is('transaction*') ? 'active' : '' }}">
                <a href="{{ route('transaction.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-bank"></i>
                  <div data-i18n="Analytics">Transactions</div>
                </a>
              </li>
              @if (Auth::user()->role == 'ADMIN')
              @php
                  $open = Route::is('grade*') || Route::is('ta*') || Route::is('spp/student*') || Route::is('fees*') || Route::is('report*') ? 'open' : '';
              @endphp
              <li class="menu-item {{ $open }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div>Pengaturan</div>
                </a>
                <ul class="menu-sub">
                        <li class="menu-item {{ Route::is('grade*') ? 'active' : '' }}">
                          <a href="{{ route('grade.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Rombel Siswa</div>
                          </a>
                        </li>
                        <li class="menu-item {{ Route::is('teacher*') ? 'active' : '' }}">
                          <a href="{{ route('teacher.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Guru</div>
                          </a>
                        </li>
                        <li class="menu-item {{ Route::is('ta*') ? 'active' : '' }}">
                          <a href="{{ route('ta.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Tahun Ajaran</div>
                          </a>
                        </li>
                        <li class="menu-item {{ Route::is(['spp/student.index', 'spp/student.edit']) ? 'active' : '' }}">
                          <a href="{{ route('spp/student.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Master Nominal</div>
                          </a>
                        </li>
                        <li class="menu-item {{ Route::is('fees*') ? 'active' : '' }}">
                          <a href="{{ route('fees.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Master Keuangan</div>
                          </a>
                        </li>
                        <li class="menu-item {{ Route::is('report*') ? 'active' : '' }}">
                          <a href="{{ route('report.index') }}" class="menu-link">
                            <div data-i18n="Analytics">Report</div>
                          </a>
                        </li>
                        <li class="menu-item {{ Route::is('report.keuangan') ? 'active' : '' }}">
                          <a href="{{ route('report.keuangan') }}" class="menu-link" target="_blank">
                            <div data-i18n="Analytics">Report Keuangan</div>
                          </a>
                        </li>
                </ul>
              </li>
              @endif
            </ul>
          </aside>
          <!-- / Menu -->