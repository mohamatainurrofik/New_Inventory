<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>

<h5 id="locationpath" class="d-none">/Data/inventaris</h5>

<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->

        <!--end::Details-->
        <!--begin::Navs-->
        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-tabs nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#kt_inventaris_detail">Overview</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_inventaris_history">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_product_linked_view">Linked</a>
                </li>
            </ul>

        </div>
        <div class="card-toolbar">

        </div>
        <!--begin::Navs-->
    </div>
</div>

<div class="tab-content" id="myTabContent">
    <div role="tabpanel" class="card shadow mb-4 tab-pane fade show active" id="kt_inventaris_detail">
        <div class="card-header py-3">
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0 text-primary">Inventaris PT. BMC Logistics</h3>

            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-unitkerja-table-toolbar="base">

                    <a type="button" data-unique="edit" class="btn btn-primary align-self-center">Edit</a>
                    <div data-unique="tempDiv" class="card-title d-none">
                        <a type="button" data-unique="cancel" class="btn btn-danger align-self-center ">Cancel</a>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-unitkerja-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-unitkerja-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-unitkerja-table-select="delete_selected">Delete Selected</button>
                </div>

                <div class="modal fade" id="kt_modal_add_unitkerja" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_unitkerja_header">
                                <h2 class="fw-bolder">Tambah Unitkerja</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-unitkerja-modal-action="close">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <form id="kt_modal_add_unitkerja_form" class="form" action="#">
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_unitkerja_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_unitkerja_header" data-kt-scroll-wrappers="#kt_modal_add_unitkerja_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Nama Unitkerja</label>
                                            <input type="text" name="unitkerja_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Unitkerja" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Kode Unitkerja</label>
                                            <input type="text" name="unitkerja_kode" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="example => 'SOPS'" />
                                        </div>
                                        <div class="mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-5">Status Unitkerja</label>
                                            <div class="d-flex fv-row">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input me-3" name="unitkerja_status" type="radio" value="Aktif" id="kt_modal_update_role_option_0" checked='checked' />
                                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                        <div class="fw-bolder text-gray-800">Aktif</div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class='separator separator-dashed my-5'></div>
                                            <div class="d-flex fv-row">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input me-3" name="unitkerja_status" type="radio" value="Tidak Aktif" id="kt_modal_update_role_option_1" />
                                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                        <div class="fw-bolder text-gray-800">Tidak Aktif</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3" data-kt-unitkerja-modal-action="cancel">Discard</button>
                                        <button type="submit" class="btn btn-primary" data-kt-unitkerja-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row justifiy-content-center">
                <div class="col-md-2">
                    <img class="img-thumbnail" src="<?= base_url('assets/media/barcode') . '/' . $inventaris['id_detailunit'] . '.png' ?>" alt="" width="100%" height="100%">


                </div>
                <div class="col">
                    <div class="col">
                        <div class="d-flex justify-content-between">
                            <h5> <span class="badge badge-warning"><?= $inventaris['kategori'] ?></span></h5>
                            <?php
                            if ($inventaris['status_unit'] == 'Available') { ?>
                                <h5 class="text-uppercase"><span class="badge badge-success"><?= $inventaris['status_unit'] ?></span></h5>
                            <?php
                            } else {  ?>
                                <h5 class="text-uppercase"><span class="badge badge-danger"><?= $inventaris['status_unit'] ?></span></h5>
                            <?php }
                            ?>
                        </div>
                    </div>

                    <div data-unique="viewDetailInventaris" class="row mt-4">
                        <div class="col">
                            <div class="col">
                                <table class="table-striped table table-bordered">
                                    <tr>
                                        <th>Kode Unit</th>
                                        <td><strong><?= $inventaris['kode'] ?></strong></td>
                                        <th>Supplier</th>
                                        <td><?= $inventaris['supplier'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Unit</th>
                                        <td><?= $inventaris['nama_unit'] ?></td>
                                        <th>Brand</th>
                                        <td><?= $inventaris['brand'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Milik</th>
                                        <td>PT. BMC Logistics</td>
                                        <th>Harga</th>
                                        <td>Rp. <?= $inventaris['harga'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><?= $inventaris['status_unit'] ?></td>
                                        <th>Kondisi</th>
                                        <td><?= $inventaris['kondisi'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi Saat Ini</th>
                                        <td><?= $inventaris['ruangan'] ?></td>
                                        <th>Peruntukan</th>
                                        <td><?= $inventaris['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Perolehan</th>
                                        <td><?= $inventaris['tahun_perolehan'] ?></td>
                                        <th>Satuan</th>
                                        <td><?= $inventaris['satuan'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nota Dinas</th>
                                        <td><?= $inventaris['nota_dinas'] ?></td>
                                        <th>Invoice</th>
                                        <td><?= $inventaris['invoice'] ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div data-unique="editDetailInventaris" class="row mt-4 d-none">
                        <div class="col">
                            <div class="col">
                                <form id="edit_detailInventaris_form" class="form" action="#">
                                    <input type="hidden" name="id_inventaris" value="<?= $inventaris['id_detailunit'] ?>">
                                    <table class="table-striped table table-bordered">
                                        <tr>
                                            <th>Kode Unit</th>
                                            <td class="fv-row"><input readonly type="text" name="editInventarisKode" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="kode" value="<?= $inventaris['kode'] ?>" /></td>
                                            <th>Supplier</th>
                                            <td class="fv-row">
                                                <input type="text" class="d-none" id="editSupplierId" value="<?= $inventaris['id_supplier'] ?>">
                                                <select class="form-select form-select-transparent fw-bolder" id="editInventarisSupplier" name="editInventarisSupplier" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                    <option></option>
                                                    <?php foreach ($supplier as $key => $sup) { ?>
                                                        <option value="<?= $sup['id_supplier'] ?>"><?= $sup['supplier'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nama Unit</th>
                                            <td class="fv-row"><input type="text" readonly name="editInventarisName" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="nama" value="<?= $inventaris['nama_unit'] ?>" /></td>
                                            <th>Brand</th>
                                            <td class="fv-row"><input type="text" readonly name="editInventarisBrand" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="brand" value="<?= $inventaris['brand'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <th>Milik</th>
                                            <td class="fv-row"><input readonly type="text" name="editInventarisMilik" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="kode" value="PT. BMC Logistics" /></td>
                                            <th>Harga</th>
                                            <td class="fv-row"><input type="number" name="editInventarisHarga" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="harga" value="<?= $inventaris['harga'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td class="fv-row">
                                                <input type="text" class="d-none" id="editStatus" value="<?= $inventaris['status_unit'] ?>">
                                                <select class="form-select form-select-transparent fw-bolder" id="editInventarisStatus" name="editInventarisStatus" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                    <option></option>
                                                    <option value="Assign To Location">Assign To Location</option>
                                                    <option value="Assign To Employee">Assignt To Employee</option>
                                                    <option value="Available">Available</option>
                                                </select>
                                            </td>
                                            <th>Kondisi</th>
                                            <td class="fv-row">
                                                <input type="text" class="d-none" id="editKondisi" value="<?= $inventaris['kondisi'] ?>">
                                                <select class="form-select form-select-transparent fw-bolder" id="editInventarisKondisi" name="editInventarisKondisi" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                    <option></option>
                                                    <option value="Layak Pakai">Layak Pakai</option>
                                                    <option value="Kurang Layak Pakai">Kurang Layak Pakai</option>
                                                    <option value="Tidak Layak Pakai">Tidak Layak Pakai</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi Saat Ini</th>
                                            <td class="fv-row">
                                                <input type="text" class="d-none" id="editLokasi" value="<?= $inventaris['id_ruangan'] ?>">
                                                <select class="form-select form-select-transparent fw-bolder" id="editInventarisLokasi" name="editInventarisLokasi" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                    <option></option>
                                                    <?php foreach ($lokasi as $key => $lok) { ?>
                                                        <option value="<?= $lok['id'] ?>"><?= $lok['ruangan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <th>Peruntukan</th>
                                            <td class="fv-row">
                                                <input type="text" class="d-none" id="editKaryawan" value="<?= $inventaris['id_karyawan'] ?>">
                                                <select class="form-select form-select-transparent fw-bolder" id="editInventarisPeruntukan" name="editInventarisPeruntukan" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                    <option></option>
                                                    <?php foreach ($karyawan as $key => $kar) { ?>
                                                        <option value="<?= $kar['id_karyawan'] ?>"><?= $kar['nama'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Perolehan</th>
                                            <td class="fv-row"><input type="number" name="editInventarisTahun" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="tahun" value="<?= $inventaris['tahun_perolehan'] ?>" /></td>
                                            <th>Satuan</th>
                                            <td class="fv-row"><input type="text" readonly name="editInventarisSatuan" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="satuan" value="<?= $inventaris['satuan'] ?>" /></td>
                                        </tr>
                                        <tr>
                                            <th>Nota Dinas</th>
                                            <td class="fv-row"><input type="text" name="editInventarisNotadinas" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="brand" value="<?= $inventaris['nota_dinas'] ?>" /></td>
                                            <th>Invoice</th>
                                            <td class="fv-row"><input type="text" name="editInventarisInvoice" class="form-control form-control-transparent mb-3 mb-lg-0" placeholder="brand" value="<?= $inventaris['invoice'] ?>" /></td>
                                        </tr>
                                    </table>
                                    <div class="row mb-7">
                                        <button type="submit" class="btn btn-primary" data-unique="save">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_inventaris_history">
        <div class="card-header ">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <input type="text" data-kt-inventaris-history-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search History" />
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-product-history-table-toolbar="base">
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
                        <div class="px-7 py-5" data-kt-inventaris-history-table-filter="form">
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Tahun :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-product-history-table-filter="tahun" data-hide-search="true">
                                    <option></option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Bulan :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-product-history-table-filter="tahun" data-hide-search="true">
                                    <option></option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-inventaris-history-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-inventaris-history-table-filter="filter">Apply</button>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_history_product">
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


            </div>
        </div>
        <div data-unique="viewHistoryProduct" class="card-body p-9">
            <div class="row mb-10">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="inventarisHistoryTable">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Changed At</th>
                                <th class="min-w-100px">Deskripsi</th>
                                <th class="min-w-175px">Before</th>
                                <th class="min-w-175px">After</th>
                                <th class="min-w-50px">Change By</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url('assets/js/custom/apps/data/inventaris/detail.js') ?>"></script>
<?= $this->endSection() ?>