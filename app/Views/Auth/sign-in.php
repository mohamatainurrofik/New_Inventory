<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inventory</title>
    <meta name="description" content="Website Inventory" />
    <meta name="keywords" content="Inventory" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="<?= base_url('assets/plugins/global/plugins.bundle.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/css/style.bundle.css') ?>" rel="stylesheet" type="text/css" />

</head>

<body id="kt_body" class="" style="background-image: url('<?= base_url('assets/media/img/1.jpg') ?>');background-size: cover;">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
            <a href="#" class="mb-10">
                <img alt="Logo" src="<?= base_url('assets/media/img/2.png') ?>" class="h-50px" />
            </a>
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <h5 id="session-login"><?= view('Myth\Auth\Views\_message_block') ?></h5>
                <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="<?= route_to('login') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">BMC-SIMATORY</h1>
                    </div>
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="login" placeholder="<?= lang('Auth.email') ?>" autocomplete="off" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                        </div>
                        <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Continue</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>


        <!--end::Authentication - Sign-in-->
    </div>

    <script src="<?= base_url('assets/plugins/global/plugins.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/scripts.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom/authentication/sign-in/general.js') ?>"></script>

</body>
<!--end::Body-->

</html>