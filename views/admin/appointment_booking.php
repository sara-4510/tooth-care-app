<?php
require_once('../layouts/header.php');
?>

<div class="container">
    <h1 class="mx-3 my-5">Appointment Booking</h1>
    <section class="content m-3">
        <div class="container-fluid">
                            <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="col-md-7 mx-auto">
                                    <img src="http://tooth-care.delta-physics.com/assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded m-3" width="150" id="uploadedAvatar">
                                </div>
                                <h5 class="card-title">Mr. A.D. Ranasinghe</h5>
                                <p class="card-text">
                                    Dental surgeon                                </p>
                                <div class="col-md-12">
                                    <input class="form-control" type="week" name="week" id="week_date" required>
                                    <input type="hidden" name="doctor_id" id="doctor_id" value="1">
                                </div>
                                <div class="col-md-12 mt-2 text-right">
                                    <a href="javascript:void(0)" class="btn btn-primary" id="bookNowBtn">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>


    </section>
</div>

<?php
require_once('../layouts/footer.php');
?>