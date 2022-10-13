<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>

<h5 id="locationpath" class="d-none">/Form/pengajuan</h5>
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
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">Form Pengajuan</a>
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
                    <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#kt_pengajuanHabisPakai">Habis Pakai</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_pengajuanTidakHabisPakai">Tidak Habis Pakai</a>
                </li>
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>

<div class="tab-content" id="myTabContent">

    <div role="tabpanel" class="tab-pane fade show active card mb-5 mb-xl-10" id="kt_pengajuanHabisPakai">
        <div class="card-body">
            <form id="kt_add_pengajuanHabisPakai_form" class="form" action="#">
                <input type="text" class="d-none" name="inventaris_lokasi" id="lokasimengajukan" value="<?= $lokasi['id_unitkerja'] ?>">
                <input type="text" class="d-none" name="inventaris_lokasitext" id="lokasimengajukantext" value="<?= $lokasi['unitkerja'] ?>">
                <div class="d-flex fv-row row">
                    <div class="col-md-2 pl-0">
                        <label class="required form-label fs-6 fw-bold">Jenis Unit :</label>
                        <select name="inventaris_jenisunit1" id="inventaris_jenisunit1" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option></option>
                            <option value="Umum">Umum</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>
                    <div class="col-md-6 pl-0">
                        <label class="required form-label fs-6 fw-bold">Pilih Unit :</label>
                        <select data-ajax--cache="true" name="inventaris_unit1" id="inventaris_unit1" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option></option>
                        </select>
                        <input style="display: none;" type="text" name="inventaris_createdby" value="<?= user()->username ?>">
                    </div>
                    <div class="col-md-2 pl-0">
                        <label class="required fw-bold fs-6 mb-2">Stok ajuan</label>
                        <input type="number" name="inventaris_stokdigunakan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Stok Inventaris Yang diinginkan" />
                    </div>
                </div>
                <div class="d-flex mt-3 fv-row row">
                    <div class="col-md-4 pl-0">
                        <label class="required fw-bold fs-6 mb-2">Stok</label>
                        <input type="number" readonly name="inventaris_stok" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Stok Inventaris di Gudang" />
                    </div>
                    <div class="col-md-4 pl-0">
                        <label class="required fw-bold fs-6 mb-2">Satuan</label>
                        <input type="text" readonly name="inventaris_satuan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Satuan Inventaris" />
                    </div>
                </div>
                <div class="d-flex mt-3 fv-row row">
                    <div class="col-md-6 pl-0">
                        <label class="required fw-bold fs-6 mb-2">Peruntukan</label>
                        <select data-ajax--cache="true" name="inventaris_peruntukan" id="inventaris_peruntukan" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option></option>
                            <?php foreach ($peruntukan as $key => $karyawan) { ?>
                                <option value="<?= $karyawan['id_karyawan'] ?>"><?= $karyawan['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="d-flex mt-3 row justify-content-between">
                    <div class="col-md-8 pl-0">
                        <button class="btn btn-primary" data-kt-formhabispakai-add-action="addtable">Tambah Ke table</button>
                        <button class="btn btn-danger" data-kt-formhabispakai-reset-action="resetable">Reset</button>
                    </div>
                    <div class="col-md-4 pr-0">
                        <button class="btn btn-success" data-kt-formhabispakai-database-action="adddatabase">Tambah Ke Database</button>
                    </div>
                </div>
                <br>
                <div class="fv-row">
                    <label class="required fw-bold fs-6 mb-2">Deskripsi Pengajuan</label>
                    <textarea name="inventaris_deskripsi" id="inventaris_deskripsi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi Pengajuan" cols="30" rows="2"></textarea>
                </div>
                <br>
                <hr>
                <br>
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="addInventarisPengajuanHabisPakaiTable">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Kode</th>
                            <th class="min-w-125px">Inventaris</th>
                            <th class="min-w-125px">Sisa Stok</th>
                            <th class="min-w-125px">Permintaan Stok</th>
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


            </form>

        </div>
        <!--end::Card body-->
    </div>

    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_pengajuanTidakHabisPakai">
        <div class="card-body">
            <form id="kt_add_pengajuanTidakHabisPakai_form" class="form" action="#">
                <div class="d-flex fv-row row">

                    <div class="col-md-2 pl-0">
                        <label class="required form-label fs-6 fw-bold">Jenis Unit :</label>
                        <select name="inventaris_jenisunit" id="inventaris_jenisunit" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option></option>
                            <option value="Umum">Umum</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>
                    <div class="col-md-5 pl-0">
                        <label class="required form-label fs-6 fw-bold">Pilih Unit :</label>
                        <select name="inventaris_unit" id="inventaris_unit" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option></option>
                        </select>
                        <input style="display: none;" type="text" name="inventaris_createdby" value="<?= user()->username ?>">
                    </div>
                    <div class="col-md-2 pl-0">
                        <label class="required fw-bold fs-6 mb-2">Stok</label>
                        <input type="text" readonly name="inventaris_stok1" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Stok Inventaris di Gudang" />
                    </div>
                    <div class="col-md-2 pl-0">
                        <label class="required fw-bold fs-6 mb-2">Satuan</label>
                        <input type="text" readonly name="inventaris_satuan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Satuan Inventaris" />
                    </div>
                </div>
                <div class="d-flex mt-3 fv-row row">
                    <div class="col-md-6 pl-0">
                        <label class="required fw-bold fs-6 mb-2">Peruntukan</label>
                        <select data-ajax--cache="true" name="inventaris_peruntukan1" id="inventaris_peruntukan1" class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                            <option></option>
                            <?php foreach ($peruntukan as $key => $kar) { ?>
                                <option value="<?= $kar['id_karyawan'] ?>"><?= $kar['nama'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="d-flex mt-3 row justify-content-between">
                    <div class="col-md-8 pl-0">
                        <button class="btn btn-primary" data-kt-formtidakhabispakai-add-action="addtable">Tambah Ke table</button>
                        <button class="btn btn-danger" data-kt-formtidakhabispakai-reset-action="resetable">Reset</button>
                    </div>
                    <div class="col-md-4 pr-0">
                        <button class="btn btn-success" data-kt-formtidakhabispakai-database-action="adddatabase">Tambah Ke Database</button>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="addInventarisPengajuanTidakHabisPakaiTable">
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
                <br>
                <div class="fv-row">
                    <label class="required fw-bold fs-6 mb-2">Deskripsi Pengajuan</label>
                    <textarea name="inventaris_deskripsi" id="inventaris_deskripsi" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi Pengajuan" cols="30" rows="2"></textarea>
                </div>


            </form>

        </div>
    </div>

</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="<?= base_url('assets/js/custom/apps/form/add.js') ?>"></script>
<?= $this->endSection() ?>