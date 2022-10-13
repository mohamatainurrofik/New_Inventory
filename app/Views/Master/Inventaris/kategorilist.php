<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>

<h5 id="locationpath" class="d-none">/Inventaris/kategori</h5>
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
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">Kategori & Sub Kategori Inventaris</a>
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
                    <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#kt_kategori_view">Kategori</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_subKategori_view">Sub Kategori</a>
                </li>
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>

<div class="tab-content" id="myTabContent">
    <div role="tabpanel" class="tab-pane fade show active card mb-5 mb-xl-10" id="kt_kategori_view">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <input type="text" data-kt-kategori-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search kategori" />
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-kategori-table-toolbar="base">
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_kategori">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        Tambah kategori
                    </button>
                </div>
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-kategori-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-kategori-table-select="selected_count"></span>Terpilih
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-kategori-table-select="delete_selected">Hapus Terpilih</button>
                </div>

                <div class="modal fade" id="kt_modal_add_kategori" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_kategori_header">
                                <h2 class="fw-bolder">Tambah kategori</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-kategori-modal-action="close">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <form id="kt_modal_add_kategori_form" class="form" action="#">
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_kategori_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_kategori_header" data-kt-scroll-wrappers="#kt_modal_add_kategori_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Kode kategori</label>
                                            <input type="text" name="kategori_kode" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode kategori" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Nama kategori</label>
                                            <input type="text" name="kategori_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama kategori" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class=" fw-bold fs-6 mb-2">Deskripsi kategori</label>
                                            <textarea class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi Kategori" name="kategori_deskripsi" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3" data-kt-kategori-modal-action="cancel">Batal</button>
                                        <button type="submit" class="btn btn-primary" data-kt-kategori-modal-action="submit">
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kategoriTable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kategoriTable .aktif" value="1" />
                            </div>
                        </th>
                        <th class="min-w-125px">Kode</th>
                        <th class="min-w-125px">Kategori</th>
                        <th class="min-w-125px">Deskripsi</th>
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


    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_subKategori_view">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                        </svg>
                    </span>
                    <input type="text" data-kt-subkategori-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search subkategori" />
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-subkategori-table-toolbar="base">
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
                        <div class="px-7 py-5" data-kt-subkategori-table-filter="form">
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Jenis :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-subkategori-table-filter="jenis" data-hide-search="true">
                                    <option></option>
                                    <option value="UMUM">UMUM</option>
                                    <option value="IT">IT</option>
                                </select>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Kategori :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-subkategori-table-filter="kategori" data-hide-search="true">
                                    <option></option>
                                    <?php foreach ($allKategori as $key => $kateg) { ?>
                                        <option value="<?= $kateg['content_product'] ?>"><?= $kateg['content_product'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-subkategori-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-subkategori-table-filter="filter">Apply</button>
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_subkategori">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                            </svg>
                        </span>
                        Tambah subkategori
                    </button>
                </div>
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-subkategori-table-toolbar="selected">
                    <div class="fw-bolder me-5">
                        <span class="me-2" data-kt-subkategori-table-select="selected_count"></span>Terpilih
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-subkategori-table-select="delete_selected">Hapus Terpilih</button>
                </div>

                <div class="modal fade" id="kt_modal_add_subkategori" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered mw-650px">
                        <div class="modal-content">
                            <div class="modal-header" id="kt_modal_add_subkategori_header">
                                <h2 class="fw-bolder">Tambah subkategori</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-subkategori-modal-action="close">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                <form id="kt_modal_add_subkategori_form" class="form" action="#">
                                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_subkategori_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_subkategori_header" data-kt-scroll-wrappers="#kt_modal_add_subkategori_scroll" data-kt-scroll-offset="300px">
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Kategori</label>
                                            <select class="form-select form-select-solid fw-bolder mb-3 mb-lg-0" id="subkategori_kategori" name="subkategori_kategori" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <?php foreach ($allKategori as $key => $gori) { ?>
                                                    <option value="<?= $gori['id_product'] ?>"><?= $gori['content_product'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Kode subkategori</label>
                                            <input type="number" name="subkategori_kode" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode subkategori" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Nama subkategori</label>
                                            <input type="text" name="subkategori_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama subkategori" />
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class="required fw-bold fs-6 mb-2">Jenis subkategori</label>
                                            <select class="form-select form-select-solid fw-bolder mb-3 mb-lg-0" id="subkategori_jenis" name="subkategori_jenis" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="UMUM">UMUM</option>
                                                <option value="IT">IT</option>
                                            </select>
                                        </div>
                                        <div class="fv-row mb-7">
                                            <label class=" fw-bold fs-6 mb-2">Deskripsi subkategori</label>
                                            <textarea class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Deskripsi Kategori" name="subkategori_deskripsi" id="" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-center pt-15">
                                        <button type="reset" class="btn btn-light me-3" data-kt-subkategori-modal-action="cancel">Batal</button>
                                        <button type="submit" class="btn btn-primary" data-kt-subkategori-modal-action="submit">
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="subkategoriTable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#subkategoriTable .aktif" value="1" />
                            </div>
                        </th>
                        <th class="min-w-125px">Kode</th>
                        <th class="min-w-125px">Sub Kategori</th>
                        <th class="min-w-125px">Kategori</th>
                        <th class="min-w-125px">Jenis</th>
                        <th class="min-w-125px">Deskripsi</th>
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
</div>







<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script src="<?= base_url('assets/js/custom/apps/inventaris/kategori/table.js') ?>"></script>
<script src="<?= base_url('assets/js/custom/apps/inventaris/kategori/add.js') ?>"></script>
<?= $this->endSection() ?>