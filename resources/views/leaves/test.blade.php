<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Include Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

{{-- <label for="leave_start_date">Leave Start Date:</label>
<input type="text" id="leave_start_date" name="leave_start_date" />

<label for="leave_end_date">Leave End Date:</label>
<input type="text" id="leave_end_date" name="leave_end_date" /> --}}


<div class="col-md-12">
    <div class="col-md-4">
        <div class="form-group">
            <label for="leave_start_date">Date:</label>
            <div class="input-daterange input-group" id="date-range">
                <input type="text" class="form-control datepicker" id="leave_start_date"
                    name="leave_start_date" placeholder="Start Date"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                <span class="input-group-addon bg-info b-0 text-white">to</span>
                <input type="text" class="form-control datepicker" id="leave_end_date"
                    name="leave_end_date" placeholder="End Date"
                    min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        // Initialize the date picker for the leave start date input
        $("#leave_start_date").datepicker();

        // Initialize the date picker for the leave end date input
        $("#leave_end_date").datepicker();

        // Add a change event listener to the leave end date input
        $("#leave_end_date").change(function() {
            // Get the date values for the leave start and end dates
            var startDate = new Date($("#leave_start_date").val());
            var endDate = new Date($("#leave_end_date").val());

            // Check if the end date is before the start date
            if (endDate < startDate) {
                // If the end date is before the start date, show an error message
                alert("Leave end date must be after leave start date.");
                // Reset the end date input value to an empty string
                $("#leave_end_date").val("");
            }
        });
    });
</script>
