<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/Treatment.php';

$treatmentModel = new Treatment();
$treatments = $treatmentModel->getAll();

?>

<div class="container">

    <h1 class="mx-3 my-5">
       Treatments

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-end m-3" data-bs-toggle="modal" data-bs-target="#createTreatmentModal">
            Create Treatments
        </button>
    </h1>
    <section class="content m-3">
        <div class="container-fluid">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th class="">Name</th>
                                <th class="">DESCRIPTION</th>
                                <th class="">Treatment fee</th>
                                <th class="">Registration fees</th>
                                <th class="">Status</th>
                                <!-- <th style="width: 200px">Options</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($treatments as $key => $c) {
                            ?>
                              <tr>
                                    <td> <?= $c['id'] ?? ""; ?> </td>
                                    <td> <?= $c['name'] ?? ""; ?> </td>
                                    <td> <?= $c['description'] ?? ""; ?> </td>
                                    <td class="text-right">LKR <?= number_format($c['treatment_fee'], 2) ?? 0; ?> </td>
                                    <td class="text-right">LKR <?= number_format($c['registration_fee'], 2) ?? 0; ?> </td>
                                    <td>
                                        <div class="">
                                            <?php if ($c['is_active'] == 1) { ?>
                                                <span class="badge bg-success">Enable</span>
                                            <?php } else { ?>
                                                <span class="badge bg-danger">Disable</span>
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                        <button class="btn btn-sm btn-info m-2 edit-" data-id="<?= $c['id']; ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger m-2 delete-" data-id="<?= $c['id']; ?>">Delete</button>  </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
</div>

Modal
<div class="modal fade " id="createTreatmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-treatment-form" action="<?= url('services/ajax_functions.php') ?>">
                <input type="hidden" name="action" value="create_treatment">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Create Treatment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label"> Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" required />
                        </div>

                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="basic-default-password12" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="permission">Permission</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="permission" name="permission" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="operator">Operator</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="create-now" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update  Modal -->
<div class="modal fade " id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="update-treatment-form" action="<?= url('services/ajax_functions.php') ?>"autocomplete="off">>
                <input type="hidden" name="action" value="update_">
                <input type="hidden" name="id" id="_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label"> Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" required />
                        </div>
                    </div>
                    <div class="row g-1">
                        <div class="col mb-0">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="xxxx@xxx.xx" required />
                        </div>

                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="············" aria-describedby="basic-default-password2" required >
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="basic-default-password12">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="basic-default-password12" placeholder="············" aria-describedby="basic-default-password2" required >
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="permission">Permission</label>
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupSelect01">Options</label>
                                <select class="form-select" id="permission" name="permission" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="operator">Operator</option>
                                    <option value="doctor">Doctor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col mb-0">
                            <label class="form-label" for="is_active">Status</label>
                            <div class="input-group">
                                <select class="form-select" id="is_active" name="is_active" required>
                                    <option selected="" value="">Choose...</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container-update-form"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="update-now" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
require_once('../layouts/footer.php');
?>

<!-- <script>
    $(document).ready(function() {

        // Handle modal button click
        $('#create-now').on('click', function() {

            // Get the form element
            var form = $('#create-treatment-form')[0];
            $('#create-treatment-form')[0].reportValidity();

            // Check form validity
            if (form.checkValidity()) {
                // Serialize the form data
                var formData = $('#create-treatment-form').serialize();
                var formAction = $('#create-treatment-form').attr('action');

                // Perform AJAX request
                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData, // Form data
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger');
                        if (response.success) {
                            $('#createTreatmentModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(error) {
                        // Handle the error
                        console.error('Error submitting the form:', error);
                    },
                    complete: function(response) {
                        // This will be executed regardless of success or error
                        console.log('Request complete:', response);
                    }
                });
            } else {
                var message = ('Form is not valid. Please check your inputs.');
                showAlert(message, 'danger');
            }
        });

        $('.edit-').on('click', async function() {
            var _id = $(this).data('id');
            await getById(_id);
        })
    });
    $('.delete-').on('click', async function() {
            var _id = $(this).data('id');
            var is_confirm = confirm('Are you sure,Do you want to delete?');
            if (is_confirm) await deleteById(_id);
        })
    $('#update-now').on('click', function() {

// Get the form element
var form = $('#update-treatment-form')[0];
$('#update-treatment-form')[0].reportValidity();

// Check form validity
if (form.checkValidity()) {
    // Serialize the form data
    var formData = $('#update-treatment-form').serialize();
    var formAction = $('#update-treatment-form').attr('action');

    // Perform AJAX request
    $.ajax({
        url: formAction,
        type: 'POST',
        data: formData, // Form data
        dataType: 'json',
        success: function(response) {
            showAlert(response.message, response.success ? 'primary' : 'danger','alert-container-update-form');
            if (response.success) {
                $('#editModal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }
        },
        error: function(error) {
            // Handle the error
            console.error('Error submitting the form:', error);
        },
        complete: function(response) {
            // This will be executed regardless of success or error
            console.log('Request complete:', response);
        }
    });
} else {
    var message = ('Form is not valid. Please check your inputs.');
    showAlert(message, 'danger');
}
});

    async function getById(id) {
        var formAction = $('#update-treatment-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                _id: id,
                action: 'get_'
            }, // Form data
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'primary' : 'danger');
                if (response.success) {
                    var _id = response.data._id;
                    var name = response.data.name;
                    var email = response.data.email;
                    var permission = response.data.permission;
                    var is_active = response.data.is_active;

                    $('#editModal #_id').val(_id);
                    $('#editModal #name').val(name);
                    $('#editModal #email').val(email);
                    $('#editModal #permission option[value="' + permission + '"]').prop('selected', true);
                    $('#editModal #is_active option[value="' + is_active + '"]').prop('selected', true);

                    $('#editModal').modal('show');
                }
            },
            error: function(error) {
                // Handle the error
                console.error('Error submitting the form:', error);
            },
            complete: function(response) {
                // This will be executed regardless of success or error
                console.log('Request complete:', response);
            }
        });
    }
    async function deleteById(id) {
        var formAction = $('#update-treatment-form').attr('action');

        // Perform AJAX request
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                _id: id,
                action: 'delete_'
            }, // Form data
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(error) {
                // Handle the error
                console.error('Error submitting the form:', error);
            },
            complete: function(response) {
                // This will be executed regardless of success or error
                console.log('Request complete:', response);
            }
        });
    } 



</script> -->