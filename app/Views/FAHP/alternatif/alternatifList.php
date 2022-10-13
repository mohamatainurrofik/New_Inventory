<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>


<div class="card">
    <h5 id="locationpath" class="d-none">/Fahp/alternatif</h5>
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                    </svg>
                </span>
                <input type="text" data-kt-alternatif-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search alternatif" />
            </div>
        </div>
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-alternatif-table-toolbar="base">
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_alternatif">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    Tambah alternatif
                </button>
            </div>
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-alternatif-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-alternatif-table-select="selected_count"></span>Selected
                </div>
                <button type="button" class="btn btn-danger" data-kt-alternatif-table-select="delete_selected">Delete Selected</button>
            </div>

            <div class="modal fade" id="kt_modal_edit_alternatif" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_edit_alternatif_header">
                            <h2 class="fw-bolder">Edit alternatif</h2>
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-alternatif-modal-action="close">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <form id="kt_modal_edit_alternatif_form" class="form" action="#">
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_alternatif_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_alternatif_header" data-kt-scroll-wrappers="#kt_modal_edit_alternatif_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Nama Alternatif</label>
                                        <input type="text" name="editalternatif_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama alternatif" />
                                        <input type="text" name="editalternatif_id" class="form-control form-control-solid mb-3 mb-lg-0 d-none" placeholder="Id alternatif" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Kode Alternatif</label>
                                        <input type="text" name="editalternatif_kode" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode alternatif" />
                                    </div>
                                </div>
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-alternatif-modal-action="cancel">Discard</button>
                                    <button type="submit" class="btn btn-primary" data-kt-alternatif-modal-action="submit">
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

            <div class="modal fade" id="kt_modal_add_alternatif" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header" id="kt_modal_add_alternatif_header">
                            <h2 class="fw-bolder">Tambah alternatif</h2>
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-alternatif-modal-action="close">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <form id="kt_modal_add_alternatif_form" class="form" action="#">
                                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_alternatif_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_alternatif_header" data-kt-scroll-wrappers="#kt_modal_add_alternatif_scroll" data-kt-scroll-offset="300px">
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Nama Alternatif</label>
                                        <input type="text" name="alternatif_name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama alternatif" />
                                    </div>
                                    <div class="fv-row mb-7">
                                        <label class="required fw-bold fs-6 mb-2">Kode Alternatif</label>
                                        <input type="text" name="alternatif_kode" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Kode alternatif" />
                                    </div>
                                </div>
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-alternatif-modal-action="cancel">Discard</button>
                                    <button type="submit" class="btn btn-primary" data-kt-alternatif-modal-action="submit">
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
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="alternatifTable">
            <!--begin::Table head-->
            <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#alternatifTable .aktif" value="1" />
                        </div>
                    </th>
                    <th class="min-w-125px">Kode</th>
                    <th class="min-w-125px">Alternatif</th>
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

<script src="<?= base_url('assets/js/custom/apps/fahp/alternatif/table.js') ?>"></script>
<script src="<?= base_url('assets/js/custom/apps/fahp/alternatif/add.js') ?>"></script>
<?= $this->endSection() ?>