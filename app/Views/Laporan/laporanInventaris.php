<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>

<h5 id="locationpath" class="d-none">/Laporan/laporanInventaris</h5>



<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="text" data-kt-laporanInventaris-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Inventaris" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-laporanInventaris-table-toolbar="base">
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                        </svg>
                    </span>
                    Filter
                </button>
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5" data-kt-laporanInventaris-table-filter="form">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">Jenis :</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-laporanInventaris-table-filter="jenis" data-hide-search="true">
                                <option></option>
                                <option value="Habis Pakai">Habis Pakai</option>
                                <option value="Tidak Habis Pakai">Tidak Habis Pakai</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-laporanInventaris-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-laporanInventaris-table-filter="filter">Apply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="laporanInventarisTable">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Inventaris</th>
                    <th class="min-w-125px">Brand</th>
                    <th class="min-w-125px">Satuan</th>
                    <th class="min-w-125px">Jenis</th>
                    <th class="min-w-125px">Stok</th>
                    <th class="min-w-125px">Total Nilai</th>
                    <th class="min-w-125px">Aksi</th>
                </tr>
                <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->

            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
</div>







<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src=" <?= base_url('assets/js/custom/apps/laporan/inventaris/table.js') ?>"></script>
<?= $this->endSection() ?>