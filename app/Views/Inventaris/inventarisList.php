<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>

<h5 id="locationpath" class="d-none">/Data/Inventaris</h5>
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <!--begin: Pic-->
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">Data Inventaris</a>
                        </div>
                        <!--end::Name-->
                        <!--begin::Info-->

                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                    <!--begin::Actions-->

                    <!--end::Actions-->
                </div>
                <!--end::Title-->
                <!--begin::Stats-->

                <!--end::Stats-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        <!--begin::Navs-->
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#kt_inventarisList">Data Inventaris</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <?php if (has_permission('inventaris-create', user()->id)) { ?>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_addinventaris">Tambah Inventaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_mutasiinventaris">Mutasi Inventaris</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>

<div class="tab-content" id="myTabContent">

    <div role="tabpanel" class="tab-pane fade show active card mb-5 mb-xl-10" id="kt_inventarisList">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <input type="text" data-kt-inventaris-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search inventaris" />
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-inventaris-table-toolbar="base">
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
                        <div class="px-7 py-5" data-kt-inventaris-table-filter="form">
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Statu :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-inventaris-table-filter="status" data-hide-search="true">
                                    <option></option>
                                    <option value="Assign To Location">Assign To Location</option>
                                    <option value="Assign To Employee">Assign To Employee</option>
                                    <option value="Available">Available</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-inventaris-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-inventaris-table-filter="filter">Apply</button>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                            <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                            <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                        </svg>
                    </span>
                    Export
                </button> -->
                </div>
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-inventaris-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-inventaris-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-inventaris-table-select="delete_selected">Delete Selected</button>
                </div>
            </div>
        </div>


        <div class="card-body pt-0">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="inventarisTable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            #
                        </th>
                        <th class="min-w-125px">Kode Inventaris</th>
                        <th class="min-w-125px">Kategori</th>
                        <th class="min-w-125px">Inventaris</th>
                        <th class="min-w-100px">Brand</th>
                        <th class="min-w-75px">Satuan</th>
                        <th class="min-w-125px">Current Employee</th>
                        <th class="min-w-125px">Status</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->

                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_addinventaris">
        <div class="card-header border-0 pt-6">

            <header class="panel-heading">
                <form id="kt_add_inventaris_form" class="form" action="#">
                    <div class="d-flex fv-row row">
                        <div class="col-md-10 pl-0">
                            <label class="required form-label fs-6 fw-bold">Product :</label>
                            <select data-ajax--cache="true" name="inventaris_product" id="inventaris_product" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                            </select>
                            <input style="display: none;" type="text" name="inventaris_createdby" value="<?= user()->username ?>">
                            <input style="display: none;" type="text" name="namaitemaddmess" id="namaitemaddmess">
                            <input style="display: none;" type="text" name="kodeproductaddmess" id="kodeproductaddmess">
                            <input style="display: none;" type="text" name="kodesubproductaddmess" id="kodesubproductaddmess">
                        </div>
                        <div class="col-md-2 pl-0">
                            <label class="required fw-bold fs-6 mb-2">Status</label>
                            <select name="inventaris_status" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                                <option value="Assign To Location">Assign To Location</option>
                                <option value="Assign To Employee">Assign To Employee</option>
                                <option value="Available">Available</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex fv-row row mb-2">
                            <div class="col-md-5 pl-0">
                                <label class="required fw-bold fs-6 mb-2">No Nota Dinas</label>
                                <input type="text" name="inventaris_notadinas" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="No Nota Dinas" />
                                Format Nota Dinas :
                                <a role="button" data-id="ND. 00XX/DEP.BMC/XXX - 20XX" class="notadinascopy btn btn-sm btn-outline-info">ND. 00XX/DEP.BMC/XXX - 20XX</a>
                            </div>
                            <div class="col-md-4 pl-0">
                                <label class="required fw-bold fs-6 mb-2">No Invoice</label>
                                <input type="text" name="inventaris_invoice" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="No Invoice" />
                                Format Invoice :
                                <a role="button" data-id="INV/20YYMMDD/MPL/XXXXXX" class="notadinascopy btn btn-sm btn-outline-info">INV/20YYMMDD/MPL/XXXXXX</a>
                            </div>
                            <div class="col-md-3 pl-0">
                                <label class="form-label fs-6 fw-bold">Karyawan :</label>
                                <select name="inventaris_karyawan" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                    <option></option>
                                    <?php foreach ($karyawan as $key => $kar) { ?>
                                        <option value="<?= $kar['id_karyawan'] ?>"><?= $kar['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex fv-row row">

                            <div class="col-md-2 pl-0">
                                <label class="required fw-bold fs-6 mb-2">Harga Satuan</label>
                                <input type="text" name="inventaris_harga" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Harga" />
                            </div>
                            <div class="col-md-1 pl-0">
                                <label class="required fw-bold fs-6 mb-2">Jumlah</label>
                                <input type="number" name="inventaris_jumlah" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Qty" />
                            </div>
                            <div class="col-md-2 pl-0">
                                <label class="required form-label fs-6 fw-bold">Kondisi :</label>
                                <select name="inventaris_kondisi" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                    <option></option>
                                    <option value="Layak Pakai">Layak Pakai</option>
                                    <option value="Kurang Layak Pakai">Kurang Layak Pakai</option>
                                    <option value="Tidak Layak Pakai">Tidak Layak Pakai</option>
                                </select>
                            </div>
                            <div class="col-md-2 pl-0">
                                <label class="required fw-bold fs-6 mb-2">Tahun</label>
                                <input type="number" name="inventaris_tahun" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Tahun" />
                            </div>
                            <div class="col-md-2 pl-0">
                                <label class="required form-label fs-6 fw-bold">Supplier :</label>
                                <select name="inventaris_supplier" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                    <option></option>
                                    <?php foreach ($supplier as $key => $sup) { ?>
                                        <option value="<?= $sup['id_supplier'] ?>"><?= $sup['supplier'] ?></option>
                                    <?php } ?>
                                </select>
                                <input style="display: none;" type="text" name="namasupplier" id="namasupplier">
                            </div>
                            <div class="col-md-3 pl-0 lokasipenempatan">
                                <label class="required form-label fs-6 fw-bold">Lokasi Penempatan :</label>
                                <select name="inventaris_lokasi" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                    <option></option>
                                    <?php foreach ($lokasi as $key => $lok) { ?>
                                        <option value="<?= $lok['id'] ?>"> <strong><?= $lok['ruangan'] ?></strong> => <?= $lok['unitkerja'] ?></option>
                                    <?php } ?>
                                </select>
                                <input style="display: none;" type="text" name="namalokasipenempatan" id="namalokasipenempatan">
                                <input style="display: none;" type="text" name="kodelokasiunitkerja" id="kodelokasiunitkerja">
                                <input style="display: none;" type="text" name="kodelokasiruangan" id="kodelokasiruangan">
                            </div>
                            <input style="display: none;" type="number" value="" name="urutan" id="urutan">

                        </div>
                    </div>
                    <div class="d-flex mt-3 row justify-content-between">
                        <div class="col-md-8 pl-0">
                            <button class="btn btn-primary" data-kt-inventaris-add-action="addtable">Tambah Ke table</button>
                            <button class="btn btn-danger" data-kt-inventaris-reset-action="resetable">Reset</button>
                        </div>
                        <div class="col-md-4 pr-0">
                            <button class="btn btn-success" data-kt-inventaris-database-action="adddatabase">Tambah Ke Database</button>
                        </div>
                    </div>
                </form>


            </header>
        </div>
        <div class="card-body">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="addInventarisTable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                        <th class="min-w-125px">Nama</th>
                        <th class="min-w-125px">Qty</th>
                        <th class="min-w-125px">Kondisi</th>
                        <th class="min-w-125px">Tahun</th>
                        <th class="min-w-125px">Supplier</th>
                        <th class="min-w-125px">Peruntukan</th>
                        <th class="min-w-125px">Lokasi</th>
                        <th class="min-w-125px">Harga</th>
                        <th class="min-w-125px">Sub Total</th>


                    </tr>
                    <!--end::Table row-->
                </thead>
                <tbody>

                </tbody>
                <!--end::Table head-->
                <!--begin::Table body-->

                <!--end::Table body-->
            </table>
        </div>

    </div>

    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_mutasiinventaris">
        <div class="card-body border-0 pt-6">
            <form id="kt_add_mutasiinventaris_form" class="form" action="#">
                <div class="d-flex fv-row row">
                    <div class="col-md-12 pl-0">
                        <label class="required form-label fs-6 fw-bold">Lokasi Inventaris :</label>
                        <select name="mutasiinventaris_awal" id="mutasiinventaris_awal" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option></option>
                            <?php foreach ($lokasi as $key => $loka) { ?>
                                <option value="<?= $loka['id'] ?>"> <strong><?= $loka['ruangan'] ?></strong> => <?= $loka['unitkerja'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div data-unique="afterSelectLokasi" class="d-none">
                    <div class="d-flex fv-row row">
                        <div class="col-md-12 pl-0">
                            <label class="required form-label fs-6 fw-bold">Inventaris :</label>
                            <select data-ajax--cache="true" name="mutasiinventaris_product" id="mutasiinventaris_product" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                            </select>
                            <input style="display: none;" type="text" name="mutasiinventaris_createdby" value="<?= user()->username ?>">
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="d-flex fv-row row mb-2">
                            <div class="col-md-4 pl-0">
                                <label class="form-label fs-6 fw-bold">Karyawan :</label>
                                <select name="mutasiinventaris_karyawan" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                    <option></option>
                                    <?php foreach ($karyawan as $key => $kar1) { ?>
                                        <option value="<?= $kar1['id_karyawan'] ?>"><?= $kar1['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6 pl-0 lokasipenempatan">
                                <label class="required form-label fs-6 fw-bold">Lokasi Penempatan :</label>
                                <select name="mutasiinventaris_lokasi" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                    <option></option>
                                    <?php foreach ($lokasi as $key => $lok1) { ?>
                                        <option value="<?= $lok1['id'] ?>"> <strong><?= $lok1['ruangan'] ?></strong> => <?= $lok1['unitkerja'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input style="display: none;" type="number" value="" name="urutan" id="urutan">
                            <div class="col-md-2 pl-0">
                                <label class="required fw-bold fs-6 mb-2">Status</label>
                                <select name="mutasiinventaris_status" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                    <option></option>
                                    <option value="Assign To Location">Assign To Location</option>
                                    <option value="Assign To Employee">Assign To Employee</option>
                                    <option value="Available">Available</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex fv-row row mt-2">
                        <label class="required fw-bold fs-6 mb-2">Deskripsi Mutasi</label>
                        <textarea placeholder="Deskripsi Mutasi" name="mutasiinventaris_deskripsi" class="form-control form-control-solid" id="mutasiinventaris_deskripsi" cols="30" rows="1"></textarea>
                    </div>
                    <div class="d-flex mt-3 row justify-content-between">
                        <div class="col-md-8 pl-0">
                            <button class="btn btn-primary" data-kt-mutasiinventaris-add-action="addtable">Tambah Ke table</button>
                            <button class="btn btn-danger" data-kt-mutasiinventaris-reset-action="resetable">Reset</button>
                        </div>
                        <div class="col-md-4 pr-0">
                            <button class="btn btn-success" data-kt-mutasiinventaris-database-action="adddatabase">Proses</button>
                        </div>
                    </div>
                </div>

            </form>
            <br>
            <div class="row">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="addMutasiInventarisTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">

                            <th class="min-w-125px">Kode</th>
                            <th class="min-w-125px">Inventaris</th>
                            <th class="min-w-125px">Lokasi Mutasi</th>
                            <th class="min-w-125px">Peruntukan</th>


                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <tbody>

                    </tbody>
                    <!--end::Table head-->
                    <!--begin::Table body-->

                    <!--end::Table body-->
                </table>
            </div>
        </div>

    </div>



</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="<?= base_url('assets/js/custom/apps/data/inventaris/table.js') ?>"></script>
<script src="<?= base_url('assets/js/custom/apps/data/inventaris/add.js') ?>"></script>
<script src="<?= base_url('assets/js/custom/apps/data/inventaris/mutasi.js') ?>"></script>
<?= $this->endSection() ?>