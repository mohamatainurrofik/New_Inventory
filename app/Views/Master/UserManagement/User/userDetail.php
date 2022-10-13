<?= $this->extend('Layouts/aside/template') ?>
<?= $this->section('content') ?>


<!--begin::Navbar-->
<h5 id="locationpath" class="d-none">/User/account</h5>
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
                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"><?= $account['username'] ?></a>
                            <a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3"><?= $account['active'] = (1) ? 'Aktif' : 'Tidak Aktif';  ?></a>
                        </div>
                        <!--end::Name-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
                                        <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Surabaya
                            </a>
                        </div>
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
                            <div class="px-7 py-5" data-kt-account-detail-filter="form">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Account :</label>
                                    <select class="form-select form-select-solid fw-bolder" id="selectaccount" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-account-detail-filter="accountname" data-hide-search="true">
                                        <option></option>
                                        <?php foreach ($allAccount as $key => $unit) { ?>
                                            <option value="<?= $unit['id'] ?>"><?= $unit['email'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-account-detail-filter="filter">Apply</button>
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
                    <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#kt_account_details_view">Overview</a>
                </li>
                <!--end::Nav item-->
                <!--begin::Nav item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_account_history_view">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#kt_account_log_view">Log</a>
                </li>
            </ul>
        </div>
        <!--begin::Navs-->
    </div>
</div>
<!--end::Navbar-->
<!--begin::details View-->
<div class="tab-content" id="myTabContent">
    <div role="tabpanel" class="tab-pane fade show active card mb-5 mb-xl-10" id="kt_account_details_view">
        <!--begin::Card header-->
        <div class="card-header  ">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">Detail Account</h3>
            </div>
            <!--end::Card title-->
            <!--begin::Action-->
            <a type="button" data-unique="edit" class="btn btn-primary align-self-center">Ubah Account</a>
            <div data-unique="tempDiv" class="card-title d-none">
                <a type="button" data-unique="cancel" class="btn btn-danger align-self-center ">Batal</a>
            </div>
            <!--end::Action-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div data-unique="viewAccount" class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Username</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8" data-unique="accountUsername">
                    <span class="fw-bolder fs-6 text-gray-800"><?= $account['username'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Email</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8" data-unique="accountEmail">
                    <span class="fw-bolder fs-6 text-gray-800"><?= $account['email'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Password</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8" data-unique="accountPassword">
                    <span class="fw-bolder fs-6 text-gray-800">***************</span>
                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Role</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8" data-unique="accountRole">
                    <span id="roleAccountText" class="fw-bolder fs-6 text-gray-800"><?= $account['name'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">Dipakai</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8" data-unique="accountDipakai">
                    <span class="fw-bolder fs-6 text-gray-800"><?= $account['nama'] ?></span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Input group-->
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <label class="col-lg-4 fw-bold text-muted">Status</label>
                <div class="col-lg-8 d-flex align-items-center" data-unique="accountStatus">
                    <?= $account['status'] == '1' ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Tidak Aktif</span>'; ?>
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
                    <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary"><?= $account['created_at'] ?></a>
                </div>
                <!--end::Col-->
            </div>


        </div>
        <div data-unique="editAccount" class="card-body p-9 d-none">
            <form id="edit_account_form" class="form" action="#">
                <input type="hidden" id="id_account" name="id_account" value="<?= $account['id'] ?>">
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted required">Username</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="editAccountUsername" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Username Account" value="<?= $account['username'] ?>" />
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted required">Email</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" name="editAccountEmail" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email Account" value="<?= $account['email'] ?>" />
                    </div>
                </div>
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted required">Role</label>
                    <input type="hidden" name="user_role" value="<?= $account['group_id'] ?>">
                    <div class="col-lg-8 fv-row">
                        <select class="form-select form-select-solid fw-bolder" id="editAccountRole" name="editAccountRole" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-account-table-filter="accountRole" data-hide-search="true">
                            <option></option>
                            <?php foreach ($allRole as $key => $role) { ?>
                                <option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-7">
                    <label class="col-lg-4 fw-bold text-muted required">Status</label>
                    <div class="col-lg-8 d-flex align-items-center">
                        <div class="d-flex fv-row">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input me-3" name="editAccountStatus" type="radio" value="1" id="editAccountStatus_0" checked='checked' />
                                <label class="form-check-label me-3" for="editAccountStatus_0">
                                    <div class="fw-bolder text-gray-800">Aktif</div>
                                </label>
                            </div>
                        </div>
                        <div class='separator separator-dashed my-5'></div>
                        <div class="d-flex fv-row">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input me-3" name="editAccountStatus" type="radio" value="0" id="editAccountStatus_1" />
                                <label class="form-check-label" for="editAccountStatus_1">
                                    <div class="fw-bolder text-gray-800">Tidak Aktif</div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
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

    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_account_history_view">
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
                    <input type="text" data-kt-account-history-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search History" />
                </div>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-account-history-table-toolbar="base">
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
                        <div class="px-7 py-5" data-kt-account-history-table-filter="form">
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Tahun :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-account-history-table-filter="tahun" data-hide-search="true">
                                    <option></option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                </select>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Bulan :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-account-history-table-filter="bulan" data-hide-search="true">
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
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-account-history-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-account-history-table-filter="filter">Apply</button>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_history_account">
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
        <div data-unique="viewHistoryAccount" class="card-body p-9">
            <div class="row mb-10">
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="accountHistoryTable">
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
    <div role="tabpanel" class="tab-pane fade card mb-5 mb-xl-10" id="kt_account_log_view">
        <div class="card-header ">
            <div class="card-title">
                <h3 id="linked-account-title" class="fw-bolder m-0"></h3>
            </div>
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-account-linked-table-toolbar="base">
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
                        <div class="px-7 py-5" data-kt-account-linked-table-filter="form">
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Log :</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-account-linked-table-filter="tahun" data-hide-search="true">
                                    <option></option>
                                    <option value="login">Login Log</option>
                                    <option value="event">Event Log</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-account-linked-table-filter="filter">Apply</button>
                            </div>
                        </div>
                    </div>
                    <!-- <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_linked_account">
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
        <div class="card-body">
            <div data-unique="accountLoginTable" class="d-none">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="accountLoginTable">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-100px">Username</th>
                            <th class="min-w-175px">Date</th>
                        </tr>
                    </thead>

                </table>
            </div>
            <div data-unique="accountEventTable" class="d-none">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="accountEventTable">
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
    <div class="modal fade" id="kt_modal_update_password" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">Update Password</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-account-modal-action="close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form id="kt_modal_update_password_form" class="form" action="#">
                        <div class="mb-10 fv-row" data-kt-password-meter="true">
                            <div class="mb-1">
                                <!--begin::Label-->
                                <label class="form-label fw-bold fs-6 mb-2">New Password</label>
                                <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="new_password" autocomplete="off" />
                            </div>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fw-bold fs-6 mb-2">Confirm New Password</label>
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="confirm_password" autocomplete="off" />
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-kt-account-modal-action="cancel">Discard</button>
                            <button type="submit" class="btn btn-primary" data-kt-account-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
</div>

<div>

    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <script src="<?= base_url('assets/js/custom/apps/user-management/account/detail.js') ?>"></script>
    <?= $this->endSection() ?>