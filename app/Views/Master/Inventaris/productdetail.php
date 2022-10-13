<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>


<!--begin::Navbar-->
<h5 id="locationpath" class="d-none">/Inventaris/product</h5>

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
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"><?= $product['nama_unit'] ?></a>
                            <a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"><?= $product['kategori'] ?></a>
                        </div>
                        <!--end::Name-->
                        <!--begin::Info-->
                        <!--end::Info-->
                    </div>
                    <div class="d-flex my-4">
                        <a type="button" class="btn btn-sm btn-light me-2" id="" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr012.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500  top-50 translate-middle-y ms-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Indicator-->
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bolder">Search Options</div>
                            </div>
                            <div class="separator border-gray-200"></div>
                            <div class="px-7 py-5" data-kt-product-detail-filter="form">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Product :</label>
                                    <select class="form-select form-select-solid fw-bolder" id="selectproduct" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-product-detail-filter="productname" data-hide-search="true">
                                        <option></option>
                                        <?php foreach ($allProduct as $key => $duck) { ?>
                                            <option value="<?= $duck['id_unit'] ?>"><?= $duck['nama_unit'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-product-detail-filter="filter">Apply</button>
                                </div>
                            </div>
                        </div>
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
                    <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#kt_product_details_view">Overview</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_product_history_view">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_product_linked_view">Linked</a>
                </li>
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->
<!--begin::details View-->
<div class="tab-content" id="myTabContent">
    <div role="tabpanel" class="tab-pane fade show active card mb-5 mb-xl-10" id="kt_product_details_view">
        <!--begin::Card header-->
        <div class="card-header  ">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Detail Product</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <a type="button" data-unique="edit" class="btn btn-primary align-self-center">Ubah Product</a>
            <div data-unique="tempDiv" class="card-title d-none">
                <a type="button" data-unique="cancel" class="btn btn-danger align-self-center ">Batal</a>
            </div>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div data-unique="viewProduct" class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Nama Product</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8" data-unique="productName">
                    <span class="fw-bolder fs-6 text-gray-800"><?= $product['nama_unit'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Nama Kategori</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8" data-unique="productName">
                    <span class="fw-bolder fs-6 text-gray-800"><?= $product['kategori'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Brand</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row" data-unique="productKode">
                    <span class="fw-bold text-gray-800 fs-6"><?= $product['brand'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">Satuan</label>
                <div class="col-lg-8 d-flex align-items-center" data-unique="productStatus">
                    <span class="fw-bold text-gray-800 fs-6"><?= $product['satuan'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">Jenis</label>
                <div class="col-lg-8 d-flex align-items-center" data-unique="productStatus">
                    <span class="fw-bold text-gray-800 fs-6"><?= $product['jenis_unit'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Created At</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?= $product['created_at'] ?></a>
                </div>
                <!--end::Col-->
            </div>


        </div>
        <div data-unique="editProduct" class="card-body p-9 d-none">
            <form id="edit_product_form" class="form" action="#">
                <input type="hidden" name="id_product" value="<?= $product['id_unit'] ?>">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted required">Nama Product</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="editProductName" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nama Product" value="<?= $product['nama_unit'] ?>" />
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted required">Brand</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="editProductBrand" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Brand Product" value="<?= $product['brand'] ?>" />
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted required">Satuan</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="editProductSatuan" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Satuan Product" value="<?= $product['satuan'] ?>" />
                    </div>
                </div>
                <div class="row mb-7">
                    <button type="mit" class="btn btn-primary" data-unique="save">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_product_history_view">
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
                    <input type="text" data-kt-product-history-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search History" />
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
                        <div class="px-7 py-5" data-kt-product-history-table-filter="form">
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
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-product-history-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-product-history-table-filter="filter">Apply</button>
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
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="productHistoryTable">
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
    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_product_linked_view">
        <div class="card-header ">
            <div class="card-title">
                <h3 id="linked-product-title" class="fw-bolder m-0">Inventaris Terhubung</h3>
            </div>
        </div>
        <div class="card-body">
            <div data-unique="productInventarisTable">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="productInventarisTable">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Inventaris Id</th>
                            <th class="min-w-125px">Kategori</th>
                            <th class="min-w-125px">Deskripsi</th>
                            <th class="min-w-125px">Brand</th>
                            <th class="min-w-125px">Tipe</th>
                            <th class="min-w-125px">Pemegang</th>
                            <th class="min-w-125px">Status</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>

</div>

<div>

    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script src="<?= base_url('assets/js/custom/apps/Inventaris/master/detail.js') ?>"></script>
    <?= $this->endSection() ?>