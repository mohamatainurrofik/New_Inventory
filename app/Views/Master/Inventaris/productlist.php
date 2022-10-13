<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>


<div class="card">
    <h5 id="locationpath" class="d-none">/Inventaris/product</h5>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="text" data-kt-product-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search product" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-product-table-toolbar="base">
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
                    <div class="px-7 py-5" data-kt-product-table-filter="form">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">Jenis :</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-product-table-filter="jenis" data-hide-search="true">
                                <option></option>
                                <option value="Habis Pakai">Habis Pakai</option>
                                <option value="Tidak Habis Pakai">Tidak Habis Pakai</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-product-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-product-table-filter="filter">Apply</button>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_product">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    Tambah product
                </button>
            </div>
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-product-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-product-table-select="selected_count"></span>Terpiilih
                </div>
                <button type="button" class="btn btn-danger" data-kt-product-table-select="delete_selected">Hapus Terpilih</button>
            </div>

            <div class="modal fade" id="kt_modal_add_product" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_product_header">
                            <h2 class="fw-bolder">Tambah product</h2>
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-product-modal-action="close">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <form id="kt_modal_add_product_form" class="form" action="#">
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_product_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_product_header" data-kt-scroll-wrappers="#kt_modal_add_product_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Sub Kategori: </label>
                                        <select class="form-select form-select-solid fw-bolder" id="product_subkategori" name="product_subkategori" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-product-table-filter="subkategori" data-hide-search="true">
                                            <option></option>
                                            <?php foreach ($allKategori as $key => $kateg) { ?>
                                                <option value="<?= $kateg['id_product'] ?>"><?= $kateg['content_product'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Nama product</label>
                                        <input type="text" name="product_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama product" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Brand</label>
                                        <input type="text" name="product_brand" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Brand product" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Satuan</label>
                                        <input type="text" name="product_satuan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Satuan product" />
                                    </div>
                                    <div class="mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-5">Jenis product</label>
                                        <div class="d-flex fv-row">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" name="product_jenis" type="radio" value="Habis Pakai" id="kt_modal_update_jenisoption_0" checked='checked' />
                                                <label class="form-check-label" for="kt_modal_update_role_option_0">
                                                    <div class="fw-bolder text-gray-800">Habis Pakai</div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class='separator separator-dashed my-5'></div>
                                        <div class="d-flex fv-row">
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input class="form-check-input me-3" name="product_jenis" type="radio" value="Tidak Habis Pakai" id="kt_modal_update_jenis_option_1" />
                                                <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                    <div class="fw-bolder text-gray-800">Tidak Habis Pakai</div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-product-modal-action="cancel">Batal</button>
                                    <button type="submit" class="btn btn-primary" data-kt-product-modal-action="submit">
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


    <div class="card-body pt-0">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="productTable">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#productTable .aktif" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">Product</th>
                    <th class="min-w-125px">Brand</th>
                    <th class="min-w-125px">Satuan</th>
                    <th class="min-w-125px">Jenis</th>
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
    <!--end::Card body-->
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="<?= base_url('assets/js/custom/apps/inventaris/master/table.js') ?>"></script>
<script src="<?= base_url('assets/js/custom/apps/inventaris/master/add.js') ?>"></script>
<?= $this->endSection() ?>